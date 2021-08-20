<?php

namespace App\Models;

use App\Models\Models\apps\Document;
use App\Models\Models\apps\DocumentPrefix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $guarded = [];

    public function InventoryInfo(){
        return $this->hasMany(InventoryInfo::class, 'inventory_id');
    }

    protected function DocumentPrefix(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DocumentPrefix::class, 'document_prefix_id');
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($model){
            $model->number = Inventory::where('document_prefix_id', $model->document_prefix_id)->max('number') + 1;
            $model->full_number = $model->DocumentPrefix->prefix . '-' . str_pad($model->number, 5, 0, STR_PAD_LEFT);
        });
    }
}