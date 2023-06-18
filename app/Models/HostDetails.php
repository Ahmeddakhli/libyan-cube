<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use Cache;

class HostDetails extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity;

    protected $table = 'host_details';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id', 'fqdn', 'package_id', 'owner_email', 'owner_mobile_number', 'created_at', 'updated_at'
    ];
    protected $softCascade = ['host@restrict'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'host_details_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Host ".$this->fqdn." details has been {$eventName}";
    }

    public function package()
    {
        return $this->belongsTo('\App\Models\Package', 'package_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
