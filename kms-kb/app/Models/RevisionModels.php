<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RevisionModels extends Model
{
    protected $table = "revision_models";
    protected $fillable = ['revision_id','brand_id','model_id','type_id','variant_id'];
    
    public function model()
    {
        return $this->hasOne(BrandModels::class, 'id');
    }
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id');
    }
    public function revision()
    {
        return $this->hasOne(Revisions::class, 'id');
    }
}
