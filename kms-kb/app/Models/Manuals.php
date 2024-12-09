<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manuals extends Model
{
    protected $table = "manuals";
    protected $fillable = ['user_id','revision_id','ticket_no','title','text'];
}
