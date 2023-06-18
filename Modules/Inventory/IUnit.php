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
use Lang;

class IUnit extends Model implements HasMedia
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

    protected $table = 'i_units';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'slug', 'i_project_id', 'i_unit_type_id', 'video', 'installments', 'unit_number', 'building_number', 'seller_id', 'i_position_id', 'i_view_id', 'area', 'garden_area', 'plot_area', 'build_up_area', 'i_bedroom_id', 'i_bathroom_id', 'i_floor_number_id', 'i_purpose_id', 'i_purpose_type_id', 'country_id', 'region_id', 'city_id', 'area_id', 'latitude', 'longitude', 'i_offering_type_id', 'price', 'i_payment_method_id', 'buyer_id', 'down_payment', 'number_of_installments', 'currency_code', 'i_area_unit_id', 'roof_area', 'terrace_area', 'i_garden_area_unit_id', 'i_furnishing_status_id', 'i_design_type_id', 'i_finishing_type_id', 'is_featured', 'is_active', 'created_at', 'updated_at', 'ready_to_move','rent_price','resale_price'
    ];

    protected $appends = [
        'address', 'description', 'title', 'slug', 'default_title', 'meta_title', 'default_description', 'meta_description', 'default_meta_title', 'default_meta_description'
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
    protected static $logName = 'i_unit_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Unit " . $this->unit_number . " has been {$eventName}";
    }

    public function getAddressAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_address_' . App::getLocale(), function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->address : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_description_' . App::getLocale(), function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->description : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_description_' . 'en', function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->description : null;
        });
    }
    public function getMetaTitleAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_meta_title_' . App::getLocale(), function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->meta_title : null;
        });
    }

    public function getMetaDescriptionAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_meta_description_' . App::getLocale(), function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->meta_description : null;
        });
    }
    public function getDefaultMetaTitleAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_meta_title_' . 'default', function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->meta_title : null;
        });
    }
    public function getDefaultMetaDescriptionAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_meta_description_' . 'default', function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->meta_description : null;
        });
    }
    public function getTitleAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_title_' . App::getLocale(), function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->title : null;
        });
    }

    public function getDefaultTitleAttribute()
    {
        $i_unit = $this;
        return Cache::rememberForever('i_unit' . $this->id . '_title_' . 'en', function () use ($i_unit) {
            $i_unit = $i_unit->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_unit ? $i_unit->title : null;
        });
    }

    public function getSlugAttribute()
    {
        return str_slug($this->title);
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IUnitTranslation', 'i_unit_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('Modules\Inventory\IProject', 'i_project_id', 'id');
    }

    public function unitType()
    {
        return $this->belongsTo('Modules\Inventory\UnitType', 'i_unit_type_id', 'id');
    }
    public function position()
    {
        return $this->belongsTo('Modules\Inventory\IPosition', 'i_position_id', 'id');
    }

    public function view()
    {
        return $this->belongsTo('Modules\Inventory\IView', 'i_view_id', 'id');
    }

    public function bedroom()
    {
        return $this->belongsTo('Modules\Inventory\IBedroom', 'i_bedroom_id', 'id');
    }

    public function bathroom()
    {
        return $this->belongsTo('Modules\Inventory\IBathroom', 'i_bathroom_id', 'id');
    }

    public function floorNumber()
    {
        return $this->belongsTo('Modules\Inventory\IFloorNumber', 'i_floor_number_id', 'id');
    }

    public function purpose()
    {
        return $this->belongsTo('Modules\Inventory\IPurpose', 'i_purpose_id', 'id');
    }

    public function purposeType()
    {
        return $this->belongsTo('Modules\Inventory\IPurposeType', 'i_purpose_type_id', 'id');
    }

    public function offeringType()
    {
        return $this->belongsTo('Modules\Inventory\IOfferingType', 'i_offering_type_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('Modules\Inventory\IPaymentMethod', 'i_payment_method_id', 'id');
    }

    public function areaUnit()
    {
        return $this->belongsTo('Modules\Inventory\IAreaUnit', 'i_area_unit_id', 'id');
    }

    public function gardenAreaUnit()
    {
        return $this->belongsTo('Modules\Inventory\IAreaUnit', 'i_garden_area_unit_id', 'id');
    }

    public function furnishingStatus()
    {
        return $this->belongsTo('Modules\Inventory\IFurnishingStatus', 'i_furnishing_status_id', 'id');
    }

    public function finishingType()
    {
        return $this->belongsTo('Modules\Inventory\IFinishingType', 'i_finishing_type_id', 'id');
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

    public function rentalCases()
    {
        return $this->hasMany('Modules\Inventory\IRentalCase', 'i_unit_id', 'id');
    }

    public function publishTimes()
    {
        return $this->hasMany('Modules\Inventory\IPublishTime', 'i_unit_id', 'id');
    }

    public function designType()
    {
        return $this->belongsTo('Modules\Inventory\IDesignType', 'i_design_type_id', 'id');
    }

    public function favoredByUsers()
    {
        return $this->belongsToMany('App\User', 'favorites', 'unit_id', 'user_id')->withTimestamps();
    }


    /*************************************************************************
     * Modules
     *************************************************************************/

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id', 'id');
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
    public function areaPlace()
    {
        return $this->belongsTo('Modules\Locations\Location', 'area_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id', 'id');
    }

    // Images 360 relation
    public function images()
    {
        return $this->hasMany('Modules\Inventory\IUnitImage', 'i_unit_id', 'id');
    }

    // Handle IS Featured
    public function setIsFeaturedAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_featured'] = 1;
        } else {
            $this->attributes['is_featured'] = 0;
        }
    }

    // Handle IS Active
    public function setIsActiveAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['is_active'] = 1;
        } else {
            $this->attributes['is_active'] = 0;
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

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function ratings()
    {
        return $this->morphMany('Modules\Ratings\Rating', 'rateable');
    }

    public function attachmentables()
    {
        return $this->morphMany('Modules\Attachments\Entities\Attachmentable', 'attachmentable')->orderBy('type')->orderBy('order');
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
        return $this->morphMany(PaymentPlan::class, 'model');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IUnit $i_unit) {
            Event::dispatch('i_unit.created', $i_unit);
        });
        static::updated(function (IUnit $i_unit) {
            Event::dispatch('i_unit.updated', $i_unit);
        });
        static::saved(function (IUnit $i_unit) {
            Event::dispatch('i_unit.saved', $i_unit);
        });
        static::deleted(function (IUnit $i_unit) {
            Event::dispatch('i_unit.deleted', $i_unit);
        });
        static::restored(function (IUnit $i_unit) {
            Event::dispatch('i_unit.restored', $i_unit);
        });
    }
}
