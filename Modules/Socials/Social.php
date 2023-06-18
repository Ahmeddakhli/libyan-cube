<?php

namespace Modules\Socials;

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
use App\User;

class Social extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'socials';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'is_featured', 'icon', 'link', 'created_at', 'updated_at'
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
    protected static $logName = 'social_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Social " . $this->translations->first()->title . " has been {$eventName}" : "Social #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $social = $this;
        return Cache::rememberForever('socials_'.$this->id.'_value_'.App::getLocale(), function() use ($social) {
            $social = $social->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $social ? $social->title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Socials\SocialTranslation', 'social_id', 'id');
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

        static::created(function (Social $social) {
            Event::dispatch('social.created', $social);
        });
        static::updated(function (Social $social) {
            Event::dispatch('social.updated', $social);
        });
        static::saved(function (Social $social) {
            Event::dispatch('social.saved', $social);
        });
        static::deleted(function (Social $social) {
            Event::dispatch('social.deleted', $social);
        });
        static::restored(function (Social $social) {
            Event::dispatch('social.restored', $social);
        });
    }
}
