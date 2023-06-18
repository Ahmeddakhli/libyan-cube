<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Cache;
use App\User;

class UserEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function clearCaches(User $user)
    {
        // Clear user cached permissions
        Cache::forget('user_'.$user->id.'_permissions');

        // Clear users caches
        $users = User::select(['id', 'group_id'])->get();
        foreach ($users as $user) {
            // Clear user cached children
            Cache::forget('user_'.$user->id.'_children');

            // Clear user cached parents
            Cache::forget('user_'.$user->id.'_parents');
        }
    }

    public function userCreated(User $user)
    {
        $this->clearCaches($user);
    }

    public function userUpdated(User $user)
    {
        $this->clearCaches($user);
    }

    public function userSaved(User $user)
    {
        $this->clearCaches($user);
    }

    public function userDeleting(User $user)
   {
        $this->clearCaches($user);
    }

    public function userDeleted(User $user)
    {
        $this->clearCaches($user);
    }

    public function userRestored(User $user)
    {
        $this->clearCaches($user);
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
