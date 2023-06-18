<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use Cache;

class Module extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity;

    protected $table = 'modules';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id', 'name', 'description', 'created_at', 'updated_at'
    ];
    protected $softCascade = ['packages@restrict'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'module_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Module ".$this->name." has been {$eventName}";
    }

    public function packages()
    {
        return $this->belongsToMany('App\Models\Package', 'package_modules','module_id','package_id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
