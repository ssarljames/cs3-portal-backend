<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $table = 'oauth_access_tokens';
    protected $keyType = 'string';
    protected $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
