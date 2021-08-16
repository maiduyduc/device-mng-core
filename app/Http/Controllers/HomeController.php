<?php

namespace App\Http\Controllers;

use App\Models\Models\apps\Device;
use App\Models\Models\apps\DevicePlan;
use App\Models\Models\apps\Document;
use App\Models\Models\apps\Handover;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $device;
    private $document;
    private $devicePlan;
    private $handover;

    public function __construct(Device $device, Document $document, DevicePlan $devicePlan, Handover $handover)
    {
        $this->middleware('auth');
        $this->device = $device;
        $this->document = $document;
        $this->devicePlan = $devicePlan;
        $this->handover = $handover;
    }

    public function home()
    {
        $devices = $this->device
            ->where('status', '<>', 'in_order_liquidate')
            ->where('status', '<>', 'liquidated')
            ->count();
        $device_error = $this->device
            ->where('status', '=', 'error')
            ->count();
        $documents = $this->document
            ->where('status', 'pending')
            ->count();
        $devicePlans = $this->devicePlan
            ->where('status', 'pending')
            ->count();
        $handovers = $this->handover
            ->where('status', 'pending')
            ->count();
        $stocks = $this->device
            ->where('room_id', null)
            ->count();
        return view('apps.dashboard.index', compact('devices', 'device_error', 'documents', 'devicePlans', 'handovers','stocks'));
    }

}
