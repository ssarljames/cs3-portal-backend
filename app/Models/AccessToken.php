<?php

namespace App\Models;

use App\User;

class AccessToken extends BaseModel
{
    protected $table = 'oauth_access_tokens';
    protected $keyType = 'string';
    protected $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
