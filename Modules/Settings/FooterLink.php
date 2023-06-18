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

class FooterLink extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'footer_links';
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
        'id', 'link', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','default_value'
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
    protected static $logName = 'footer_link_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Footer link " . $this->translations->first()->title . " has been {$eventName}" : "Footer link #" . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $footer_link = $this;
        return Cache::rememberForever('footer_link_' . $this->id . '_value_' . App::getLocale(), function () use ($footer_link) {
            $footer_link = $footer_link->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $footer_link ? $footer_link->title : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $footer_link = $this;
        return Cache::rememberForever('footer_link_' . $this->id . '_value_' . 'default', function () use ($footer_link) {
            $footer_link = $footer_link->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $footer_link ? $footer_link->title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Settings\FooterLinkTranslation', 'footer_link_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (FooterLink $footer_link) {
            Event::dispatch('footer_link.created', $footer_link);
        });
        static::updated(function (FooterLink $footer_link) {
            Event::dispatch('footer_link.updated', $footer_link);
        });
        static::saved(function (FooterLink $footer_link) {
            Event::dispatch('footer_link.saved', $footer_link);
        });
        static::deleted(function (FooterLink $footer_link) {
            Event::dispatch('footer_link.deleted', $footer_link);
        });
        static::restored(function (FooterLink $footer_link) {
            Event::dispatch('footer_link.restored', $footer_link);
        });
    }
}
