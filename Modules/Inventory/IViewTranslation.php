<?php

namespace Modules\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class IViewTranslation extends Model
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

    protected $table = 'i_view_trans';
    protected $primaryKey = ['i_view_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_view_id', 'language_id', 'view', 'created_at', 'updated_at'
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
    protected static $logName = 'i_view_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "View Translation ".$this->view." has been {$eventName}";
    }

    public function iView()
    {
        return $this->belongsTo('Modules\Inventory\IView', 'i_view_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IViewTranslation $i_view_translation) {
            Event::dispatch('i_view_translation.created', $i_view_translation);
        });
        static::updated(function (IViewTranslation $i_view_translation) {
            Event::dispatch('i_view_translation.updated', $i_view_translation);
        });
        static::saved(function (IViewTranslation $i_view_translation) {
            Event::dispatch('i_view_translation.saved', $i_view_translation);
        });
        static::deleted(function (IViewTranslation $i_view_translation) {
            Event::dispatch('i_view_translation.deleted', $i_view_translation);
        });
        static::restored(function (IViewTranslation $i_view_translation) {
            Event::dispatch('i_view_translation.restored', $i_view_translation);
        });
    }
}
