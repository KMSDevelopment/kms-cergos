<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkedParts extends Model
{
    protected $table = "revision_parts";
    
    protected $fillable = ['revision_id','part_id'];

    public function part()
    {
        return $this->belongsTo(RevisionParts::class, 'part_id');
    }
}
