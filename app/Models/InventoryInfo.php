<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryInfo extends Model
{
    use HasFactory;
    protected $table = 'inventory_info';
    protected $guarded = [];
}
