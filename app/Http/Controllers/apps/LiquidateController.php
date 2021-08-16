<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use App\Models\Models\apps\Liquidate;
use App\Models\Models\apps\LiquidateInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LiquidateController extends Controller
{
    private $liquidate;
    private $liquidate_info;
    private $device;

    public function __construct(Liquidate $liquidate, Device $device, LiquidateInfo $liquidate_info)
    {
        $this->liquidate = $liquidate;
        $this->device = $device;
        $this->liquidate_info = $liquidate_info;
        $this->middleware('auth');
    }

    public function index()
    {
        $liquidates = $this->liquidate->all();
        $i = 1;
        return view('apps.dashboard.liquidates.index', compact('liquidates', 'i'));
    }

    public function create(Request $request)
    {
        $i = 1;
        $array_item = array();
        foreach ($request->device_id as $item) {
            $device_info = $this->device->where('id', $item)->get();
            array_push($array_item, $device_info);
        }
        return view('apps.dashboard.liquidates.add', compact('array_item', 'i'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $countDevice = count($request->device_name);
            $liquidate = $this->liquidate->create([
                'qty' => $countDevice,
                'note' => $request->note,
                'document_prefix_id' => 5
            ]);

            for ($i = 0; $i < $countDevice; $i++) {
                $this->liquidate_info->create([
                    'liquidate_id' => $liquidate->id,
                    'room_id' => $request->room_id[$i],
                    'full_number' => $request->full_number[$i],
                    'device_name' => $request->device_name[$i],
                    'device_info' => $request->device_info[$i],
                    'price' => $request->price[$i],
                    'reason' => $request->reason[$i]
                ]);

                $this->device->where('full_number', $request->full_number[$i])->update([
                    'status' => 'in_order_liquidate'
                ]);
            }

            DB::commit();
            alert()->success('', 'Thành công');
            return redirect()->route('liquidate.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return back();
        }
    }

    public function edit($id)
    {
        $liquidate = $this->liquidate->find($id);
        $i = 1;
        return view('apps.dashboard.liquidates.edit', compact('liquidate', 'i'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            $countDevice = count($request->device_name);

            $this->liquidate->find($id)->update([
                'note' => $request->note,
            ]);

            $this->liquidate_info->where('liquidate_id', $id)->delete();

            for ($i = 0; $i < $countDevice; $i++) {
                $this->liquidate_info->create([
                    'liquidate_id' => $id,
                    'room_id' => $request->room_id[$i],
                    'full_number' => $request->full_number[$i],
                    'device_name' => $request->device_name[$i],
                    'device_info' => $request->device_info[$i],
                    'price' => $request->price[$i],
                    'reason' => $request->reason[$i]
                ]);
            }

            DB::commit();
            alert()->success('', 'Thành công');
            return redirect()->route('liquidate.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return back();
        }
    }

    public function info($id)
    {
        $i = 1;
        $code = $this->liquidate->where('id', $id)->get();
        $devicesList = $this->liquidate_info->where('liquidate_id', $id)->get();
        return view('apps.dashboard.liquidates.info', compact('i', 'code', 'devicesList'));
    }

    public function approve($id)
    {
        $edited = $this->liquidate->where('id', $id)->get();
        if ($edited[0]->status == 'accept') {
            alert()->info('', 'Đã phê duyệt yêu cầu này rồi');
        } else {
            $this->liquidate->find($id)->update([
                'status' => 'accept',
                'can_edit' => 0,
            ]);
            alert()->success('', 'Phê duyệt thành công!');
        }
        return redirect()->route('liquidate.info', ['id' => $id]);
    }

    public function refuse($id)
    {
        $edited = $this->liquidate->where('id', $id)->get();
        if ($edited[0]->status == 'cancel') {
            alert()->info('', 'Yêu cầu này đã bị từ chối rồi!');
        } else {
            $this->liquidate->find($id)->update([
                'status' => 'cancel',
                'can_edit' => 0,
            ]);
            alert()->success('Thành công', 'Đã từ chối yêu cầu');
        }
        return redirect()->route('liquidate.info', ['id' => $id]);
    }

    public function liquidated($id)
    {
        $edited = $this->liquidate->where('id', $id)->get();
        if ($edited[0]->status == 'liquidated') {
            alert()->info('', 'Đã thanh lý các thiết bị này rồi!');
        } else {
            $this->liquidate->find($id)->update([
                'status' => 'liquidated',
            ]);
            alert()->success('Thành công', 'Đã thanh lý thiết bị');
        }
        return redirect()->route('liquidate.info', ['id' => $id]);
    }
}
