<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptBookingRideEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customerId;
    public $ride;
    public $driver;
    public $vehicle;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($customerId, $ride, $driver, $vehicle)
    {
        $this->customerId = $customerId;
        $this->ride = $ride;
        $this->driver = $driver;
        $this->vehicle = $vehicle;
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
        return 'accept-booking-ride';
    }
}
