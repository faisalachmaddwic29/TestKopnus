<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Companies extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = "companies";
    protected $primaryKey = "company_id";

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class, 'company_id', 'company_id');
    }

    public function applies()
    {
        return $this->hasMany(Apply::class, 'company_id', 'company_id');
    }
}
