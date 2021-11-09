<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\DeviceGroup;
use App\Models\Models\apps\DeviceGroupInfo;
use App\Models\Models\apps\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceGroupController extends Controller
{
    private $device_group_info;
    private $device_group;
    private $room;

    public function __construct(DeviceGroup $device_group, Room $room, DeviceGroupInfo $device_group_info)
    {
        $this->middleware('auth');
        $this->device_group = $device_group;
        $this->room = $room;
        $this->device_group_info = $device_group_info;
    }

    public function index()
    {
        $groups = $this->device_group::all();
        return view('apps.dashboard.device_group.index', compact('groups'));
    }

    public function create()
    {
        $rooms = $this->room::all();
        return view('apps.dashboard.device_group.add', compact('rooms'));
    }

    public function store(Request $request)
    {
        $this->device_group->create([
            'name' => $request->name,
            'room_id' => $request->room_id,
        ]);
        alert()->success('Thành công', 'Đã thêm nhóm ' . "$request->name");
        return redirect()->route('device-group.index');
    }

    public function edit($id)
    {
        $rooms = $this->room::all();
        $device_group = $this->device_group->find($id);
        return view('apps.dashboard.device_group.edit', compact('device_group', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $this->device_group->find($id)->update([
            'name' => $request->name,
            'room_id' => $request->room_id,
        ]);
        alert()->success('Cập nhật thành công');
        return redirect()->route('device-group.index');
    }

    public function detail($id)
    {
        $i = 1;
        $devices = $this->device_group_info::where('device_group_id', $id)->get();
        $ids = $this->device_group->find($id);
        return view('apps.dashboard.device_group.info', compact('devices', 'i', 'ids'));
    }

    public function deleteDeviceFromGroup($id)
    {
        $ids = $this->device_group_info->find($id);
//        dd($ids->id);
        $this->device_group_info->find($id)->delete();
        $this->device_group::where('id', $ids->device_group_id)->decrement('qty', 1);
        DB::table('devices')->where('id', $ids->device_id)->update([
            'device_group_id' => null,
        ]);
        return $this->successResponse();
    }

    public function addDeviceToGroup(Request $request)
    {
        foreach ($request->device_id as $item) {
            $this->device_group_info->create([
                'device_group_id' => $request->dg_id,
                'device_id' => $item,
            ]);
            $this->device_group::where('id', $request->dg_id)->increment('qty', 1);
            DB::table('devices')->where('id', $item)->update([
                'device_group_id' => $request->dg_id,
            ]);
        }
        alert()->success('Thêm thiết bị vào nhóm thành công');
        return redirect()->route('device-group.detail', ['id' => $request->dg_id]);
    }

    public function delete($id)
    {
        $this->device_group->find($id)->delete();
        return $this->successResponse();
    }
}
