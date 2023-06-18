<?php

namespace Modules\Messages;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class Message extends Model
{
    use SoftCascadeTrait, SoftDeletes, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'messages';
    protected $fillable = ['sender_id', 'receiver_id', 'i_project_id','is_readed', 'name', 'email', 'phone', 'message', 'created_at', 'updated_at'];
    protected $softCascade = [];
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'message_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Message ".$this->id." has been {$eventName}";
    }

    public function sender()
    {
        return $this->belongsTo('\App\User', 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('\App\User', 'receiver_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('\Modules\Inventory\IProject', 'i_project_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Message $message) {
            Event::dispatch('message.created', $message);
        });
        static::updated(function (Message $message) {
            Event::dispatch('message.updated', $message);
        });
        static::saved(function (Message $message) {
            Event::dispatch('message.saved', $message);
        });
        static::deleted(function (Message $message) {
            Event::dispatch('message.deleted', $message);
        });
        static::restored(function (Message $message) {
            Event::dispatch('message.restored', $message);
        });
    }
}
