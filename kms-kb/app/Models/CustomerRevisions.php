<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerRevisions extends Model
{
    protected $table = "customer_revisions";
    protected $fillable = ['revision_id','api_id','odoo_id','mgr_id','ticket_no','brand_id','customer_id','user_id_assigned','start','end','status','sales_price'];
    //
    public function engineer()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id');
    }
    public function brand()
    {
        return $this->hasOne(Brand::class);
    }
    public function api()
    {
        return $this->hasOne(Brand::class);
    }
}
