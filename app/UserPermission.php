<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $fillable = [
        'user_id',
        'permission',
        'type',
        'granted_by_user_id'
    ];

    // Permissions
    const STUDENTS = 1;
    const EVENTS = 2;
    const POSTS = 3;
    const USERS = 4;
    const SERVICE_TRANSACTIONS = 5;

    const PERMISSIONS = [
        self::STUDENTS => 'Manage Students',
        self::EVENTS => 'Manage Events',
        self::POSTS => 'Manage Posts',
        self::USERS => 'Manage Users',
        self::SERVICE_TRANSACTIONS => 'Manage Service Transactions'
    ];

    // Permission Types
    const VIEWANY     = 1;
    const VIEW        = 2;
    const CREATE      = 3;
    const UPDATE      = 4;
    const DELETE      = 5;
    const RESTORE     = 6;
    const FORCEDELETE = 7;

    const TYPES = [
        self::VIEWANY => 'View Any',
        self::VIEW => 'View',
        self::CREATE => 'Create',
        self::UPDATE => 'Update',
        self::DELETE => 'Delete',
        self::RESTORE => 'Restore',
        self::FORCEDELETE => 'Force Delete'
    ];

    public function granted_by_user()
    {
        return $this->belongsTo(User::class, 'granted_by_user_id');
    }

    public function getPermissionLabelAttribute(){
        return self::PERMISSIONS[$this->permission];
    }

    public function getTypeLabelAttribute(){
        return isset(self::TYPES[$this->type]) ? self::TYPES[$this->type] : '';
    }

    public function scopePermits(Builder $query, $permission, $type){
        return $query->where('permission', $permission)
                        ->where('type', $type);
    }

    public function getPermissionCodeAttribute(){
        return str_replace(' ', '_', strtoupper($this->permission_label . '_' . $this->type_label));
    }
}
