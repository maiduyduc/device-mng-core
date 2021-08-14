<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
