<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use App\Models\Permission;
use Cache;
use Wildside\Userstamps\Userstamps;

class Group extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'groups';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	'id', 'parent_id', 'name', 'slug', 'description', 'is_hidden', 'created_at', 'updated_at'
    ];
    protected $softCascade = ['users@restrict', 'children@restrict'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'group_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Group ".$this->name." has been {$eventName}";
    }

    public function users()
    {
    	return $this->hasMany('App\User', 'group_id');
    }

    public function parent()
    {
    	return $this->belongsTo('App\Models\Group', 'parent_id');
    }

    public function children()
    {
    	return $this->hasMany('App\Models\Group', 'parent_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'group_permissions','group_id','permission_id')->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Group $group) {
            Event::dispatch('group.created', $group);
        });
        static::updated(function (Group $group) {
            Event::dispatch('group.updated', $group);
        });
        static::saved(function (Group $group) {
            Event::dispatch('group.saved', $group);
        });
        static::deleted(function (Group $group) {
            Event::dispatch('group.deleted', $group);
        });
        static::restored(function (Group $group) {
            Event::dispatch('group.restored', $group);
        });
    }

    /**
     * Return current group permissions
     * 
     * @return App\Models\Permission collection
     */
    public function getPermissions()
    {
        return Cache::rememberForever('group_'.$this->id.'_permissions', function() {
            return $this->permissions;
        });
    }

    /**
     * Return children groups under current group
     * 
     * @return App\Models\Group collection
     */
    public function getChildren()
    {
        // Count levels
        $count_levels = Group::select('parent_id')->get();
        $count_levels = $count_levels->unique()->values()->count();

        if ($count_levels) {
            // 1st and 2nd Level        
            $group_ids = Group::where('parent_id', $this->id)->select('id')->get()->pluck('id')->toArray();

            // Loop to get all other groups ids
            for ($x = 0; $x <= $count_levels+1; $x++) {
                $next_levels = Group::whereIn('parent_id', $group_ids)->select('id')->get()->pluck('id')->toArray();
                foreach($next_levels as $key => $value) {
                    array_push($group_ids, $value);
                }
            }

            // If group is in level 1 "Technical Support",
            // cache groups with no parents as well
            if (!$this->parent_id) {
                $main_groups = Group::whereNull('parent_id')->select('id')->get()->pluck('id')->toArray();
                foreach ($main_groups as $key => $value) {
                    array_push($group_ids, $value);
                }
            }

            // Removing duplicates
            $unique_group_ids = array_unique($group_ids);

            if ($unique_group_ids) {
                return Cache::rememberForever('group_'.$this->id.'_children', function() use ($unique_group_ids) {
                    $groups = Group::whereIn('id', $unique_group_ids)->get();
                    return $groups;
                });
            } else {
                return Cache::rememberForever('group_'.$this->id.'_children', function() {
                    $groups = collect([]);
                    $groups = $groups->push($this);
                    return $groups;
                });
            }
        }

        return Cache::rememberForever('group_'.$this->id.'_children', function() {
            $groups = collect([]);
            $groups = $groups->push($this);
            return $groups;
        });
    }

    public function getParents()
    {
        $group = Group::find($this->id);
        $parents = collect([]);

        // Infinite Loop Handling
        $parent_ids = [];

        // Check if the group has a parent group
        if ($group->parent_id) {
            $current_parent = Group::find($group->parent_id);
            while ($current_parent) {
                $parents->push($current_parent);

                // Infinite Loop Handling
                if (in_array($current_parent->id, $parent_ids)) {
                    return Cache::rememberForever('user_'.$this->id.'_parents', function() use ($parents) {
                        return $parents;
                    });
                }
                array_push($parent_ids, $current_parent->id);

                if ($current_parent->parent_id) {
                    $current_parent = Group::find($current_parent->parent_id);
                } else {
                    $current_parent = null;
                }
            }
        }

        return Cache::rememberForever('group_'.$this->id.'_parents', function() use ($parents) {
            return $parents;
        });
    }
    /**
     * Take $permission slug as parameter and check 
     * if current group has given permission
     * 
     * @return boolean
     */
    public function hasPermission($permission)
    {
        $permissions = $this->getPermissions();
        return !!$permissions->where('slug', $permission)->count();
    }

    /**
     * Take $permission slug as parameter and check 
     * if current group has given all its child permissions
     * 
     * @return boolean
     */
    public function hasChildPermissions($permission)
    {
        $child_permissions = Permission::where('slug', $permission)->pluck('id')->toArray();
        $group_permissions = $this->getPermissions();
        foreach ($child_permissions as $permission) {
            if (!$group_permissions->where('id', $permission)->first()) {
                return false;
            }
        }
        return true;
    }
}
