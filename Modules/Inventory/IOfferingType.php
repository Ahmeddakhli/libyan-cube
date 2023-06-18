<?php

namespace Modules\Inventory;

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

class IOfferingType extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'i_offering_types';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'color_class','is_searchable', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','default_value'
    ];

    // protected $softCascade = ['translations'];
    // Deleting translations manually to overcome laravel issue with composite primary key
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
    protected static $logName = 'i_offering_type_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Offering type ".$this->translations->first()->offering_type." has been {$eventName}" : "Offering type #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $ioffering_type = $this;
        return Cache::rememberForever('i_offering_type_'.$this->id.'_offering_type_'.App::getLocale(), function() use ($ioffering_type) {
            $ioffering_type = $ioffering_type->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $ioffering_type ? $ioffering_type->offering_type : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $ioffering_type = $this;
        return Cache::rememberForever('i_offering_type_'.$this->id.'_offering_type_'.'en', function() use ($ioffering_type) {
            $ioffering_type = $ioffering_type->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $ioffering_type ? $ioffering_type->offering_type : null;
        });
    }
    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IOfferingTypeTranslation', 'i_offering_type_id', 'id');
    }

    public function offeringType()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_offering_type_id', 'id');
    }

    //  Handle is searchable
    public function setIsSearchableAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_searchable'] = 1;
        } else {
            $this->attributes['is_searchable'] = 0;
        }
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IOfferingType $ioffering_type) {
            Event::dispatch('i_offering_type.created', $ioffering_type);
        });
        static::updated(function (IOfferingType $ioffering_type) {
            Event::dispatch('i_offering_type.updated', $ioffering_type);
        });
        static::saved(function (IOfferingType $ioffering_type) {
            Event::dispatch('i_offering_type.saved', $ioffering_type);
        });
        static::deleted(function (IOfferingType $ioffering_type) {
            Event::dispatch('i_offering_type.deleted', $ioffering_type);
        });
        static::restored(function (IOfferingType $ioffering_type) {
            Event::dispatch('i_offering_type.restored', $ioffering_type);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
