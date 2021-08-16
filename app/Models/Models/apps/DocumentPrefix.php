<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPrefix extends Model
{
    use HasFactory;
    protected $table = 'document_prefixes';
    public $timestamps = false;
}
