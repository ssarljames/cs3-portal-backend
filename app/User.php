<?php

namespace App;

use App\Events\ModelEvents\User\UserCreating;
use App\Events\ModelEvents\User\UserUpdating;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'username',
        'password',

        'firstname',
        'lastname',

        'reset_password'
    ];

    protected $dates = ['created_at',  'updated_at'];


    protected $dispatchesEvents = [
        'creating' => UserCreating::class,
        'updating' => UserUpdating::class
    ];

    public static function query(){
        return parent::query()->where('id', '>', 1);
    }

    public function print_transactions()
    {
        return $this->hasMany(PrintTransaction::class);
    }
}
