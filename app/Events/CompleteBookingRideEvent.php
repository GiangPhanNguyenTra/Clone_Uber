<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompleteBookingRideEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customerId;
    public $ride;
    public $driver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($customerId, $ride, $driver)
    {
        $this->customerId = $customerId;
        $this->ride = $ride;
        $this->driver = $driver;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('booking-ride-channel.'.$this->customerId);
    }

    public function broadcastAs() { 
        return 'complete-booking-ride';
    }
}
