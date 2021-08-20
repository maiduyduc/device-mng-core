<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $guarded = [];

    public function Device(){
        return $this->hasMany(Device::class, 'room_id');
    }
}
