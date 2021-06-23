<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;
    protected $table = "apply";
    protected $primaryKey = "apply_id";

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id', 'company_id');
    }

    public function freelance()
    {
        return $this->belongsTo(Freelances::class, 'freelance_id', 'freelance_id');
    }

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'job_id', 'job_id');
    }
}
