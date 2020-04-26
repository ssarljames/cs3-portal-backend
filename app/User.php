<?php

namespace App;

use App\Events\ModelEvents\User\UserCreating;
use App\Events\ModelEvents\User\UserUpdating;
use App\Models\Event;
use App\Models\Post;
use App\Models\StationUsageLog;
use App\Models\Student;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'username',
        'password',

        'firstname',
        'lastname',

        'reset_password',

        'deactivated_at',

        'userable_type',
        'userable_id'
    ];

    protected $dates = ['created_at',  'updated_at'];

    protected $hidden = [ 'password' ];

    protected $appends = [ 'is_administrator', 'fullname', 'role' ];



    protected $dispatchesEvents = [
        'creating' => UserCreating::class,
        'updating' => UserUpdating::class
    ];

    public static function query(){
        return parent::query()->where('id', '>', 1);
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

    public function getIsAdministratorAttribute(){
        return $this->id == 1;
    }

    public function getFullnameAttribute(){
        return ucwords(strtolower($this->lastname . ', ' . $this->firstname));
    }

    public function station_usage_logs()
    {
        return $this->hasMany(StationUsageLog::class);
    }

    public function getRoleAttribute(){
        return $this->id == 1 ? 'administrator' : 'encoder';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function created_students()
    {
        return $this->hasMany(Student::class, 'created_by_user_id');
    }

    public function userable()
    {
        return $this->morphTo();
    }

}
