<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'valid_until',
        'type'
    ];

    protected $dates = [ 'valid_until' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
