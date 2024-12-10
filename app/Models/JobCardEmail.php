<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCardEmail extends Model
{
protected $fillable = ['job_card_id','email'];
public function jobCard()
{
    return $this->belongsTo(JobCard::class);
}
}
