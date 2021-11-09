<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceGroupInfo extends Model
{
    use HasFactory;
    protected $table = 'device_group_infos';
    protected $guarded = [];

    public function DeviceGroup(){
        return $this->belongsTo(DeviceGroup::class, 'device_group_id');
    }

    public function Device(){
        return $this->belongsTo(Device::class, 'device_id');
    }

}
