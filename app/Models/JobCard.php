<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{   
    protected $table = 'job_cards';
    protected $guarded=[];
    protected $casts = [
        'emails_to_receive_applications' => 'array',
    ];
    public function emails()
    {
        return $this->hasMany(JobCardEmail::class);
    }
}
