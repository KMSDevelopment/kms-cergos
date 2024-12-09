<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Customers extends Model
{
    protected $table = "customers";
    protected $fillable = ['api_id','odoo_id','mgr_id','brand_id','firstname','lastname','email','phonenr','address','zipcode','city','country'];
    	
    public function revisions()
    {
        return $this->hasMany(CustomerRevisions::class, 'customer_id');
    }
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id');
    }
    public function model()
    {
        return $this->hasOne(BrandModels::class);
    }
    public function api()
    {
        return $this->hasOne(Api::class, 'id');
    }
}
