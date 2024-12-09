<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BrandModels extends Model
{
    protected $table = "car_brand_models";
    
    protected $fillable = ['id', 'brand_id','model','img'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function revision_models()
    {
        return $this->HasOne(RevisionModels::class, 'model_id');
    }
    public function customers()
    {
        return $this->hasMany(Customers::class, 'model_id');
    }
}
