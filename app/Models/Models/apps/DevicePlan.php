<?php

namespace App\Models\Models\apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicePlan extends Model
{
    use HasFactory;
    protected $table = 'device_plans';
    protected $guarded = [];

    protected function DocumentPrefix(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DocumentPrefix::class, 'document_prefix_id');
    }

    public function DevicePlanInfo(){
        return $this->hasMany(DevicePlanInfo::class, 'device_plan_id');
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($model){
            $model->number = DevicePlan::where('document_prefix_id', $model->document_prefix_id)->max('number') + 1;
            $model->full_number = $model->DocumentPrefix->prefix . '-' . str_pad($model->number, 5, 0, STR_PAD_LEFT);
        });
    }
}
