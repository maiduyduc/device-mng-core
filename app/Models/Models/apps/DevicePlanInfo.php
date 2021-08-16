<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicePlanInfo extends Model
{
    use HasFactory;
    protected $table = 'device_plan_infos';
    protected $guarded = [];
}
