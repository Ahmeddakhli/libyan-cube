<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache, Auth;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	'id', 'parent_id', 'module_id', 'name', 'slug', 'is_hidden', 'created_at', 'updated_at'
    ];
    protected $softCascade = ['children'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'permission_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Permission ".$this->name." has been {$eventName}";
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Permission', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Permission', 'parent_id');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'group_permissions' , 'permission_id','group_id');
    }

    public static function boot()
    {
        parent::boot();

    }
}
