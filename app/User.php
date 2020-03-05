<?php

namespace App;

use App\Events\ModelEvents\User\UserCreating;
use App\Events\ModelEvents\User\UserUpdating;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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

    public function checkPassword($password){
        return Hash::check($password, $this->password);
    }

    public function validatePassword($password){
        if($this->checkPassword($password) == false)
            throw ValidationException::withMessages([
                'password' => ['User password is incorrect.', $password],
            ]);
    }
}
