<?php

namespace App\Events\ModelEvents\StationUsageLog;

use App\Models\ServiceTransaction;
use App\Models\StationUsageLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StationUsageLogUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StationUsageLog $log)
    {
        if($log->time_out){
            $log->total_time = $log->time_out->diffInMinutes($log->time_in);

            if($log->total_time < 10)
                $log->total_time = 10;

            $log->total_sales = ServiceTransaction::query()
                                    ->stationId($log->station_id)
                                    ->fromTime($log->time_in)
                                    ->toTime($log->time_out)
                                    ->sum('sales');
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
