<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BrandModels;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    protected $table = "car_brands";
    protected $fillable = ['brand','logo','checked'];
    
    public function models()
    {
        return $this->hasMany(BrandModels::class);
    }
    public function customers()
    {
        return $this->hasMany(Customers::class, 'brand_id');
    }
    public function revisions()
    {
        return $this->hasMany(CustomerRevisions::class, 'brand_id')->where('revision_id','!=', 0);
    }
}
