<?php

namespace Modules\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use App;
use App\Language;
use Cache;
use Wildside\Userstamps\Userstamps;

class Location extends Model
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

    protected $table = 'locations';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'parent_id', 'slug', 'code', 'order', 'is_active', 'in_discover_by', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value', 'default_value', 'second_title', 'default_second_title', 'description', 'default_description', 'meta_title', 'default_meta_title', 'meta_description', 'default_meta_description'
    ];

    protected $softCascade = ['children'];

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
    protected static $logName = 'location_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Location " . $this->name . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        if (Location::count()) {
            $location = $this;
            $location_value = Cache::rememberForever('locations_' . $this->id . '_location_' . App::getLocale(), function () use ($location) {
                $location = $location->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $location ? $location->name : null;
            });

            if (!$location_value) {
                // Return default value (ar)
                return Cache::rememberForever('locations_' . $this->id . '_location_value_' . 'en', function () use ($location) {
                    $location = $location->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
                    return $location ? $location->name : null;
                });
            }

            return $location_value;
        }
    }

    public function getDefaultValueAttribute()
    {
        $location = $this;
        return Cache::rememberForever('locations_' . $this->id . '_location_default_value_' . 'en', function () use ($location) {
            $location = $location->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $location ? $location->name : null;
        });
    }

    public function getDescriptionAttribute()
    {
        if (Location::count()) {
            $location = $this;
            $location_descrition = Cache::rememberForever('locations_' . $this->id . '_location_description' . App::getLocale(), function () use ($location) {
                $location = $location->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $location ? $location->description : null;
            });

            return $location_descrition;
        }
    }
    public function getDefaultDescriptionAttribute()
    {
        $location = $this;
        return Cache::rememberForever('locations_' . $this->id . '_location_default_description' . 'en', function () use ($location) {
            $location = $location->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $location ? $location->description : null;
        });
    }

    public function getSecondTitleAttribute()
    {
        if (Location::count()) {
            $location = $this;
            $location_descrition = Cache::rememberForever('locations_' . $this->id . '_location_second_title' . App::getLocale(), function () use ($location) {
                $location = $location->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $location ? $location->second_title : null;
            });

            return $location_descrition;
        }
    }
    public function getDefaultSecondTitleAttribute()
    {
        $location = $this;
        return Cache::rememberForever('locations_' . $this->id . '_location_default_second_title' . 'en', function () use ($location) {
            $location = $location->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $location ? $location->second_title : null;
        });
    }
    public function getMetaTitleAttribute()
    {
        if (Location::count()) {
            $location = $this;
            $location_descrition = Cache::rememberForever('locations_' . $this->id . '_location_meta_title' . App::getLocale(), function () use ($location) {
                $location = $location->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $location ? $location->meta_title : null;
            });

            return $location_descrition;
        }
    }
    public function getDefaultMetaTitleAttribute()
    {
        $location = $this;
        return Cache::rememberForever('locations_' . $this->id . '_location_default_meta_title' . 'en', function () use ($location) {
            $location = $location->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $location ? $location->meta_title : null;
        });
    }
    public function getMetaDescriptionAttribute()
    {
        if (Location::count()) {
            $location = $this;
            $location_descrition = Cache::rememberForever('locations_' . $this->id . '_location_meta_description' . App::getLocale(), function () use ($location) {
                $location = $location->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
                return $location ? $location->meta_description : null;
            });

            return $location_descrition;
        }
    }
    public function getDefaultMetaDescriptionAttribute()
    {
        $location = $this;
        return Cache::rememberForever('locations_' . $this->id . '_location_default_meta_description' . 'en', function () use ($location) {
            $location = $location->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $location ? $location->meta_description : null;
        });
    }
    public function translations()
    {
        return $this->hasMany('Modules\Locations\LocationTranslation', 'location_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Locations\Location', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Locations\Location', 'parent_id', 'id');
    }
    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'city_id', 'id');
    }
    public function projects()
    {
        return $this->hasMany('Modules\Inventory\IProject', 'city_id', 'id');
    }

    //  Handle in discover by
    public function setInDiscoverByAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['in_discover_by'] = 1;
        } else {
            $this->attributes['in_discover_by'] = 0;
        }
    }

    public function scopeDiscoverBy($query)
    {
        return $query->where('in_discover_by', 1);
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (Location $location) {
            Event::dispatch('location.created', $location);
        });
        static::updated(function (Location $location) {
            Event::dispatch('location.updated', $location);
        });
        static::saved(function (Location $location) {
            Event::dispatch('location.saved', $location);
        });
        static::deleted(function (Location $location) {
            Event::dispatch('location.deleted', $location);
        });
        static::restored(function (Location $location) {
            Event::dispatch('location.restored', $location);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    /**
     * Scope a query to only include active locations.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    // Handle IS Active 
    public function setIsActiveAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_active'] = 1;
        } elseif ($value == "off") {
            $this->attributes['is_active'] = 0;
        }
    }
}
