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
use Ramsey\Uuid\Uuid;
class IFacility extends Model implements HasMedia
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


    protected $table = 'i_facilities';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'color_class', 'svg', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','description'
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
    protected static $logName = 'i_facility_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Facility ".$this->translations->first()->facility." has been {$eventName}" : "Facility #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_facility = $this;
        return Cache::rememberForever('i_facility_'.$this->id.'_facility_'.App::getLocale(), function() use ($i_facility) {
            $i_facility = $i_facility->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_facility ? $i_facility->facility : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $i_facility = $this;
        return Cache::rememberForever('i_facility_'.$this->id.'_description_'.App::getLocale(), function() use ($i_facility) {
            $i_facility = $i_facility->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_facility ? $i_facility->description : null;
        });
    }
    

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IFacilityTranslation', 'i_facility_id', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost().',inventory,facilities,'.$this->id.','.'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                ));
            })
            ->useDisk('public');
    }
    public static function generateUuid()
    {
         return Uuid::uuid1();
    }
    public function setIdAttribute($value)
    {
        $this->attributes['id'] = $this->generateUuid();
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (IFacility $i_facility) {
            Event::dispatch('i_facility.created', $i_facility);
        });
        static::updated(function (IFacility $i_facility) {
            Event::dispatch('i_facility.updated', $i_facility);
        });
        static::saved(function (IFacility $i_facility) {
            Event::dispatch('i_facility.saved', $i_facility);
        });
        static::deleted(function (IFacility $i_facility) {
            Event::dispatch('i_facility.deleted', $i_facility);
        });
        static::restored(function (IFacility $i_facility) {
            Event::dispatch('i_facility.restored', $i_facility);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
