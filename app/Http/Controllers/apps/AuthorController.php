<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData($id)
    {
        $message = DB::table('document_devices')->where('document_id', $id)->get();
        $code = DB::table('document')->where('id', $id)->get();
        return view('apps.dashboard.ajax.ajax-message', ['message' => $message, 'code' => $code]);
    }

    public function getRoom($id)
    {
        /*
        lấy ra danh sách phòng
        */
        $rooms = DB::table('rooms')->get();
        $code = DB::table('document')->where('id', $id)->get();

        return view('apps.dashboard.ajax.ajax-rooms', ['rooms' => $rooms, 'code' => $code]);
    }

    public function getDevicePlan()
    {
        $i = 0;
        $datas = DB::table('device_plans')
            ->where('status', 'accept')
            ->where('is_export', 0)
            ->where('num_device_not_use', '>', '0')
            ->get();

        if ($datas->count() != 0) {
            for ($j = 0; $j < $datas->count(); $j++) {
                $data_devices[] = DB::table('device_plan_infos')
                    ->where('device_plan_id', '=', $datas[$j]->id)
                    ->where('is_buy', '=', 1)
                    ->where('is_in_use', '=', 0)
                    ->get();
            }
            return view('apps.dashboard.ajax.ajax-device-plan', ['datas' => $datas, 'i' => $i, 'data_devices' => $data_devices]);
        } else {
            return view('apps.dashboard.ajax.ajax-device-plan', compact('datas'));
        }
    }

    public function getDocument()
    {
        $i = 0;
        $datas = DB::table('documents')
            ->where('status', 'accept')
            ->where('is_export', 0)
            ->get();
        if ($datas->count() != 0) {
            for ($j = 0; $j < $datas->count(); $j++) {
                $data_devices[] = DB::table('document_infos')
                    ->where('document_id', '=', $datas[$j]->id)
                    ->get();
            }
            return view('apps.dashboard.ajax.ajax-document', ['datas' => $datas, 'i' => $i, 'data_devices' => $data_devices]);
        } else {
            return view('apps.dashboard.ajax.ajax-document', compact('datas'));
        }
    }

    public function getDeviceLiquidate()
    {
        $i = 1;
        $datas = DB::table('devices')
            ->where('status', 'liquidate')
            ->get();
        if ($datas->count() != 0) {
            return view('apps.dashboard.ajax.ajax-liquidate', ['datas' => $datas, 'i' => $i]);
        } else {
            return view('apps.dashboard.ajax.ajax-liquidate', compact('datas'));
        }
    }

    public function developing()
    {
        return view('errors.developing');
    }
}
