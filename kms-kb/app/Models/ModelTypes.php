<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelTypes extends Model
{
    protected $table = "car_model_types";
    
    protected $fillable = ['brand_id','model_id','type'];

    public function variants()
    {
        return $this->hasMany(ModelTypeVariants::class, 'type_id');
    }
}
