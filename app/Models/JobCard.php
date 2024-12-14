<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{   
    protected $table = 'job_cards';
    protected $guarded=[];
    protected $casts = [
        'emails_to_receive_applications' => 'array',
        'posted_date' => 'datetime:d/m/Y',
        'last_date_to_apply' => 'datetime:d/m/Y',
      
    ];
    public function emails()
    {
        return $this->hasMany(JobCardEmail::class);
    }
    public function applications(){
        return $this->hasMany(Applicant::class,'job_card_id');
    }
}
