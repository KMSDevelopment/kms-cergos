<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionMerge extends Model
{
    protected $table = "revision_merge";
    protected $fillable = ['revision_id','old_site_rev_id','odoo_rev_id','new_rev_id'];
}
