<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    private $inventory;
    private $inventory_info;

    public function __construct(Inventory $inventory, InventoryInfo $inventory_info)
    {
        $this->inventory = $inventory;
        $this->inventory_info = $inventory_info;
    }

    public function index()
    {
        $inventories = $this->inventory::all();
        return view('apps.dashboard.inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('apps.dashboard.inventories.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $countDevice = count($request->device_name);

            $inventory = $this->inventory->create([
                'qty' => array_sum($request->qty_inventory),
                'document_prefix_id' => 4,
                'note' => $request->detail
            ]);

            for ($i = 0; $i < $countDevice; $i++) {
                $this->inventory_info->create([
                    'inventory_id' => $inventory->id,
                    'device_name' => $request->device_name[$i],
                    'device_code' => $request->device_code[$i],
                    'serial' => $request->serial[$i],
                    'date_purchase' => $request->date_purchase[$i],
                    'unit' => $request->unit[$i],
                    'qty_document' => $request->qty_document[$i],
                    'price_document' => $request->price_document[$i],
                    'qty_inventory' => $request->qty_inventory[$i],
                    'price_inventory' => $request->price_inventory[$i],
                    'funds' => $request->funds[$i],
                    'estimate_price' => $request->estimate_price[$i],
                    'note' => $request->note[$i]
                ]);
            }

            DB::commit();
            alert()->success('', 'Thêm mới thành công');
            return redirect()->route('inventory.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            alert()->error('Lỗi', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return back();
        }
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }

    public function detail($id)
    {

    }
}
