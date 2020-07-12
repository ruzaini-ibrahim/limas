<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\BookCheckout;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookCheckout()
    {
        return $this->hasMany(BookCheckout::class, 'borrowed_by');
    }

    public function countBookCheckout()
    {
        return $this->bookCheckout->count();
    }

    public function statusBookCheckout()
    {
        if($this->countBookCheckout() < 5)
            return true;
        else
            return false;
    }
}
