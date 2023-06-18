<?php

namespace Modules\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class MainSliderTranslation extends Model
{
    use HasCompositePrimaryKey, SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'main_slider_trans';
    protected $primaryKey = ['main_slider_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_slider_id', 'language_id', 'title','description', 'created_at', 'updated_at'
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
    protected static $logName = 'main_slider_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Main slider translation " . $this->title . " has been {$eventName}";
    }

    public function mainSlider()
    {
        return $this->belongsTo('Modules\Settings\MainSlider', 'main_slider_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (MainSliderTranslation $main_slider_translation) {
            Event::dispatch('main_slider_translation.created', $main_slider_translation);
        });
        static::updated(function (MainSliderTranslation $main_slider_translation) {
            Event::dispatch('main_slider_translation.updated', $main_slider_translation);
        });
        static::saved(function (MainSliderTranslation $main_slider_translation) {
            Event::dispatch('main_slider_translation.saved', $main_slider_translation);
        });
        static::deleted(function (MainSliderTranslation $main_slider_translation) {
            Event::dispatch('main_slider_translation.deleted', $main_slider_translation);
        });
        static::restored(function (MainSliderTranslation $main_slider_translation) {
            Event::dispatch('main_slider_translation.restored', $main_slider_translation);
        });
    }
   
}
