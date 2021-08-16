<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentInfo extends Model
{
    use HasFactory;
    protected $table = 'document_infos';
    protected $guarded = [];
}
