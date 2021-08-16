<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\HistoryDevice;
use Illuminate\Http\Request;

class HistoryDeviceController extends Controller
{
    private $history;

    public function __construct(HistoryDevice $history)
    {
        $this->history = $history;
        $this->middleware('auth');
    }

    public function index()
    {
        $histories = $this->history->all();
        return view("apps.dashboard.histories.index", compact('histories'));
    }

    public function detail($code)
    {
        $histories = $this->history->where('device_id', $code)->get();
        return view('apps.dashboard.histories.info', compact('histories'));
    }
}
