<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // --- Traits ---
    use Notifiable;

    // --- Laravel settings ---
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    // --- Eloquent relationships ---
    public function role()
    {
        return $this->belongsTo(Role::class);
    }



    // ---
    public function isAuthorised($requiredRole)
    {
        return $this->role->searchInHiearchy($requiredRole);
    }
}