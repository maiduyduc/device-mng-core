<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use App\Models\Models\apps\Document;
use App\Models\Models\apps\Handover;
use App\Models\Models\apps\Room;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class ReportsController extends Controller
{
    private $device;
    private $room;

    public function __construct(Device $device, Room $room)
    {
        $this->device = $device;
        $this->room = $room;
    }

    public function index(Request $request)
    {
        if ($request->has('room')) {
            $type = 'room';
            $rooms = $this->room->all();
            $data = array();
            $i = 0;
            foreach ($rooms as $room){
                array_push($data, $this->getRoomData($room->id));
            }
            return view('apps.dashboard.reports.index', [
                'rooms' => $rooms,
                'type' => $type,
                'data' => $data,
                'i' => $i
            ]);
        } else {
            $type = 'all';
            $devices = $this->device::all()->count();
            $deviceErrors = $this->device->where('status', 'error')->count();
            $deviceInStocks = $this->device->where('room_id', null)->count();
            $deviceLiquidate = $this->device->where('status', 'liquidate')->count();
            $deviceInLiquidate = $this->device->where('status', 'in_order_liquidate')->count();
            $deviceLiquidated = $this->device->where('status', 'liquidated')->count();
            return view('apps.dashboard.reports.index', [
                'type' => $type,
                'devices' => $devices,
                'deviceErrors' => $deviceErrors,
                'deviceInStocks' => $deviceInStocks,
                'deviceLiquidate' => $deviceLiquidate,
                'deviceInLiquidate' => $deviceInLiquidate,
                'deviceLiquidated' => $deviceLiquidated
            ]);
        }
    }

    public function getRoomData($room_id)
    {
        $roomName = $this->room->where('id', $room_id)->select('name')->pluck('name');
        $devices = $this->device->where('room_id', $room_id)->count();
        $deviceError = $this->device
            ->where('room_id', $room_id)
            ->where('status', 'error')
            ->count();
        $deviceOnRepair = $this->device
            ->where('room_id', $room_id)
            ->where('status', 'fixing')
            ->count();
        $deviceLiquidated = $this->device
            ->where('room_id', $room_id)
            ->where('status', 'liquidated')
            ->count();
        return [
            'roomName' => $roomName,
            'devices' => $devices,
            'deviceError' => $deviceError,
            'deviceOnRepair' => $deviceOnRepair,
            'deviceLiquidated' => $deviceLiquidated
        ];
    }
}
