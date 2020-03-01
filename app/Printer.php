<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printer extends Model
{
    use SoftDeletes;

    protected $fillable = [ 'description' ];

    public function transactions()
    {
        return $this->hasMany(PrintTransaction::class);
    }

    public function usages()
    {
        return $this->hasMany(PrinterUsageLog::class);
    }

    // public function getCurrentUserAttribute(){
    //     $usage = $this->usages()->orderBy('created_at', 'desc')->first();

    //     if($usage && $usage->end == null)
    //         return $usage->user;

    //     return null;
    // }


    public function getCurrentSessionAttribute(){
        $usage = $this->usages()->latest()->first();

        if($usage && $usage->end == null)
            return [
                'user' => $usage->user,
                'start_time' => $usage->created_at,
                'sales' => $this->transactions()->createdSince($usage->created_at)->sum('sales')
            ];

        return null;
    }

}
