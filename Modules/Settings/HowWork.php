<?php

namespace Modules\Settings;

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

class HowWork extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';


    protected $table = 'how_works';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        return "App\User";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'image', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','default_value','description','default_description'
    ];

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
    protected static $logName = 'how_work_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "How work " . $this->translations->first()->title . " has been {$eventName}" : "How work #" . $this->id . " has been {$eventName}";
    }
    public function getValueAttribute()
    {
        $how_work = $this;
        return Cache::rememberForever('how_work_'.$this->id.'_value_'.App::getLocale(), function() use ($how_work) {
            $how_work = $how_work->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $how_work ? $how_work->title : null;
        });
    }
    public function getDefaultValueAttribute()
    {
        $how_work = $this;
        return Cache::rememberForever('how_work_'.$this->id.'_default_value', function() use ($how_work) {
            $how_work = $how_work->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $how_work ? $how_work->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $how_work = $this;
        return Cache::rememberForever('how_work_'.$this->id.'_description_'.App::getLocale(), function() use ($how_work) {
            $how_work = $how_work->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $how_work ? $how_work->description : null;
        });
    }
    public function getDefaultDescriptionAttribute()
    {
        $how_work = $this;
        return Cache::rememberForever('how_work_'.$this->id.'_default_description', function() use ($how_work) {
            $how_work = $how_work->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $how_work ? $how_work->description : null;
        });
    }
    
    public function translations()
    {
        return $this->hasMany('Modules\Settings\HowWorkTranslation', 'how_work_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (HowWork $how_work) {
            Event::dispatch('how_work.created', $how_work);
        });
        static::updated(function (HowWork $how_work) {
            Event::dispatch('how_work.updated', $how_work);
        });
        static::saved(function (HowWork $how_work) {
            Event::dispatch('how_work.saved', $how_work);
        });
        static::deleted(function (HowWork $how_work) {
            Event::dispatch('how_work.deleted', $how_work);
        });
        static::restored(function (HowWork $how_work) {
            Event::dispatch('how_work.restored', $how_work);
        });
    }
}
