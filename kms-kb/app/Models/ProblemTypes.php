<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProblemTypes extends Model
{
    protected $table = "revision_problem_types";
    protected $fillable = ['id','label','img'];

    
    public function revisions()
    {
        return $this->hasMany(Revisions::class, 'problem_type_id');
    }
}
