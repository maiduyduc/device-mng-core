<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use App\Models\Models\apps\DevicePlan;
use App\Models\Models\apps\Document;
use App\Models\Models\apps\Handover;
use App\Models\Models\apps\HandoverInfo;
use App\Models\Models\apps\HistoryDevice;
use App\Models\Models\apps\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HandoverController extends Controller
{
    private $room;
    private $handover;
    private $handover_list;
    private $document;
    private $device_plan;
    private $device;
    private $history;

    public function __construct(Handover $handover, HandoverInfo $handover_list, Document $document, DevicePlan $device_plan, Room $room, Device $device, HistoryDevice $history)
    {
        $this->handover = $handover;
        $this->handover_list = $handover_list;
        $this->document = $document;
        $this->device_plan = $device_plan;
        $this->room = $room;
        $this->device = $device;
        $this->history = $history;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $i = 1;
        if ($request->has('pending')) {
            $handovers = $this->handover::where('status', 'pending')->get();
        } else {
            $handovers = $this->handover::all();
        }
        return view('apps.dashboard.handovers.index', compact('handovers', 'i'));
    }

    /*
    public function create()
    {
    }

    public function store(Request $request)
    {
    }
    */
    public function edit($id)
    {
        $data = $this->handover->find($id);
        $categories = DB::table('categories')->get();
        $device_prefix = DB::table('device_prefixes')->get();
        $i = 1;
        return view('apps.dashboard.handovers.edit', compact('data', 'i', 'categories', 'device_prefix'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $countDevice = count($request->device_name);
            $this->handover->find($id)->update([
                'name' => $request->document_name,
                'qty' => array_sum($request->qty),
                'status' => 'pending',
            ]);
            $this->handover_list->where('handover_id', $id)->delete();
            for ($i = 0; $i < $countDevice; $i++) {
                $this->handover_list->create([
                    'handover_id' => $id,
                    'device_name' => $request->device_name[$i],
                    'category_id' => $request->category_id[$i],
                    'device_prefix_id' => $request->device_prefix_id[$i],
                    'origin' => $request->origin[$i],
                    'unit' => $request->unit[$i],
                    'qty' => $request->qty[$i],
                    'inventory_qty' => $request->inventory_qty[$i],
                    'purchase_date' => $request->purchase_date[$i],
                    'serial' => $request->serial[$i],
                    'device_info' => $request->device_info[$i],
                    'note' => $request->note[$i]
                ]);
            }
            DB::commit();
            alert()->success('C???p nh???t th??nh c??ng');
            return redirect()->route('handover.info', ['id' => $id]);
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("L???i", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('handover.info', ['id' => $id]);
        }
    }

    public function delete($id)
    {
        $handover = $this->handover->find($id);
        if ($handover->is_handover == 1) {
            return $this->failResponse();
        }
        try {
            DB::beginTransaction();
            $info = $this->handover->where('id', $id)->get();
            $this->handover->find($id)->delete();
            $this->handover_list::where('handover_id', $id)->delete();

            $subject = $info[0]->code;
            $cv = '/CV/';
            $dt = '/DT/';

            if (preg_match($cv, $subject)) {
                $this->document->where('full_number', $info[0]->code)->update([
                    'can_export' => 1,
                    'is_export' => 0
                ]);
            }
            if (preg_match($dt, $subject)) {
                $this->device_plan->where('full_number', $info[0]->code)->update([
                    'can_export' => 1,
                    'is_export' => 0
                ]);
            }
            $this->updateWhenDelete(3);
            DB::commit();
            return $this->successResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            return $this->failResponse();
        }
    }

    public function approve($id)
    {
        $edited = $this->handover->where('id', $id)->get();
        if ($edited[0]->status == 'accept') {
            alert()->info('', '???? th???c hi???n b??n giao v??n b???n n??y r???i!');
        } else {
            $this->handover->find($id)->update([
                'status' => 'accept',
                'can_edit' => 0,
                'can_export' => 1,
                'is_handover' => 1
            ]);
            alert()->success('Th??nh c??ng', 'B??n giao th??nh c??ng');
        }
        $this->updateWhenApproved(3);
        return redirect()->route('handover.info', ['id' => $id]);
    }

    public function info($id)
    {
        //        alert()->info('', 'Vui l??ng ??i???n ?????y ????? th??ng tin c???n thi???t tr?????c khi b??n giao ho???c xu???t th??ng tin.');
        $i = 1;
        $infos = $this->handover_list->where('handover_id', $id)->get();
        $code = $this->handover->where('id', $id)->get();
        return view('apps.dashboard.handovers.info', compact('infos', 'code', 'i'));
    }

    public function export($id)
    {
        $i = 1;
        $rooms = $this->room::all();
        $device_infos = $this->handover_list->where('handover_id', $id)->get();
        $handover_id = $this->handover->find($id);
        return view('apps.dashboard.handovers.export', compact('device_infos', 'rooms', 'i', 'handover_id'));
    }

    public function exportOneRoom(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $handover_id = $this->handover->find($id);
        if ($handover_id->is_export == 1) {
            alert()->info('Th??ng tin n??y ???? ???????c xu???t r???i!');
            return redirect()->route('handover.info', ['id' => $id]);
        } else {
            $room_info = explode(".", $request->room_id);
            $infos = $this->handover_list->where('handover_id', $id)->get();
            $countDevice = $this->handover_list->where('handover_id', $id)->sum('qty');
            try {
                DB::beginTransaction();
                foreach ($infos as $info) {
                    //th??m d??? li???u v??o b???ng device
                    for ($i = 0; $i < $info->qty; $i++) {
                        $device = $this->device->create([
                            'device_prefix_id' => $info->device_prefix_id,
                            'category_id' => $info->category_id,
                            'room_id' => $room_info[0],
                            'handover_id' => $info->handover_id,
                            'device_name' => $info->device_name,
                            'device_info' => $info->device_info,
                            'serial' => $info->serial,
                            'unit' => $info->unit,
                            'price' => $info->price,
                            'status' => 'active'
                        ]);
                        //th??m d??? li???u v??o b???ng history_device
                        $this->history->create([
                            'device_id' => $device->id,
                            'device_name' => $info->device_name,
                            'date_modified' => now(),
                            'note' => 'Th??m thi???t b??? v??o ph??ng ' . $room_info[1]
                        ]);
                    }
                }
                $this->handover->where('id', $id)->update([
                    'is_export' => 1,
                    'can_export' => 0
                ]);
                $this->room->where('id', $room_info[0])->increment('num_of_equip', $countDevice);
                $this->updateWhenExport(3);
                DB::commit();
                alert()->success('Xu???t th??ng tin th??nh c??ng!');
                return redirect()->route('room.device', ['id' => $room_info[0]]);
            } catch (\Exception $exception) {
                DB::rollBack();
                log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
                alert()->error('L???i', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
                return redirect()->route('handover.info', ['id' => $id]);
            }
        }
    }

    public function exportManyRoom(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $handover_id = $this->handover->find($id);
        if ($handover_id->is_export == 1) {
            alert()->info('Th??ng tin n??y ???? ???????c xu???t r???i!');
            return redirect()->route('handover.info', ['id' => $id]);
        } else {
            try {
                DB::beginTransaction();
                //t??ch room_id v?? room_name t??? m???ng request l???y ???????c
                $room_lists = $request->room_id;
                $room_ids = array();
                $room_names = array();
                foreach ($room_lists as $val) {
                    $infos = explode(',', $val);
                    foreach ($infos as $v) {
                        $room_info = explode('.', $v);
                        array_push($room_ids, $room_info[0]); //id ph??ng
                        array_push($room_names, $room_info[1]); //t??n ph??ng
                    }
                }
                //=====
                $infos = $this->handover_list->where('handover_id', $id)->get();
                $device_info = array();
                foreach ($infos as $info) {
                    for ($i = 0; $i < $info->qty; $i++) {
                        $new_info = array(
                            'device_prefix_id' => $info->device_prefix_id,
                            'category_id' => $info->category_id,
                            'room_id' => $info->room_id,
                            'handover_id' => $info->handover_id,
                            'device_name' => $info->device_name,
                            'device_info' => $info->device_info,
                            'serial' => $info->serial,
                            'unit' => $info->unit,
                            'price' => $info->price
                        );
                        array_push($device_info, $new_info);
                    }
                }

                $countDevice = $this->handover_list->where('handover_id', $id)->sum('qty');

                for ($i = 0; $i < $countDevice; $i++) {
                    //th??m d??? li???u v??o b???ng device
                    $device = $this->device->create([
                        'device_prefix_id' => $device_info[$i]['device_prefix_id'],
                        'category_id' => $device_info[$i]['category_id'],
                        'room_id' => $room_ids[$i],
                        'handover_id' => $device_info[$i]['handover_id'],
                        'device_name' => $device_info[$i]['device_name'],
                        'device_info' => $device_info[$i]['device_info'],
                        'serial' => $device_info[$i]['serial'],
                        'unit' => $device_info[$i]['unit'],
                        'price' => $device_info[$i]['price'],
                        'status' => 'active'
                    ]);
                    //th??m d??? li???u v??o b???ng history_device
                    $this->history->create([
                        'device_id' => $device->id,
                        'device_name' => $device_info[$i]['device_name'],
                        'date_modified' => now(),
                        'note' => 'Th??m thi???t b??? v??o ph??ng ' . $room_names[$i]
                    ]);
                    $this->room->where('id', $room_ids[$i])->increment('num_of_equip', 1);;
                }
                $this->handover->where('id', $id)->update([
                    'is_export' => 1,
                    'can_export' => 0
                ]);
                $this->updateWhenExport(3);
                DB::commit();
                alert()->success('Xu???t th??ng tin th??nh c??ng!');
                return redirect()->route('room.index');
            } catch (\Exception $exception) {
                DB::rollBack();
                log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
                alert()->error('L???i', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
                return redirect()->route('handover.info', ['id' => $id]);
            }
        }
    }

    public function exportOnly(Request $request, $id)
    {
        $handover_id = $this->handover->find($id);
        if ($handover_id->is_export == 1) {
            alert()->info('Th??ng tin n??y ???? ???????c xu???t r???i!');
            return redirect()->route('handover.info', ['id' => $id]);
        } else {
            $infos = $this->handover_list->where('handover_id', $id)->get();
            $countDevice = $this->handover_list->where('handover_id', $id)->sum('qty');
            try {
                DB::beginTransaction();
                foreach ($infos as $info) {
                    //th??m d??? li???u v??o b???ng device
                    for ($i = 0; $i < $info->qty; $i++) {
                        $device = $this->device->create([
                            'device_prefix_id' => $info->device_prefix_id,
                            'category_id' => $info->category_id,
                            'handover_id' => $info->handover_id,
                            'device_name' => $info->device_name,
                            'device_info' => $info->device_info,
                            'serial' => $info->serial,
                            'unit' => $info->unit,
                            'price' => $info->price,
                            'status' => 'inactive'
                        ]);
                        //th??m d??? li???u v??o b???ng history_device
                        $this->history->create([
                            'device_id' => $device->id,
                            'device_name' => $info->device_name,
                            'date_modified' => now(),
                            'note' => 'Nh???p thi???t b???'
                        ]);
                    }
                }
                $this->handover->where('id', $id)->update([
                    'is_export' => 1,
                    'can_export' => 0
                ]);
                $this->updateWhenExport(3);
                DB::commit();
                alert()->success('Xu???t th??ng tin th??nh c??ng!');
                return redirect()->route('device.index', 'noRoom');
            } catch (\Exception $exception) {
                DB::rollBack();
                log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
                alert()->error('L???i', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
                return redirect()->route('handover.info', ['id' => $id]);
            }
        }
    }
}
