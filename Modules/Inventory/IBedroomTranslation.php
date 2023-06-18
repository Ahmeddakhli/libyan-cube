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

class IBedroomTranslation extends Model
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

    protected $table = 'i_bedroom_trans';
    protected $primaryKey = ['i_bedroom_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_bedroom_id', 'language_id', 'displayed_text', 'created_at', 'updated_at'
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
    protected static $logName = 'i_bedroom_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Bedroom Translation ".$this->displayed_text." has been {$eventName}";
    }

    public function iBedroom()
    {
        return $this->belongsTo('Modules\Inventory\IBedroom', 'i_bedroom_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IBedroomTranslation $i_bedroom_translation) {
            Event::dispatch('i_bedroom_translation.created', $i_bedroom_translation);
        });
        static::updated(function (IBedroomTranslation $i_bedroom_translation) {
            Event::dispatch('i_bedroom_translation.updated', $i_bedroom_translation);
        });
        static::saved(function (IBedroomTranslation $i_bedroom_translation) {
            Event::dispatch('i_bedroom_translation.saved', $i_bedroom_translation);
        });
        static::deleted(function (IBedroomTranslation $i_bedroom_translation) {
            Event::dispatch('i_bedroom_translation.deleted', $i_bedroom_translation);
        });
        static::restored(function (IBedroomTranslation $i_bedroom_translation) {
            Event::dispatch('i_bedroom_translation.restored', $i_bedroom_translation);
        });
    }
}
