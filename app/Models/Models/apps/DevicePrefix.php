<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicePrefix extends Model
{
    use HasFactory;
    protected $table = 'device_prefixes';
    public $timestamps = false;

    public function Device(){
        return $this->hasMany(Device::class, 'device_prefix_id');
    }
}
