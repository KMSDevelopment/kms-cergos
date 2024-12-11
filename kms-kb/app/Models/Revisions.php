<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Revisions extends Model
{
    protected $table = "revisions";
    protected $fillable = ['api_id','title','complain_desc','revision_problem_types','revision_desc','parts','models','checked'];
    					
    public function customers()
    {
        return $this->hasMany(CustomerRevisions::class, 'revision_id');
    }
    public function revisionmodels()
    {
        return $this->hasMany(RevisionModels::class, 'revision_id');
    }
    public function api()
    {
        return $this->hasOne(Api::class, 'id');
    }
    public function problem()
    {
        return $this->hasOne(ProblemTypes::class, 'id');
    }
}
