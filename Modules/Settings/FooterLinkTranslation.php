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

class FooterLinkTranslation extends Model
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

    protected $table = 'footer_links_trans';
    protected $primaryKey = ['footer_link_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'footer_link_id', 'language_id', 'title', 'created_at', 'updated_at'
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
    protected static $logName = 'footer_link_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Footer link translation " . $this->title . " has been {$eventName}";
    }

    public function footerLink()
    {
        return $this->belongsTo('Modules\Settings\FooterLink', 'footer_link_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (FooterLinkTranslation $footer_link_translation) {
            Event::dispatch('footer_link_translation.created', $footer_link_translation);
        });
        static::updated(function (FooterLinkTranslation $footer_link_translation) {
            Event::dispatch('footer_link_translation.updated', $footer_link_translation);
        });
        static::saved(function (FooterLinkTranslation $footer_link_translation) {
            Event::dispatch('footer_link_translation.saved', $footer_link_translation);
        });
        static::deleted(function (FooterLinkTranslation $footer_link_translation) {
            Event::dispatch('footer_link_translation.deleted', $footer_link_translation);
        });
        static::restored(function (FooterLinkTranslation $footer_link_translation) {
            Event::dispatch('footer_link_translation.restored', $footer_link_translation);
        });
    }
   
}
