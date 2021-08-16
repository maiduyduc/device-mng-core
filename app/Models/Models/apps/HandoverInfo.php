<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverInfo extends Model
{
    use HasFactory;
    protected $table = 'handover_infos';
    protected $guarded = [];
}
