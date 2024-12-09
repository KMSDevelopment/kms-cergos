<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RevisionParts extends Model
{
    protected $table = "car_model_type_variant_parts";
    
    protected $fillable = ['brand_id','model_id','model_type_id','variant_id','distributor_id','ref','code','name','img','purchase_price','purchase_price_inc_vat','stock','stock_location'];

    public function linkedparts()
    {
        return $this->hasMany(LinkedParts::class);
    }
}
