<?php

namespace App\Models;

use App\Models\Models\apps\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoInventoryInfo extends Model
{
    use HasFactory;
    protected $table = 'auto_inventory_infos';
    protected $guarded = [];

    public function Room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
