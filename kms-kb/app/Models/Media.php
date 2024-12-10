<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "media";
    
    protected $fillable = ['manual_id','file_name','file_link','extension','created_at','updated_at'];
}
