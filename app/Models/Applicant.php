<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    protected $guarded=[];
    public function job(){
        return $this->belongsTo(JobCard::class,'job_card_id');
    }
}
