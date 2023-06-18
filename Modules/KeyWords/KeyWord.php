<?php

namespace Modules\KeyWords;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Language;
use App;
use Cache;
use Wildside\Userstamps\Userstamps;

class KeyWord extends Model 
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

    protected $table = 'key_words';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'is_featured','price_from','price_to', 'created_at', 'updated_at'
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
    protected static $logName = 'key_word_log';

    public function getDescriptionForEvent(string $key_wordName): string
    {
        return $this->translations->first() ? "Key Word " . $this->translations->first()->title . " has been {$key_wordName}" : "Key Word #" . $this->id . " has been {$key_wordName}";
    }

    public function getValueAttribute()
    {
        $key_word = $this;
        return Cache::rememberForever('key_word_' . $this->id . '_value_' . App::getLocale(), function () use ($key_word) {
            $key_word = $key_word->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $key_word ? $key_word->title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\KeyWords\KeyWordTranslation', 'key_word_id', 'id');
    }

    public function regions()
    {
        return $this->belongsToMany('Modules\Locations\Location','key_word_locations', 'key_word_id','location_id', 'id')->where('type','region');
    }

    public function cities()
    {
        return $this->belongsToMany('Modules\Locations\Location','key_word_locations', 'key_word_id','location_id', 'id')->where('type','city');
    }

    public function locations()
    {
        return $this->belongsToMany('Modules\Locations\Location','key_word_locations', 'key_word_id','location_id', 'id');
    }

    public function types()
    {
        return $this->belongsToMany('Modules\Inventory\IPurpose','key_word_types', 'key_word_id','type_id');
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

        static::created(function (KeyWord $key_word) {
            \Illuminate\Support\Facades\Event::dispatch('key_word.created', $key_word);
        });
        static::updated(function (KeyWord $key_word) {
            \Illuminate\Support\Facades\Event::dispatch('key_word.updated', $key_word);
        });
        static::saved(function (KeyWord $key_word) {
            \Illuminate\Support\Facades\Event::dispatch('key_word.saved', $key_word);
        });
        static::deleted(function (KeyWord $key_word) {
            \Illuminate\Support\Facades\Event::dispatch('key_word.deleted', $key_word);
        });
        static::restored(function (KeyWord $key_word) {
            \Illuminate\Support\Facades\Event::dispatch('key_word.restored', $key_word);
        });
    }
}
