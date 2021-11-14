<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentSystem extends Model
{
    use HasFactory;
    protected $table = 'document_systems';
    protected $guarded = [];

    public function DocumentPrefix(){
        return $this->belongsTo(DocumentPrefix::class, 'document_id');
    }
}
