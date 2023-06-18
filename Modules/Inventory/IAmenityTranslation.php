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

class IAmenityTranslation extends Model
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

    protected $table = 'i_amenity_trans';
    protected $primaryKey = ['i_amenity_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_amenity_id', 'language_id', 'amenity', 'description', 'created_at', 'updated_at'
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
    protected static $logName = 'i_amenity_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Amenity Translation ".$this->amenity." has been {$eventName}";
    }

    public function iAmenity()
    {
        return $this->belongsTo('Modules\Inventory\IAmenity', 'i_amenity_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IAmenityTranslation $iamenity_translation) {
            Event::dispatch('i_amenity_translation.created', $iamenity_translation);
        });
        static::updated(function (IAmenityTranslation $iamenity_translation) {
            Event::dispatch('i_amenity_translation.updated', $iamenity_translation);
        });
        static::saved(function (IAmenityTranslation $iamenity_translation) {
            Event::dispatch('i_amenity_translation.saved', $iamenity_translation);
        });
        static::deleted(function (IAmenityTranslation $iamenity_translation) {
            Event::dispatch('i_amenity_translation.deleted', $iamenity_translation);
        });
        static::restored(function (IAmenityTranslation $iamenity_translation) {
            Event::dispatch('i_amenity_translation.restored', $iamenity_translation);
        });
    }
}
