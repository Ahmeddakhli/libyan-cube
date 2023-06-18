<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompositePrimaryKey;
use Spatie\Activitylog\Traits\LogsActivity;

class UserPermission extends Model
{
	use HasCompositePrimaryKey, LogsActivity;

    protected $table = 'user_permissions';
    protected $primaryKey = ['user_id', 'permission_id'];
    public $timestamps = true;
    protected $fillable = [
    	'user_id', 'permission_id', 'created_at', 'updated_at'
    ];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'user_permissions_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User ".$this->user->username." permission has been {$eventName}";
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function permission()
    {
    	return $this->belongsTo('App\Models\Permission');
    }
}
