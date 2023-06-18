<?php

namespace Modules\WelcomeMessages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use App\Language;
use App;
use Cache;
use Wildside\Userstamps\Userstamps;
use App\Media;
use App\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class WelcomeMessage extends Model implements HasMedia
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps, HasMediaTrait;

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

    protected $table = 'welcome_messages';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'created_at', 'updated_at', 'is_featured','link','time'
    ];

    protected $appends = [
        'value'
    ];

    // protected $softCascade = ['translations'];
    // Deleting translations manually to overcome laravel issue with composite primary key
    protected $softCascade = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'welcome_message_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Welcome message " . $this->translations->first()->title . " has been {$eventName}" : "Welcome message #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $welcome_message = $this;
        return Cache::rememberForever('welcome_messages_'.$this->id.'_value_'.App::getLocale(), function() use ($welcome_message) {
            $welcome_message = $welcome_message->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $welcome_message ? $welcome_message->title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\WelcomeMessages\WelcomeMessageTranslation', 'welcome_message_id', 'id');
    }

    // Handle IS Featured 
    public function setIsFeaturedAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_featured'] = 1;
        } else {
            $this->attributes['is_featured'] = 0;
        }
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (WelcomeMessage $welcome_message) {
            Event::dispatch('welcome_message.created', $welcome_message);
        });
        static::updated(function (WelcomeMessage $welcome_message) {
            Event::dispatch('welcome_message.updated', $welcome_message);
        });
        static::saved(function (WelcomeMessage $welcome_message) {
            Event::dispatch('welcome_message.saved', $welcome_message);
        });
        static::deleted(function (WelcomeMessage $welcome_message) {
            Event::dispatch('welcome_message.deleted', $welcome_message);
        });
        static::restored(function (WelcomeMessage $welcome_message) {
            Event::dispatch('welcome_message.restored', $welcome_message);
        });
    }
}
