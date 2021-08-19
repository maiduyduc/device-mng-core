<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryInfo;
use App\Models\Models\apps\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoInventoryController extends Controller
{
    private $device;
    private $inventory;
    private $inventory_info;

    public function __construct(Device $device, Inventory $inventory, InventoryInfo $inventory_info)
    {
        $this->device = $device;
        $this->inventory = $inventory;
        $this->inventory_info = $inventory_info;
    }

    public function index()
    {
        $inventories = $this->inventory::all();
        return view('apps.dashboard.inventories.auto-inventories.index', compact('inventories'));
    }

    public function create()
    {
        $datas = $this->device
            ->select('device_name', 'room_id', DB::raw('Count(device_name) as qty'), DB::raw('Count(case `status` when "error" then 1 else null end) as Error'))
            ->groupBy('device_name', 'room_id')
            ->orderBy('room_id', 'ASC')
            ->get();
        return view('apps.dashboard.inventories.auto-inventories.add', compact('datas'));
    }

    public function store(Request $request)
    {
    }

    public function detail($id)
    {
    }
}
