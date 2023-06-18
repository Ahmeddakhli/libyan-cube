<?php

namespace Modules\Testimonials;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class TestimonialTranslation extends Model
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

    protected $table = 'testimonial_trans';
    protected $primaryKey = ['testimonial_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'testimonial_id', 'language_id', 'title','description','created_at', 'updated_at'
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
    protected static $logName = 'testimonial_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Testimonials Translation ".$this->title." has been {$eventName}";
    }

    public function testimonial()
    {
        return $this->belongsTo('Modules\Testimonials\Testimonial', 'testimonial_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (TestimonialTranslation $testimonial_translation) {
            Event::dispatch('testimonial_translation.created', $testimonial_translation);
        });
        static::updated(function (TestimonialTranslation $testimonial_translation) {
            Event::dispatch('testimonial_translation.updated', $testimonial_translation);
        });
        static::saved(function (TestimonialTranslation $testimonial_translation) {
            Event::dispatch('testimonial_translation.saved', $testimonial_translation);
        });
        static::deleted(function (TestimonialTranslation $testimonial_translation) {
            Event::dispatch('testimonial_translation.deleted', $testimonial_translation);
        });
        static::restored(function (TestimonialTranslation $testimonial_translation) {
            Event::dispatch('testimonial_translation.restored', $testimonial_translation);
        });
    }
   
}
