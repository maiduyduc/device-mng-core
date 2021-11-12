<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use App\Models\Models\apps\HistoryDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    private $device;
    private $history;

    public function __construct(Device $device, HistoryDevice $history)
    {
        $this->device = $device;
        $this->history = $history;
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

    public function active($id): \Illuminate\Http\RedirectResponse
    {

        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('Lỗi', 'Bạn không có quyền chỉnh sửa mục này');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'active'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->full_number,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'Cập nhật trạng thái thiết bị từ "' . $device_status . '" thành "Đang sử dụng"',
            ]);
            alert()->success('Thành công', 'Đã cập nhật trạng thái thiết bị ' . $device[0]->full_number . ' thành "Đang sử dụng"');
        }

        return back();
    }

    public function inactive($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('Lỗi', 'Bạn không có quyền chỉnh sửa mục này');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'inactive'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->full_number,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'Cập nhật trạng thái thiết bị từ "' . $device_status . '" thành "Chưa sử dụng"',
            ]);
            alert()->success('Thành công', 'Đã cập nhật trạng thái thiết bị ' . $device[0]->full_number . ' thành "Chưa sử dụng"');
        }
        return back();
    }

    public function error($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('Lỗi', 'Bạn không có quyền chỉnh sửa mục này');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'error'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->full_number,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'Cập nhật trạng thái thiết bị từ "' . $device_status . '" thành "Hỏng"',
            ]);
            alert()->success('Thành công', 'Đã cập nhật trạng thái thiết bị ' . $device[0]->full_number . ' thành "Hỏng"');
        }
        return back();
    }

    public function fixing($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('Lỗi', 'Bạn không có quyền chỉnh sửa mục này');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'fixing'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->full_number,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'Cập nhật trạng thái thiết bị từ "' . $device_status . '" thành "Đang sửa"',
            ]);
            alert()->success('Thành công', 'Đã cập nhật trạng thái thiết bị ' . $device[0]->full_number . ' thành "Đang sửa"');
        }

        return back();
    }

    public function liquidate($id): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->menuroles != 'ktv') {
            alert()->error('Lỗi', 'Bạn không có quyền chỉnh sửa mục này');
        } else {
            $device = $this->device->where('id', $id)->get();
            $this->device->find($id)->update([
                'status' => 'liquidate'
            ]);
            foreach (config('status.device') as $status => $item)
                if ($status == $device[0]->status)
                    $device_status = $item;
            $this->history->create([
                'device_id' => $device[0]->full_number,
                'device_name' => $device[0]->device_name,
                'date_modified' => now(),
                'note' => 'Cập nhật trạng thái thiết bị từ "' . $device_status . '" thành "Xin thanh lý"',
            ]);
            alert()->success('Thành công', 'Đã cập nhật trạng thái thiết bị ' . $device[0]->full_number . ' thành "Xin thanh lý"');
        }
        return back();
    }

    public function detail($id)
    {

    }
}
