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
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;


class IDeveloper extends Model implements HasMedia

{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps, HasMediaTrait;

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

    protected $table = 'i_developers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'country_id', 'region_id', 'city_id', 'area_id', 'slug', 'developer_name', 'developer_email', 'in_discover_by', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value', 'description', 'default_value', 'default_description', 'meta_title', 'meta_description'
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
    protected static $logName = 'i_developer_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Developer " . $this->value . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $i_developer = $this;
        return Cache::rememberForever('i_developer_' . $this->id . '_developer_' . App::getLocale(), function () use ($i_developer) {
            $i_developer = $i_developer->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_developer ? $i_developer->developer : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $i_developer = $this;
        return Cache::rememberForever('i_developer_' . $this->id . '_description_' . App::getLocale(), function () use ($i_developer) {
            $i_developer = $i_developer->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_developer ? $i_developer->description : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $i_developer = $this;
        return Cache::rememberForever('i_developer_' . $this->id . '_developer_' . 'default', function () use ($i_developer) {
            $i_developer = $i_developer->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_developer ? $i_developer->developer : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $i_developer = $this;
        return Cache::rememberForever('i_developer_' . $this->id . '_description_' . 'default', function () use ($i_developer) {
            $i_developer = $i_developer->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_developer ? $i_developer->description : null;
        });
    }

    public function getMetaDescriptionAttribute()
    {
        $i_developer = $this;
        return Cache::rememberForever('i_developer_' . $this->id . '_meta_description_' . App::getLocale(), function () use ($i_developer) {
            $i_developer = $i_developer->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_developer ? $i_developer->meta_description : null;
        });
    }

    public function getMetaTitleAttribute()
    {
        $i_developer = $this;
        return Cache::rememberForever('i_developer_' . $this->id . '_meta_title_' . App::getLocale(), function () use ($i_developer) {
            $i_developer = $i_developer->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_developer ? $i_developer->meta_title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IDeveloperTranslation', 'i_developer_id', 'id');
    }

    public function projects()
    {
        return $this->hasMany('Modules\Inventory\IProject', 'developer_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo('Modules\Locations\Location', 'country_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo('Modules\Locations\Location', 'region_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('Modules\Locations\Location', 'city_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo('Modules\Locations\Location', 'area_id', 'id');
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

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',inventory,developers,' . $this->id . ',' . 'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                ));
            })
            ->useDisk('public');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IDeveloper $ideveloper) {
            Event::dispatch('i_developer.created', $ideveloper);
        });
        static::updated(function (IDeveloper $ideveloper) {
            Event::dispatch('i_developer.updated', $ideveloper);
        });
        static::saved(function (IDeveloper $ideveloper) {
            Event::dispatch('i_developer.saved', $ideveloper);
        });
        static::deleted(function (IDeveloper $ideveloper) {
            Event::dispatch('i_developer.deleted', $ideveloper);
        });
        static::restored(function (IDeveloper $ideveloper) {
            Event::dispatch('i_developer.restored', $ideveloper);
        });
    }
}
