<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use Cache;

class Language extends Model
{
    use LogsActivity;

    protected $table = 'languages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id', 'code', 'created_at', 'updated_at'
    ];
    protected $dates = [];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'language_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Module ".$this->name." has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();
    }
}