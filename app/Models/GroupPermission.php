<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompositePrimaryKey;
use Spatie\Activitylog\Traits\LogsActivity;

class GroupPermission extends Model
{
	use HasCompositePrimaryKey, LogsActivity;

    protected $table = 'group_permissions';
    protected $primaryKey = ['group_id', 'permission_id'];
    public $timestamps = true;
    protected $fillable = [
    	'group_id', 'permission_id', 'created_at', 'updated_at'
    ];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'group_permissions_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Group ".$this->group->name." permission has been {$eventName}";
    }

    public function group()
    {
    	return $this->belongsTo('App\Models\Group');
    }

    public function permission()
    {
    	return $this->belongsTo('App\Models\Permission');
    }
}
