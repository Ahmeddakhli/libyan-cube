<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompositePrimaryKey;
use Spatie\Activitylog\Traits\LogsActivity;

class PackageModule extends Model
{
    use HasCompositePrimaryKey, LogsActivity;

    protected $table = 'package_modules';
    protected $primaryKey = ['package_id', 'module_id'];
    public $timestamps = true;
    protected $fillable = [
        'id', 'package_id', 'module_id', 'created_at', 'updated_at'
    ];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'package_moules_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Package ".$this->package->name." modules has been {$eventName}";
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package');
    }

    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }
}
