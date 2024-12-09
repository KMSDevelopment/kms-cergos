<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Api extends Model
{
    protected $table = "apis";
    protected $fillable = ['id', 'desc','docs','endpoint','api_route','api_point_route','type','credentials','platform','sort'];

    public function revisions()
    {
        return $this->hasMany(Revisions::class, 'api_id');
    }
    public function customers()
    {
        return $this->hasMany(Customers::class, 'api_id');
    }
    public function tickets()
    {
        return $this->hasMany(CustomerRevisions::class, 'api_id');
    }
}
