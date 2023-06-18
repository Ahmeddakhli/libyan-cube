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

class MainSlider extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';


    protected $table = 'main_sliders';
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
        'id', 'image', 'link', 'created_at', 'updated_at'
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
    protected static $logName = 'main_slider_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Main slider " . $this->translations->first()->title . " has been {$eventName}" : "Main slider #" . $this->id . " has been {$eventName}";
    }
    public function getValueAttribute()
    {
        $main_slider = $this;
        return Cache::rememberForever('main_slider_'.$this->id.'_value_'.App::getLocale(), function() use ($main_slider) {
            $main_slider = $main_slider->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $main_slider ? $main_slider->title : null;
        });
    }
    public function getDefaultValueAttribute()
    {
        $main_slider = $this;
        return Cache::rememberForever('main_slider_'.$this->id.'_default_value', function() use ($main_slider) {
            $main_slider = $main_slider->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $main_slider ? $main_slider->title : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $main_slider = $this;
        return Cache::rememberForever('main_slider_'.$this->id.'_description_'.App::getLocale(), function() use ($main_slider) {
            $main_slider = $main_slider->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $main_slider ? $main_slider->description : null;
        });
    }
    public function getDefaultDescriptionAttribute()
    {
        $main_slider = $this;
        return Cache::rememberForever('main_slider_'.$this->id.'_default_description', function() use ($main_slider) {
            $main_slider = $main_slider->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $main_slider ? $main_slider->description : null;
        });
    }
    
    public function translations()
    {
        return $this->hasMany('Modules\Settings\MainSliderTranslation', 'main_slider_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (MainSlider $main_slider) {
            Event::dispatch('main_slider.created', $main_slider);
        });
        static::updated(function (MainSlider $main_slider) {
            Event::dispatch('main_slider.updated', $main_slider);
        });
        static::saved(function (MainSlider $main_slider) {
            Event::dispatch('main_slider.saved', $main_slider);
        });
        static::deleted(function (MainSlider $main_slider) {
            Event::dispatch('main_slider.deleted', $main_slider);
        });
        static::restored(function (MainSlider $main_slider) {
            Event::dispatch('main_slider.restored', $main_slider);
        });
    }
}
