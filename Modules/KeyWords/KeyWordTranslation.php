<?php

namespace Modules\KeyWords;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class KeyWordTranslation extends Model
{
    use HasCompositePrimaryKey, LogsActivity, Userstamps;

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

    protected $table = 'key_word_trans';
    protected $primaryKey = ['key_word_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key_word_id', 'language_id', 'title', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $softCascade = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'key_word_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Key Word Translation " . $this->title . " has been {$eventName}";
    }

    public function event()
    {
        return $this->belongsTo('Modules\KeyWords\KeyWord', 'key_word_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (KeyWordTranslation $key_word_translation) {
            Event::dispatch('key_word_translation.created', $key_word_translation);
        });
        static::updated(function (KeyWordTranslation $key_word_translation) {
            Event::dispatch('key_word_translation.updated', $key_word_translation);
        });
        static::saved(function (KeyWordTranslation $key_word_translation) {
            Event::dispatch('key_word_translation.saved', $key_word_translation);
        });
        static::deleted(function (KeyWordTranslation $key_word_translation) {
            Event::dispatch('key_word_translation.deleted', $key_word_translation);
        });
    }
}
