<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;
    protected $table = "job_vacancies";
    protected $primaryKey = "job_id";

    public function applies()
    {
        return $this->hasMany(Apply::class, 'job_id', 'job_id');
    }
}
