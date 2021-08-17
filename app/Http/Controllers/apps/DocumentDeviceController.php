<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Document;
use App\Models\Models\apps\DocumentInfo;
use App\Models\Models\apps\Handover;
use App\Models\Models\apps\HandoverInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentDeviceController extends Controller
{
    private $document;
    private $document_info;
    protected $handover_list;
    protected $handover;

    public function __construct(Document $document, DocumentInfo $document_info, HandoverInfo $handover_list, Handover $handover)
    {
        $this->document = $document;
        $this->document_info = $document_info;
        $this->handover_list = $handover_list;
        $this->handover = $handover;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $i = 1;
        if($request->has('pending')){
            $documents = $this->document::where('status','pending')->get();
        }else{
            $documents = $this->document::all();
        }
        return view("apps.dashboard.documents.index", compact("documents", "i"));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        $device_prefix = DB::table('device_prefixes')->get();
        return view("apps.dashboard.documents.add", compact('categories', 'device_prefix'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'device_name.*' => ['required', 'max:191'],
                'order_qty.*' => ['required', 'min:0', 'regex:/^[0-9]+$/u'],
                'stock.*' => ['required', 'min:0', 'regex:/^[0-9]+$/u'],
                'device_prefix_id.*' => [],
                'recommended_qty.*' => ['required', 'min:0', 'regex:/^[0-9]+$/u'],
                'unit_price.*' => ['required', 'min:0', 'regex:/^[0-9]+$/u'],
                'total_money.*' => ['required', 'min:0', 'regex:/^[0-9]+$/u'],
            ]);

            $countDevice = count($request->device_name);
            //create value for document_info
            $document = $this->document->create([
                'qty' => array_sum($request->order_qty),
                'document_prefix_id' => 1
            ]);

            for ($i = 0; $i < $countDevice; $i++) {
                $this->document_info->create([
                    'document_id' => $document->id,
                    'device_name' => $request->device_name[$i],
                    'category_id' => $request->category_id[$i],
                    'device_prefix_id' => $request->device_prefix_id[$i],
                    'origin' => $request->origin[$i],
                    'unit' => $request->unit[$i],
                    'order_qty' => $request->order_qty[$i],
                    'stock' => $request->stock[$i],
                    'recommended_qty' => $request->recommended_qty[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total_money' => $request->total_money[$i],
                    'device_info' => $request->device_info[$i],
                    'note' => $request->note[$i]
                ]);
            }
            DB::commit();
            alert()->success('','Thêm mới thành công');
            return redirect()->route('document.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('document.index');
        }
    }

    public function edit($id)
    {
        $document_id = $this->document->find($id);
        if($document_id->can_edit == 0){
            alert()->error('Lỗi','Không thể chỉnh sửa văn bản đã phê duyệt/ từ chối.');
            return redirect()->route('document.info', ['id' => $id]);
        }
        $i = 1;
        $categories = DB::table('categories')->get();
        $device_prefix = DB::table('device_prefixes')->get();
        return view('apps.dashboard.documents.edit', compact('document_id', 'i', 'categories', 'device_prefix'));
    }

    public function update(Request $request, $id)
    {
        $edited = $this->document->where('id', $id)->get();
        if($edited[0]->can_edit == 0){
            alert()->error('Lỗi','Không thể chỉnh sửa văn bản đã phê duyệt/ từ chối.');
            return redirect()->route('document.info', ['id' => $id]);
        }
        try {
            DB::beginTransaction();
            $countDevice = count($request->device_name);
            //create value for document_info
            $this->document->find($id)->update([
                'qty' => array_sum($request->order_qty),
                'status' => 'pending',
            ]);
            $this->document_info->where('document_id', $id)->delete();
            for ($i = 0; $i < $countDevice; $i++) {
                $this->document_info->create([
                    'document_id' => $id,
                    'device_name' => $request->device_name[$i],
                    'category_id' => $request->category_id[$i],
                    'device_prefix_id' => $request->device_prefix_id[$i],
                    'origin' => $request->origin[$i],
                    'unit' => $request->unit[$i],
                    'order_qty' => $request->order_qty[$i],
                    'stock' => $request->stock[$i],
                    'recommended_qty' => $request->recommended_qty[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total_money' => $request->total_money[$i],
                    'device_info' => $request->device_info[$i],
                    'note' => $request->note[$i]
                ]);
            }
            DB::commit();
            alert()->success('Cập nhật thành công');
            return redirect()->route('document.info', ['id' => $id]);
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('document.info', ['id' => $id]);
        }
    }

    public function approve($id)
    {
        $edited = $this->document->where('id', $id)->get();
        if ($edited[0]->status == 'accept') {
            alert()->info('', 'Yêu cầu này đã được phê duyệt rồi!');
        } else {
            $this->document->find($id)->update([
                'status' => 'accept',
                'can_edit' => 0,
                'can_export' => 1,
            ]);
            alert()->success('Thành công', 'Đã phê duyệt yêu cầu này');
        }
        return redirect()->route('document.info', ['id' => $id]);
    }

    public function refuse($id)
    {
        $edited = $this->document->where('id', $id)->get();
        if ($edited[0]->status == 'cancel') {
            alert()->info('', 'Yêu cầu này đã bị từ chối rồi!');
        } else {
            $this->document->find($id)->update([
                'status' => 'cancel',
                'can_edit' => 0,
            ]);
            alert()->success('Thành công', 'Đã từ chối yêu cầu');
        }
        return redirect()->route('document.info', ['id' => $id]);
    }

    public function info($id)
    {
        $i = 1;
        $infos = $this->document_info->where('document_id', $id)->get();
        $total_money = $this->document_info->where('document_id', $id)->sum('total_money');
        $code = $this->document->where('id', $id)->get();
        return view('apps.dashboard.documents.info', compact('infos', 'code', 'total_money', 'i'));
    }

    public function export($id)
    {
        $edited = $this->document->where('id', $id)->get();
        if ($edited[0]->is_export == 1) {
            alert()->info('Không thể xuất thông tin', 'Dữ liệu đã tồn tại');
            return redirect()->route('document.info', ['id' => $id]);
        } else {
            try {
                DB::beginTransaction();
                $countDevice = $this->document_info->where('document_id', $id)->count();
                $infos = $this->document_info->where('document_id', $id)->get();
                $this->document->find($id)->update([
                    'can_export' => 0,
                    'is_export' => 1,
                ]);
                $handover = $this->handover->create([
                    'qty' => $edited[0]->qty,
                    'document_prefix_id' => 3,
                    'code' => $edited[0]->full_number,
                ]);

                for ($i = 0; $i < $countDevice; $i++) {
                    $this->handover_list->create([
                        'handover_id' => $handover->id,
                        'category_id' => $infos[$i]->category_id,
                        'device_prefix_id' => $infos[$i]->device_prefix_id,
                        'device_name' => $infos[$i]->device_name,
                        'device_info' => $infos[$i]->device_info,
                        'origin' => $infos[$i]->origin,
                        'unit' => $infos[$i]->unit,
                        'qty' => $infos[$i]->recommended_qty,
                        'note' => $infos[$i]->note
                    ]);
                }
                DB::commit();
                alert()->success('', 'Xuất thông tin thành công!');
                return redirect()->route('handover.info', ['id' => $handover->id]);
            } catch (\Exception $exception) {
                DB::rollBack();
                log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
                alert()->error('Lỗi', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
                return redirect()->route('document.info', ['id' => $id]);
            }
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $info = $this->document->where('id', $id)->get();
            $this->document->find($id)->delete();
            $this->document_info::where('document_id', $id)->delete();
            DB::table('device_plans')->where('full_number', $info[0]->code)->update([
                'can_export' => 1,
                'is_export' => 0
            ]);
            DB::commit();
            return $this->successResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            return $this->failResponse();
        }
    }
}
