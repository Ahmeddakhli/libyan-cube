<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cache, Auth;
use App\Models\Group;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Support\Facades\Event;
use Modules\Ratings\Rating;
use Wildside\Userstamps\Userstamps;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Redis;


class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use SoftDeletes, SoftCascadeTrait, HasApiTokens, Notifiable, LogsActivity, CausesActivity, Userstamps, HasPushSubscriptions, HasMediaTrait;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        return "App\User";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'group_id', 'full_name','bio', 'image', 'username', 'email', 'email_verified_at', 'password', 'mobile_number', 'is_suspended', 'last_login_at', 'last_login_ip', 'connection_id', 'timezone', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'user_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User " . $this->username . " has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (User $user) {
            Event::dispatch('user.created', $user);
        });
        static::updated(function (User $user) {
            Event::dispatch('user.updated', $user);
        });
        static::saved(function (User $user) {
            Event::dispatch('user.saved', $user);
        });
        static::deleting(function ($user) {
            Event::dispatch('user.deleting', $user);
        });
        static::deleted(function (User $user) {
            Event::dispatch('user.deleted', $user);
        });
        static::restored(function (User $user) {
            Event::dispatch('user.restored', $user);
        });
    }

    public function scopeNotSuspended($query)
    {
        return $query->where('is_suspended', 0);
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    /**
     * Return current user permissions
     *
     * @return App\Models\Permission collection
     */
    public function getPermissions()
    {
        return Cache::rememberForever('user_' . $this->id . '_permissions', function () {
            return $this->permissions;
        });
    }

    /**
     * Take $permission slug as parameter and check
     * if current user has given permission
     *
     * @return boolean
     */
    public function hasPermission($permission)
    {
        $permissions = $this->getPermissions();
        return !!$permissions->where('slug', $permission)->count();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'user_permissions', 'user_id', 'permission_id')->withTimestamps();
    }

    /**
     * Take $group slug as parameter and check
     * if current user belongs to this group
     *
     * @return boolean
     */
    public function is($group)
    {
        return !!$this->group->slug == $group;
    }
    public function favorites()
    {
        return $this->hasMany('\Modules\Inventory\Favorite', 'user_id', 'id');
    }
    public function compares()
    {
        return $this->hasMany('Modules\Compares\Compare','user_id','id');
    }

    /**
     * Return children users under current user
     *
     * @return App\User collection
     */
    public function getChildren()
    {
        // // Count levels
        // $count_levels = Group::select('parent_id')->get();
        // $count_levels = $count_levels->pluck('parent_id')->unique()->values()->count();
        // // $count_levels = $count_levels->unique()->values()->count();

        // if ($count_levels) {
        //     // 1st and 2nd Level
        //     $group_ids = Group::where('parent_id', $this->group_id)->select('id')->get()->pluck('id')->toArray();

        //     // Loop to get all other groups ids
        //     for ($x = 0; $x <= $count_levels+1; $x++) {
        //         $next_levels = Group::whereIn('parent_id', $group_ids)->select('id')->get()->pluck('id')->toArray();
        //         foreach($next_levels as $key => $value) {
        //             array_push($group_ids, $value);
        //         }
        //     }

        //     // Removing duplicates
        //     $unique_group_ids = array_unique($group_ids);

        //     if ($unique_group_ids) {
        //         return Cache::rememberForever('user_'.$this->id.'_children', function() use ($unique_group_ids) {
        //             $users = User::whereIn('group_id', $unique_group_ids)->where('is_suspended', 0)->get();
        //             $users = $users->push($this);
        //             return $users;
        //         });
        //     } else {
        //         return Cache::rememberForever('user_'.$this->id.'_children', function() {
        //             $users = collect([]);
        //             $users = $users->push($this);
        //             return $users;
        //         });
        //     }
        // }

        // return Cache::rememberForever('user_'.$this->id.'_children', function() {
        //     $users = collect([]);
        //     $users = $users->push($this);
        //     return $users;
        // });

        return Cache::rememberForever('user_' . $this->id . '_children', function () {
            // Count levels
            $count_levels = Group::select('parent_id')->get();
            $count_levels = $count_levels->pluck('parent_id')->unique()->values()->count();
            // $count_levels = $count_levels->unique()->values()->count();

            if ($count_levels) {
                // 1st and 2nd Level
                $group_ids = Group::where('parent_id', $this->group_id)->select('id')->get()->pluck('id')->toArray();

                // Loop to get all other groups ids
                for ($x = 0; $x <= $count_levels + 1; $x++) {
                    $next_levels = Group::whereIn('parent_id', $group_ids)->select('id')->get()->pluck('id')->toArray();
                    foreach ($next_levels as $key => $value) {
                        array_push($group_ids, $value);
                    }
                }

                // Removing duplicates
                $unique_group_ids = array_unique($group_ids);

                if ($unique_group_ids) {
                    $users = User::whereIn('group_id', $unique_group_ids)->where('is_suspended', 0)->get();
                    $users = $users->push($this);
                    return $users;
                } else {
                    $users = collect([]);
                    $users = $users->push($this);
                    return $users;
                }
            }

            $users = collect([]);
            $users = $users->push($this);
            return $users;
        });
    }

    public function getParents()
    {
        $user_group = Group::find($this->group_id);
        $parents = collect([]);

        // Infinite Loop Handling
        $parent_ids = [];

        // Check if the user has a parent group
        if ($user_group->parent_id) {
            $current_parent = Group::find($user_group->parent_id);
            while ($current_parent) {
                foreach ($current_parent->users as $user) {
                    $parents->push($user);

                    // Infinite Loop Handling
                    if (in_array($user->id, $parent_ids)) {
                        return Cache::rememberForever('user_' . $this->id . '_parents', function () use ($parents) {
                            return $parents;
                        });
                    }
                    array_push($parent_ids, $user->id);
                }
                if ($current_parent->parent_id) {
                    $current_parent = Group::find($current_parent->parent_id);
                } else {
                    $current_parent = null;
                }
            }
        }

        return Cache::rememberForever('user_' . $this->id . '_parents', function () use ($parents) {
            return $parents;
        });
    }

    public function isAdmin()
    {
        if ($this->group && !in_array($this->group->slug, ['brokers', 'developers', 'owners', 'buyers'])) {
            return true;
        } else {
            return false;
        }
    }

    /*************************************************************************
     * Modules
     *************************************************************************/

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',' . auth()->user()->id . ',' . 'imports')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array('xlsx', 'xls', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'));
            })
            ->useDisk('public');
    }

    public function lastSeen()
    {
        return $this->id;
    }

    public function getUrl()
    {
    }
}
