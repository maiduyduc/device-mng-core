<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceGroup extends Model
{
    use HasFactory;
    protected $table = 'device_groups';
    protected $guarded = [];

    public function Device(){
        return $this->hasMany(Device::class, 'device_group_id');
    }

    public function Room(){
        return $this->belongsTo(Room::class, 'room_id');
    }
}
