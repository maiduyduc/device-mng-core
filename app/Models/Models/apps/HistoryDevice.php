<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDevice extends Model
{
    use HasFactory;
    protected $table = 'history_devices';
    protected $guarded = [];
}
