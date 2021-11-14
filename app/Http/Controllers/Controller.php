<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse()
    {
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }

    public function failResponse()
    {
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ], 500);
    }

    public function updateWhenApproved($document_prefix_id)
    {
        //cập nhật dữ liệu bảng document_system khi thực hiện phê duyệt văn bản bất kì

        //tăng số lượng văn bản đã phê duyệt lên 1 đơn vị
        DB::table('document_systems')->where('document_id', $document_prefix_id)->increment('approved', 1);
        //===============

        //tăng số lượng văn bản đã duyệt nhưng chưa sử dụng lên 1 đơn vị
        DB::table('document_systems')->where('document_id', $document_prefix_id)->increment('approved_but_not_use');
        //===============


        $pending = DB::table('document_systems')->where('document_id', $document_prefix_id)->pluck('pending');
        //giảm số lượng văn bản chờ xử lý xuống 1 đơn vị
        if($pending[0] > 0)
        DB::table('document_systems')->where('document_id', $document_prefix_id)->decrement('pending');
        //===============
    }

    public function updateWhenRefuse($document_prefix_id)
    {
        //cập nhật dữ liệu bảng document_system khi thực hiện từ chối văn bản bất kì

        //tăng số lượng văn bản đã từ chối lên 1 đơn vị
        DB::table('document_systems')->where('document_id', $document_prefix_id)->increment('refuse');
        //===============

        $pending = DB::table('document_systems')->where('document_id', $document_prefix_id)->pluck('pending');
        //giảm số lượng văn bản chờ xử lý xuống 1 đơn vị
        if($pending[0] > 0)
        DB::table('document_systems')->where('document_id', $document_prefix_id)->decrement('pending');
        //===============
    }

    public function updateWhenExport($document_prefix_id)
    {
        //cập nhật dữ liệu bảng document_system khi thực hiện xuất thông tin văn bản bất kì
        $approved_but_not_use = DB::table('document_systems')->where('document_id', $document_prefix_id)->pluck('approved_but_not_use');
        //giảm số lượng văn bản đã duyệt nhưng chưa sử dụng đi 1 đơn vị
        if($approved_but_not_use[0] > 0)
        DB::table('document_systems')->where('document_id', $document_prefix_id)->decrement('approved_but_not_use');
        //===============
    }

    public function updateWhenCreate($document_prefix_id)
    {
        //cập nhật dữ liệu bảng document_system khi thực hiện tạo văn bản bất kì

        //tăng tổng số lượng văn bản lên 1 đơn vị
        DB::table('document_systems')->where('document_id', $document_prefix_id)->increment('total');
        //===============

        //tăng số lượng văn bản chờ xử lý lên 1 đơn vị
        DB::table('document_systems')->where('document_id', $document_prefix_id)->increment('pending');
        //===============
    }

    public function updateWhenDelete($document_prefix_id)
    {
        //cập nhật dữ liệu bảng document_system khi thực hiện xóa văn bản bất kì
        //lưu ý: chỉ văn bản ở trạng thái "chờ xử lý" (pending) mới xóa được

        $pending = DB::table('document_systems')->where('document_id', $document_prefix_id)->pluck('pending');
        //giảm số lượng văn bản chờ xử lý xuống 1 đơn vị
        if($pending[0] > 0)
        DB::table('document_systems')->where('document_id', $document_prefix_id)->decrement('pending');
        //===============

        $total = DB::table('document_systems')->where('document_id', $document_prefix_id)->pluck('total');
        //giảm tổng số lượng văn bản đi 1 đơn vị
        if($total[0] > 0 )
        DB::table('document_systems')->where('document_id', $document_prefix_id)->decrement('total');
        //===============
    }
}
