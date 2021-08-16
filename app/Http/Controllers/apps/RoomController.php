<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use App\Models\Models\apps\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $room;
    private $device;

    public function __construct(Room $room, Device $device)
    {
        $this->room = $room;
        $this->device = $device;
    }

    public function index()
    {
        $rooms = $this->room::all();
        return view("apps.dashboard.rooms.index", compact("rooms"));
    }

    public function create()
    {
        return view("apps.dashboard.rooms.add");
    }

    public function store(Request $request)
    {
        $this->room->create([
            'name' => $request->name,
        ]);
        return redirect()->route('room.index');
    }

    public function edit($id)
    {
        $room = $this->room->find($id);
        return view("apps.dashboard.rooms.edit", compact('room'));
    }

    public function update(Request $request, $id)
    {
        $this->room->find($id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('room.index');
    }

    public function delete($id)
    {
        $this->room->find($id)->delete();
        return $this->successResponse();
    }

    public function device($id){
        $room = $this->room->find($id);
        $devices = $this->device
            ->where('room_id', $id)
            ->where('status', '<>', 'in_order_liquidate')
            ->Where('status', '<>', 'liquidated')
            ->get();
//        dd($devices);
        return view('apps.dashboard.rooms.info', compact('devices', 'room'));
    }
}
