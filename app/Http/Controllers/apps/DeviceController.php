<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use App\Models\Models\apps\DeviceGroupInfo;
use App\Models\Models\apps\HistoryDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    private $device;
    private $history;
    private $group;

    public function __construct(Device $device, HistoryDevice $history, DeviceGroupInfo $group)
    {
        $this->device = $device;
        $this->history = $history;
        $this->group = $group;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has('error')) {
            $devices = $this->device
                ->where('status', 'error')
                ->get();
        } elseif ($request->has('noRoom')) {
            $devices = $this->device
                ->where('room_id', null)
                ->get();
        } else {
            $devices = $this->device
                ->where('status', '<>', 'in_order_liquidate')
                ->Where('status', '<>', 'liquidated')
                ->get();
        }
        return view("apps.dashboard.devices.index", compact("devices"));
    }

    public function edit($id)
    {
        $device = $this->device->find($id);
        $rooms = DB::table('rooms')->get();
        $device_groups = DB::table('device_groups')
            ->where('room_id', $device->room_id)
            ->get();
//        dd($device);
        return view('apps.dashboard.devices.edit', compact('device', 'rooms', 'device_groups'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            if($request->group_id != ""){
                DB::table('device_group_infos')
                    ->where('device_id', $id)
                    ->update([
                        'device_group_id' => $request->group_id
                    ]);
            }

            $device = $this->device->find($id);
            if($request->group_id != "" && $device->device_group_id == null){
                DB::table('device_group_infos')->insert([
                    'device_group_id' => $request->group_id,
                    'device_id' => $device->id,
                ]);
                $group_name = DB::table('device_groups')->where('id', $request->group_id)->pluck('name');
                DB::table('history_devices')->insert([
                    'device_id' => $device->id,
                    'device_name' => $device->device_name,
                    'note' => "Th??m thi???t b??? " . $device->device_name . " v??o nh??m " . $group_name[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->device->find($id)->update([
                'serial' => $request->serial,
                'room_id' => $request->room_id,
                'device_name' => $request->device_name,
                'device_group_id' => $request->group_id,
                'device_info' => $request->device_info
            ]);

            DB::commit();

            alert()->success('C???p nh???t th??nh c??ng');
            if($request->room_id != null)
                return redirect()->route('room.device', ['id' => $request->room_id]);
            return redirect()->route('device.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            alert()->error('L???i', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return back();
        }
    }

    public function active($id): \Illuminate\Http\RedirectResponse
    {

        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('L???i', 'B???n kh??ng c?? quy???n ch???nh s???a m???c n??y');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'active'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->id,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'C???p nh???t tr???ng th??i thi???t b??? t??? "' . $device_status . '" th??nh "??ang s??? d???ng"',
            ]);
            alert()->success('Th??nh c??ng', '???? c???p nh???t tr???ng th??i thi???t b??? ' . $device[0]->full_number . ' th??nh "??ang s??? d???ng"');
        }

        return back();
    }

    public function inactive($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('L???i', 'B???n kh??ng c?? quy???n ch???nh s???a m???c n??y');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'inactive'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->id,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'C???p nh???t tr???ng th??i thi???t b??? t??? "' . $device_status . '" th??nh "Ch??a s??? d???ng"',
            ]);
            alert()->success('Th??nh c??ng', '???? c???p nh???t tr???ng th??i thi???t b??? ' . $device[0]->full_number . ' th??nh "Ch??a s??? d???ng"');
        }
        return back();
    }

    public function error($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('L???i', 'B???n kh??ng c?? quy???n ch???nh s???a m???c n??y');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'error'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->id,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'C???p nh???t tr???ng th??i thi???t b??? t??? "' . $device_status . '" th??nh "H???ng"',
            ]);
            alert()->success('Th??nh c??ng', '???? c???p nh???t tr???ng th??i thi???t b??? ' . $device[0]->full_number . ' th??nh "H???ng"');
        }
        return back();
    }

    public function fixing($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('L???i', 'B???n kh??ng c?? quy???n ch???nh s???a m???c n??y');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'fixing'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->id,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'C???p nh???t tr???ng th??i thi???t b??? t??? "' . $device_status . '" th??nh "??ang s???a"',
            ]);
            alert()->success('Th??nh c??ng', '???? c???p nh???t tr???ng th??i thi???t b??? ' . $device[0]->full_number . ' th??nh "??ang s???a"');
        }

        return back();
    }

    public function liquidate($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('L???i', 'B???n kh??ng c?? quy???n ch???nh s???a m???c n??y');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'liquidate'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->id,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'C???p nh???t tr???ng th??i thi???t b??? t??? "' . $device_status . '" th??nh "Xin thanh l??"',
            ]);
            alert()->success('Th??nh c??ng', '???? c???p nh???t tr???ng th??i thi???t b??? ' . $device[0]->full_number . ' th??nh "Xin thanh l??"');
        }
        return back();
    }

    public function detailWithGroup($id, $group_id)
    {

        $i = 1;
        $devices = $this->device
            ->where('id', $id)
            ->where('device_group_id', $group_id)
            ->get();
        $groups = $this->device
            ->where('device_group_id', $group_id)
            ->where('id', '<>', $id)
            ->get();
        $history = $this->history->where('device_id', $id)->get();
        return view('apps.dashboard.devices.info', compact('devices', 'groups', 'i', 'history'));
    }

    public function detailNoGroup($id)
    {
        $devices = $this->device
            ->where('id', $id)
            ->get();
        return view('apps.dashboard.devices.info', compact('devices'));
    }

    public function updateRoom(Request $request, $ids): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();

            $ids = $request->device_id;

            foreach ($ids as $id) {
                $this->device->where('id', $id)->update([
                    'room_id' => $request->room_id
                ]);
                $this->history->create([
                    'device_id' => $id,
                    'device_name' => $request->device_name,
                    'date_modified' => now(),
                    'note' => 'Th??m thi???t b??? v??o ph??ng ' . $request->room_name
                ]);
            }

            DB::commit();
            alert()->success('', 'Th??m thi???t b??? v??o ph??ng th??nh c??ng');
            return redirect()->route('room.device', ['id' => $request->room_id]);
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            alert()->error('L???i', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return back();
        }
    }

    public function removeRoom($id){
        try {
            DB::beginTransaction();
            $device = $this->device->find($id);
            $this->device->where('id', $id)->update([
                'room_id' => null
            ]);
            $this->group->where('device_id', $id)->delete();
            $this->history->create([
                'device_id' => $id,
                'device_name' => $device->device_name,
                'note' => "X??a thi???t b??? " . $device->device_name . " kh???i ph??ng " . $device->Room->name
            ]);
            DB::commit();
            alert()->success('', '???? x??a thi???t b??? kh???i ph??ng');
            return back();
        } catch (\Exception $exception){
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            alert()->error('L???i', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return back();
        }

    }

}
