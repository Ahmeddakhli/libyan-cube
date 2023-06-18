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

class IProjectTranslation extends Model
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

    protected $table = 'i_project_trans';
    protected $primaryKey = ['i_project_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_project_id', 'language_id', 'project','second_title', 'description', 'meta_title', 'meta_description', 'created_at', 'updated_at'
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
    protected static $logName = 'i_project_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Project Translation ".$this->project." has been {$eventName}";
    }

    public function iProject()
    {
        return $this->belongsTo('Modules\Inventory\IProject', 'i_project_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IProjectTranslation $iposition_translation) {
            Event::dispatch('i_project_translation.created', $iposition_translation);
        });
        static::updated(function (IProjectTranslation $iposition_translation) {
            Event::dispatch('i_project_translation.updated', $iposition_translation);
        });
        static::saved(function (IProjectTranslation $iposition_translation) {
            Event::dispatch('i_project_translation.saved', $iposition_translation);
        });
        static::deleted(function (IProjectTranslation $iposition_translation) {
            Event::dispatch('i_project_translation.deleted', $iposition_translation);
        });
        static::restored(function (IProjectTranslation $iposition_translation) {
            Event::dispatch('i_project_translation.restored', $iposition_translation);
        });
    }
}
