<?php

namespace App\Events\ModelEvents\Student;

use App\Models\Student;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StudentCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Student $student)
    {
        $user = User::create([
            'username' => $student->id_number,
            'password' => bcrypt($student->id_number),

            'firstname' => $student->firstname,
            'lastname' => $student->lastname,

            'userable_type' => Student::class,

            'reset_password' => true
        ]);

        $student->user_id = $user->id;

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
