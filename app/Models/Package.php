<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use Cache;

class Package extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity;

    protected $table = 'packages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id', 'name', 'description', 'created_at', 'updated_at'
    ];
    protected $softCascade = ['hostDetails@restrict'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'package_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Package ".$this->name." has been {$eventName}";
    }

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module', 'package_modules','package_id','module_id')->withTimestamps();
    }

    public function hostDetails()
    {
        return $this->hasMany('\App\Models\HostDetails', 'package_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
