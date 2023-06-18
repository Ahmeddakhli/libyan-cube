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

class IDeveloperTranslation extends Model
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

    protected $table = 'i_developer_trans';
    protected $primaryKey = ['i_developer_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_developer_id', 'language_id', 'developer', 'description', 'meta_title', 'meta_description', 'created_at', 'updated_at'
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
    protected static $logName = 'i_developer_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Developer Translation ".$this->developer." has been {$eventName}";
    }

    public function iDeveloper()
    {
        return $this->belongsTo('Modules\Inventory\IDeveloper', 'i_developer_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IDeveloperTranslation $i_developer_translation) {
            Event::dispatch('i_developer_translation.created', $i_developer_translation);
        });
        static::updated(function (IDeveloperTranslation $i_developer_translation) {
            Event::dispatch('i_developer_translation.updated', $i_developer_translation);
        });
        static::saved(function (IDeveloperTranslation $i_developer_translation) {
            Event::dispatch('i_developer_translation.saved', $i_developer_translation);
        });
        static::deleted(function (IDeveloperTranslation $i_developer_translation) {
            Event::dispatch('i_developer_translation.deleted', $i_developer_translation);
        });
        static::restored(function (IDeveloperTranslation $i_developer_translation) {
            Event::dispatch('i_developer_translation.restored', $i_developer_translation);
        });
    }
}
