<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    private $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = DB::table('rooms')->get();
        $categories = DB::table('categories')->get();
        return view('apps.dashboard.search.index', compact('rooms', 'categories'));
    }

    public function find(Request $request)
    {
        $txt = $request->device;
        $category = $request->category_id;
        $room = $request->room_id;
        $rooms = DB::table('rooms')->get();
        $categories = DB::table('categories')->get();
        if($request->key == 'category'){
            $devices = $this->device
                ->where('category_id', $category)
                ->where('device_name', 'like', '%' . $txt . '%')
                ->get();
        }
        elseif ($request->key == 'room'){
            $devices = $this->device
                ->where('room_id', $room)
                ->where('device_name', 'like', '%' . $txt . '%')
                ->get();
        } else{
            $devices = $this->device
                ->where('device_name', $txt)
                ->orwhere('device_name', 'like', '%' . $txt . '%')
                ->get();
        }
         return view('apps.dashboard.search.result',
             compact('devices', 'rooms', 'categories', 'txt', 'category', 'room'));
    }
}
