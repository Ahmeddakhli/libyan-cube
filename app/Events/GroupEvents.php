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
use App\Models\Group;
use App\User;

class GroupEvents
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

    private function clearCaches(Group $group)
    {
        $groups_ids = Group::pluck('id')->toArray();
        for ($i = 0; $i < count($groups_ids); $i++) {
            // Clear cached groups permissions
            Cache::forget('group_'.$groups_ids[$i].'_permissions');
            // Clear cached groups children
            Cache::forget('group_'.$groups_ids[$i].'_children');
            // Clear cached groups parents
            Cache::forget('group_'.$groups_ids[$i].'_parents');
        }

        // Clear cached permissions of group users
        $users_ids = User::where('group_id', $group->id)->pluck('id')->toArray();
        for ($i = 0; $i < count($users_ids); $i++) {
            // Clear cached user permissions
            Cache::forget('user_'.$users_ids[$i].'_permissions');
            // Clear cached user children
            Cache::forget('user_'.$users_ids[$i].'_children');
            // Clear cached user parents
            Cache::forget('user_'.$users_ids[$i].'_parents');
        }
    }

    public function groupCreated(Group $group)
    {
        $this->clearCaches($group);
    }

    public function groupUpdated(Group $group)
    {
        $this->clearCaches($group);
    }

    public function groupSaved(Group $group)
    {
        $this->clearCaches($group);
    }

    public function groupDeleted(Group $group)
    {
        $this->clearCaches($group);
    }

    public function groupRestored(Group $group)
    {
        $this->clearCaches($group);
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
