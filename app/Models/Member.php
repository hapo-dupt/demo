<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Member extends Authenticatable
{
    protected $guard = 'member';
    const ROLE_ADMIN = 1;
    const ROLE_MEMBER = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSE = 0;
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const ID = 0;
    protected $fillable = [
        'email', 'password', 'role', 'name', 'image', 'gender', 'phone', 'address', 'active'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::Class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::Class);
    }

    public function info()
    {
        return Auth::user();
    }
}
