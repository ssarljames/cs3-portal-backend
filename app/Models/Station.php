<?php

namespace App\Models;



class Station extends BaseModel
{

    protected $appends = [ 'current_session', 'previous_session', 'service_types', 'allowed_to_use' ];


    public function getCurrentSessionAttribute(){
        return $this->usage_logs()->activeSessions()->with('user')->first();
    }

    public function getServiceTypesAttribute(){
        return ServiceTransaction::TYPES;
    }

    public function getPreviousSessionAttribute(){
        return $this->usage_logs()->inactiveSessions()->with('user')->latest()->first();
    }

    public function getAllowedToUseAttribute(){
        return true || now()->lte(date('Y-m-d ') . StationUsageLog::MAX_TIME_OUT);
    }

    public function usage_logs()
    {
        return $this->hasMany(StationUsageLog::class);
    }
}
