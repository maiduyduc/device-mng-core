<?php

namespace App\Http\Controllers;

use App\Models\Models\apps\Device;
use App\Models\Models\apps\DevicePlan;
use App\Models\Models\apps\Document;
use App\Models\Models\apps\DocumentSystem;
use App\Models\Models\apps\Handover;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $document_system;
    private $device;

    public function __construct(DocumentSystem $document_system, Device $device)
    {
        $this->middleware('auth');
        $this->document_system = $document_system;
        $this->device = $device;
    }

    public function home()
    {
        $devices = $this->device
            ->where('status', '<>', 'in_order_liquidate')
            ->where('status', '<>', 'liquidated')
            ->where('room_id', '<>', null)
            ->count();
        $device_error = $this->device
            ->where('status', '=', 'error')
            ->count();
        $stocks = $this->device
            ->where('room_id', null)
            ->count();
        $document_systems = $this->document_system->all();

        return view('apps.dashboard.index', compact('document_systems', 'devices', 'device_error', 'stocks'));
    }

}
