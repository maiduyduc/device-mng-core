<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\AutoInventory;
use App\Models\AutoInventoryInfo;
use App\Models\Inventory;
use App\Models\InventoryInfo;
use App\Models\Models\apps\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoInventoryController extends Controller
{
    private $device;
    private $inventory;
    private $inventory_info;

    public function __construct(Device $device, AutoInventory $inventory, AutoInventoryInfo $inventory_info)
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
            ->where('status','<>' ,'liquidated')
            ->groupBy('device_name', 'room_id')
            ->orderBy('room_id', 'ASC')
            ->get();
        return view('apps.dashboard.inventories.auto-inventories.add', compact('datas'));
    }

    public function store(Request $request)
    {
        $datas = $this->device
            ->select('device_name', 'room_id', DB::raw('Count(device_name) as qty'), DB::raw('Count(case `status` when "error" then 1 else null end) as Error'))
            ->where('status','<>' ,'liquidated')
            ->groupBy('device_name', 'room_id')
            ->orderBy('room_id', 'ASC')
            ->get();
//        dd($datas);
        try {
            DB::beginTransaction();
            $auto_inventory = $this->inventory->create([
                'document_prefix_id' => 6,
                'note' => $request->note
            ]);

            foreach ($datas as $data){
                $this->inventory_info->create([
                    'auto_inventory_id' => $auto_inventory->id,
                    'device_name' => $data->device_name,
                    'room_id' => $data->room_id,
                    'qty' => $data->qty,
                    'error_qty' => $data->Error
                ]);
            }
            DB::commit();
            alert()->success('', 'Thêm mới thành công!');
            return redirect()->route('auto-inventory.index');
        } catch (\Exception $exception){
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('auto-inventory.create');
        }


    }

    public function detail($id)
    {
        $ids = $this->inventory->find($id)->get();
        $datas = $this->inventory_info->where('auto_inventory_id', $id)->get();
//        dd($datas);
        return view('apps.dashboard.inventories.auto-inventories.show', compact('ids', 'datas'));
    }
}
