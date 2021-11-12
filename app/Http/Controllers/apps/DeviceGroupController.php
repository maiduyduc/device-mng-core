<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\DeviceGroup;
use App\Models\Models\apps\DeviceGroupInfo;
use App\Models\Models\apps\HistoryDevice;
use App\Models\Models\apps\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeviceGroupController extends Controller
{
    private $device_group_info;
    private $device_group;
    private $history;
    private $room;

    public function __construct(DeviceGroup $device_group, Room $room, DeviceGroupInfo $device_group_info, HistoryDevice $history)
    {
        $this->middleware('auth');
        $this->device_group = $device_group;
        $this->history = $history;
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
        if ($request->has('ajax'))
            return back();
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
        try {
            DB::beginTransaction();
            $ids = $this->device_group_info->find($id);;
            $this->device_group_info->find($id)->delete();
            $this->device_group::where('id', $ids->device_group_id)->decrement('qty', 1);
            DB::table('devices')->where('id', $ids->device_id)->update([
                'device_group_id' => null,
            ]);
            $name = $this->device_group::where('id', $ids->device_group_id)->pluck('name');
            $this->history->create([
                'device_id' => $ids->device_id,
                'device_name' => $ids->Device->device_name,
                'date_modified' => now(),
                'note' => 'Xóa thiết bị khỏi nhóm "' . $name[0] . '"',
            ]);

            DB::commit();

            return $this->successResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            alert()->error('Lỗi', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('device-group.detail', ['id' => $id]);
        }
    }

    public function addDeviceToGroup(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->device_id as $item) {
                $this->device_group_info->create([
                    'device_group_id' => $request->dg_id,
                    'device_id' => $item,
                ]);
                $this->device_group::where('id', $request->dg_id)->increment('qty', 1);
                DB::table('devices')->where('id', $item)->update([
                    'device_group_id' => $request->dg_id,
                ]);
                //cập nhật lịch sử thiết bị
                $device_name = DB::table('devices')->where('id', $item)->pluck('device_name');
                $group_name = $this->device_group::where('id', $request->dg_id)->pluck('name');
                $this->history->create([
                    'device_id' => $item,
                    'device_name' => $device_name[0],
                    'date_modified' => now(),
                    'note' => 'Thêm thiết bị vào nhóm "' . $group_name[0] . '"',
                ]);
            }
            alert()->success('Thêm thiết bị vào nhóm thành công');
            DB::commit();
            return redirect()->route('device-group.detail', ['id' => $request->dg_id]);

        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            alert()->error('Lỗi', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return $this->failResponse();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->device_group->find($id)->delete();
            DB::table('devices')->where('device_group_id', $id)->update([
                'device_group_id' => null,
            ]);
            DB::commit();
            return $this->successResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->failResponse();
        }
    }
}
