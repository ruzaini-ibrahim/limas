<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\BookCheckout;
use App\Fine;

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
    public function fines()
    {
        return $this->hasMany(Fine::class, 'borrowed_by');
    }

    public function countBookCheckoutLend()
    {
        return $this->bookCheckout()->where('book_checkouts.status','=','borrowed')->count();
    }

    public function statusBookCheckoutLend()
    {
        if($this->countBookCheckoutLend() < 5)
            return true;
        else
            return false;
    }

    public function countFine()
    {
        return $this->fines()->where('fines.status','=','not paid')->count();
    }

    public function statusFine()
    {
        if($this->countFine() > 0)
            return true;
        else
            return false;
    }
}
