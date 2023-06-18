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
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\User;
use Spatie\MediaLibrary\File;

class IProject extends Model implements HasMedia
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

    protected $table = 'i_projects';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'developer_id', 'slug', 'video', 'delivery_date', 'finished_status', 'country_id', 'region_id', 'city_id', 'area_id', 'latitude', 'longitude', 'address', 'area_from', 'area_to', 'price_from', 'price_to', 'currency_code', 'i_area_unit_id', 'down_payment_from', 'down_payment_to', 'number_of_installments_from', 'number_of_installments_to', 'is_featured', 'publish_id', 'is_published', 'in_discover_by', 'created_at', 'updated_at','ready_to_move','landing_page_image'
    ];

    protected $appends = [
        'value', 'default_value', 'second_title', 'default_second_title', 'description', 'default_description', 'landing_description', 'default_landing_description', 'meta_title', 'meta_description'
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
    protected static $logName = 'i_project_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Project " . $this->value . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_project_' . App::getLocale(), function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iproject ? $iproject->project : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_project_' . 'default', function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $iproject ? $iproject->project : null;
        });
    }

    public function getSecondTitleAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_second_title_' . App::getLocale(), function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iproject ? $iproject->second_title : null;
        });
    }

    public function getDefaultSecondTitleAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_second_title_' . 'default', function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $iproject ? $iproject->second_title : null;
        });
    }
    public function getDescriptionAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_description_' . App::getLocale(), function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iproject ? $iproject->description : null;
        });
    }


    public function getDefaultDescriptionAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_description_' . 'default', function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $iproject ? $iproject->description : null;
        });
    }

    public function getLandingDescriptionAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_landing_description_' . App::getLocale(), function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iproject ? $iproject->landing_description : null;
        });
    }


    public function getDefaultLandingDescriptionAttribute()
    {
        $iproject = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_landing_description_' . 'default', function () use ($iproject) {
            $iproject = $iproject->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $iproject ? $iproject->landing_description : null;
        });
    }

    public function getMetaDescriptionAttribute()
    {
        $i_project = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_meta_description_' . App::getLocale(), function () use ($i_project) {
            $i_project = $i_project->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_project ? $i_project->meta_description : null;
        });
    }

    public function getMetaTitleAttribute()
    {
        $i_project = $this;
        return Cache::rememberForever('i_project_' . $this->id . '_meta_title_' . App::getLocale(), function () use ($i_project) {
            $i_project = $i_project->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_project ? $i_project->meta_title : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IProjectTranslation', 'i_project_id', 'id');
    }

    public function developer()
    {
        return $this->belongsTo('Modules\Inventory\IDeveloper', 'developer_id', 'id');
    }

    public function facilities()
    {
        return $this->morphToMany('Modules\Inventory\IFacility', 'i_facilitable');
    }

    public function amenities()
    {
        return $this->morphToMany('Modules\Inventory\IAmenity', 'i_amenitable');
    }

    public function tags()
    {
        return $this->morphToMany('Modules\Tags\Tag', 'tagable');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_project_id', 'id');
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

    public function areaUnit()
    {
        return $this->belongsTo('Modules\Inventory\IAreaUnit', 'i_area_unit_id', 'id');
    }

    public function phases()
    {
        return $this->hasMany('Modules\Inventory\IPhase', 'project_id', 'id');
    }

    public function unitTypes()
    {
        return $this->hasMany('Modules\Inventory\UnitType', 'project_id', 'id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    
    public function paymentPlans()
    {
        return $this->morphMany('Modules\Inventory\PaymentPlan', 'model');
    }
    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',inventory,projects,' . $this->id . ',' . 'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xls', 'application/vnd.ms-excel', // Excel
                    'pdf', 'application/pdf', 'csv', 'text/csv', 'txt', 'text/plain', // Other Files
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                    'ai', 'application/postscript', 'psd', 'image/vnd.adobe.photoshop', // Images
                    'mp4', 'video/mp4', 'm4v', 'video/x-m4v', 'f4v', 'video/x-f4v', // MP4
                    '3gp', 'video/3gpp', '3g2', 'video/3gpp2', // 3GP
                    'oga', 'audio/ogg', 'ogv', 'video/ogg', 'ogx', 'application/ogg', // OGG
                    'wmv', 'video/x-ms-wmv', 'wma', 'audio/x-ms-wma', 'asf', 'video/x-ms-asf', // WMV
                    'webm', 'video/webm', 'flv', 'video/x-flv', 'avi', 'video/x-msvideo', 'wmx', 'video/x-ms-wmx', 'wvx', 'video/x-ms-wvx', 'mkv', 'video/x-matroska', 'mpeg', 'video/mpeg', // Other video formats
                    'wav', 'audio/x-wav', 'aif', 'audio/x-aiff', 'flac', 'audio/x-flac', 'acc', 'application/vnd.americandynamics.acc', 'audio/mpeg', 'mpga', // Audio
                    'doc', 'application/msword', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', // Microsoft Office
                ));
            })->useDisk('public');

        $this->addMediaCollection(request()->getHttpHost() . ',inventory,projects,' . $this->id . ',' . 'floorplans')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                ));
            })->useDisk('public');
    }

    public function ratings()
    {
        return $this->morphMany('Modules\Ratings\Rating', 'rateable');
    }

    public function attachmentables()
    {
        return $this->morphMany('Modules\Attachments\Entities\Attachmentable', 'attachmentable');
    }

    public function attachments()
    {
        return $this->morphMany('Modules\Attachments\Entities\Attachmentable', 'attachmentable')->where('type', 'attachment')->orderBy('order');
    }

    public function floorPlans()
    {
        return $this->morphMany('Modules\Attachments\Entities\Attachmentable', 'attachmentable')->where('type', 'floorplan')->orderBy('order');
    }

    public function masterPlans()
    {
        return $this->morphMany('Modules\Attachments\Entities\Attachmentable', 'attachmentable')->where('type', 'masterplan')->orderBy('order');
    }

    //  Handle Is Featured
    public function setIsFeaturedAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_featured'] = 1;
        } else {
            $this->attributes['is_featured'] = 0;
        }
    }
    //  Handle ready to move
    public function setReadyToMoveAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['ready_to_move'] = 1;
        } else {
            $this->attributes['ready_to_move'] = 0;
        }
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
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

        static::created(function (IProject $iproject) {
            Event::dispatch('i_project.created', $iproject);
        });
        static::updated(function (IProject $iproject) {
            Event::dispatch('i_project.updated', $iproject);
        });
        static::saved(function (IProject $iproject) {
            Event::dispatch('i_project.saved', $iproject);
        });
        static::deleted(function (IProject $iproject) {
            Event::dispatch('i_project.deleted', $iproject);
        });
        static::restored(function (IProject $iproject) {
            Event::dispatch('i_project.restored', $iproject);
        });
    }
}
