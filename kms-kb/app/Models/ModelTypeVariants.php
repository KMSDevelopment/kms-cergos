<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelTypeVariants extends Model
{
    protected $table = "car_model_types_variants";
    
    protected $fillable = ['brand_id','model_id','type_id','variant','build'];

    
    public function model_type()
    {
        return $this->belongsTo(ModelTypes::class, 'id');
    }
}
