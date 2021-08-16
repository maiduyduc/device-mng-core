<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\DevicePlan;
use App\Models\Models\apps\DevicePlanInfo;
use App\Models\Models\apps\Document;
use App\Models\Models\apps\DocumentInfo;
use App\Models\Models\apps\Handover;
use App\Models\Models\apps\HandoverInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DevicePlanController extends Controller
{
    private $device_plan;
    private $device_plan_list;
    private $document;
    private $document_info;

    public function __construct(DevicePlan $device_plan, DevicePlanInfo $device_plan_list, Document $document, DocumentInfo $document_info)
    {
        $this->device_plan = $device_plan;
        $this->device_plan_list = $device_plan_list;
        $this->document = $document;
        $this->document_info = $document_info;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $i = 1;
        if($request->has('pending')){
            $device_plans = $this->device_plan::where('status','pending')->get();
        }else{
            $device_plans = $this->device_plan::all();
        }
        return view('apps.dashboard.device_plan.index', compact('device_plans', 'i'));
    }

    public function create()
    {
        return view('apps.dashboard.device_plan.add');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'device_name.*' => ['required', 'max:191'],
                'qty.*' => ['required', 'min:1', 'regex:/^[0-9]+$/u'],
                'device_info.*' => [],
                'note.*' => []
            ]);

            $countDevice = count($request->device_name);
            $device_plan = $this->device_plan->create([
                'qty' => array_sum($request->qty),
                'note' => $request->detail,
                'document_prefix_id' => 2,
                'num_device_not_use' => 0,
            ]);

            for ($i = 0; $i < $countDevice; $i++) {
                $this->device_plan_list->create([
                    'device_plan_id' => $device_plan->id,
                    'device_name' => $request->device_name[$i],
                    'category_id' => $request->category_id[$i],
                    'device_info' => $request->device_info[$i],
                    'qty' => $request->qty[$i],
                    'note' => $request->note[$i]
                ]);
            }
            DB::commit();
            alert()->success('', 'Thêm mới thành công!');
            return redirect()->route('device-plan.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('device-plan.index');
        }
    }

    public function edit($id)
    {
        $device_plan_id = $this->device_plan->find($id);
        $i = 1;
        return view('apps.dashboard.device_plan.edit', compact('i', 'device_plan_id'));
    }

    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'device_name.*' => ['required', 'max:191'],
                'qty.*' => ['required', 'min:1', 'regex:/^[0-9]+$/u'],
                'device_info.*' => [],
                'note.*' => []
            ]);

            $countDevice = count($request->device_name);
            $this->device_plan->find($id)->update([
                'qty' => array_sum($request->qty),
                'note' => $request->detail,
            ]);

            $this->device_plan_list->where('device_plan_id', $id)->delete();
            for ($i = 0; $i < $countDevice; $i++) {
                $this->device_plan_list->create([
                    'device_plan_id' => $id,
                    'device_name' => $request->device_name[$i],
                    'category_id' => $request->category_id[$i],
                    'device_info' => $request->device_info[$i],
                    'qty' => $request->qty[$i],
                    'note' => $request->note[$i]
                ]);
            }
            DB::commit();
            alert()->success('', 'Cập nhật thành công!');
            return redirect()->route('device-plan.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            alert()->error("Lỗi", 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->route('device-plan.index');
        }
    }

    public function delete($id): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->device_plan->find($id)->delete();
            $this->device_plan_list::where('device_plan_id', $id)->delete();
            DB::commit();
            return $this->successResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            return $this->failResponse();
        }
    }

    public function info($id)
    {
        $i = 1;
        $is_buy_count = DB::table('device_plan_infos')
            ->where('device_plan_id', '=', $id)
            ->where('is_buy', '=', 0)
            ->count();
        $device_plan_list_infos = $this->device_plan_list->where('device_plan_id', $id)->get();
        $code = $this->device_plan->where('id', $id)->get();
        return view('apps.dashboard.device_plan.info', compact('i', 'device_plan_list_infos', 'code', 'is_buy_count'));
    }

    public function approve($id): \Illuminate\Http\RedirectResponse
    {
        $edited = $this->device_plan->where('id', $id)->get();
        if ($edited[0]->status == 'accept') {
            alert()->info('', 'Đã phê duyệt yêu cầu này rồi');
        } else {
            $this->device_plan->find($id)->update([
                'status' => 'accept',
                'can_edit' => 0,
                'can_export' => 1,
            ]);
            alert()->success('', 'Phê duyệt thành công!');
        }
        return redirect()->route('device-plan.info', ['id' => $id]);
    }

    public function refuse($id): \Illuminate\Http\RedirectResponse
    {
        $edited = $this->device_plan->where('id', $id)->get();
        if ($edited[0]->status == 'cancel') {
            alert()->info('', 'Yêu cầu này đã bị từ chối rồi!');
        } else {
            $this->device_plan->find($id)->update([
                'status' => 'cancel',
                'can_edit' => 0,
            ]);
            alert()->success('Thành công', 'Đã từ chối yêu cầu');
        }
        return redirect()->route('device-plan.info', ['id' => $id]);
    }

    public function isBuyUpdate($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        //kiểm tra xem thiết bị trong phiếu dự trù đã đc mua chưa
        $is_buy_count = DB::table('device_plan_infos')
            ->where('device_plan_id', '=', $id)
            ->where('is_buy', '=', 0)
            ->count();
        if ($is_buy_count == 0) {
            //nếu đã mua đủ rồi thì không thể chỉnh sửa nữa
            alert()->info('', 'Không thể chỉnh sửa nội dung này.');
        } else {
            if ($request->has('buy_check')) {
                DevicePlanInfo::where('device_plan_id', $id)->whereIn('id', $request->buy_check)->update(['is_buy' => 1]);
                DevicePlanInfo::where('device_plan_id', $id)->whereNotIn('id', $request->buy_check)->update(['is_buy' => 0]);
                DevicePlan::find($id)->update([
                    'num_device_not_use' => count($request->buy_check)
                ]);
            } else {
                DevicePlanInfo::where('device_plan_id', $id)->update(['is_buy' => 0]);
                DevicePlan::find($id)->update([
                    'num_device_not_use' => 0
                ]);
            }
            alert()->success('', 'Cập nhật trạng thái thành công');
        }
        return redirect()->route('device-plan.info', ['id' => $id]);
    }

    public function export($id)
    {
        $is_buy = $this->device_plan_list->where('device_plan_id', $id)->where('is_buy', '=', 1)->count();
        $edited = $this->device_plan->where('id', $id)->get();
//        dd($is_buy);
        if ($edited[0]->is_export == 1) {
            alert()->info('Không thể xuất thông tin', 'Dữ liệu đã tồn tại');
            return redirect()->route('device-plan.info', ['id' => $id]);
        } elseif ($is_buy == 0) {
            alert()->info('Không thể xuất thông tin', 'Không có thông tin thiết bị đã mua');
            return redirect()->route('device-plan.info', ['id' => $id]);
        } else {
            try {
                DB::beginTransaction();
                $countDevice = $this->device_plan_list->where('device_plan_id', $id)->count(); //đếm số lượng thiết bị
                $infos = $this->device_plan_list->where('device_plan_id', $id)
                    ->where('is_buy', 1)
                    ->where('is_in_use', 0)
                    ->get();
                $this->device_plan->find($id)->update([
                    'can_export' => 0,
                    'is_export' => 1,
                ]);

                $document = $this->document->create([
                    'qty' => $edited[0]->qty,
                    'document_prefix_id' => 1,
                    'code' => $edited[0]->full_number,
                ]);

                for ($i = 0; $i < $countDevice; $i++) {
                    $this->document_info->create([
                        'document_id' => $document->id,
                        'category_id' => $infos[$i]->category_id,
                        'device_prefix_id' => 1,
                        'device_name' => $infos[$i]->device_name,
                        'device_info' => $infos[$i]->device_info,
                        'unit' => $infos[$i]->unit,
                        'order_qty' => $infos[$i]->qty,
                        'recommended_qty' =>$infos[$i]->qty,
                        'note' => $infos[$i]->note
                    ]);
                }
                DB::commit();
                alert()->success('', 'Xuất thông tin thành công!');
                return redirect()->route('document.info', ['id' => $document->id]);
            } catch (\Exception $exception) {
                DB::rollBack();
                log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
                alert()->error('Lỗi', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
                return redirect()->route('device-plan.info', ['id' => $id]);
            }
        }
    }
}
