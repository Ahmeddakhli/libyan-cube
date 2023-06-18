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
use Ramsey\Uuid\Uuid;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class IAmenity extends Model implements HasMedia
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

    protected $table = 'i_amenities';
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
        'value', 'description'
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
    protected static $logName = 'i_amenity_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Amenity ".$this->translations->first()->amenity." has been {$eventName}" : "Amenity #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $iamenity = $this;
        return Cache::rememberForever('i_amenity_' . $this->id . '_amenity_' . App::getLocale(), function () use ($iamenity) {
            $iamenity = $iamenity->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iamenity ? $iamenity->amenity : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $iamenity = $this;
        return Cache::rememberForever('i_amenity_' . $this->id . '_description_' . App::getLocale(), function () use ($iamenity) {
            $iamenity = $iamenity->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iamenity ? $iamenity->description : null;
        });
    }
    public static function generateUuid()
    {
         return Uuid::uuid1();
    }
    public function setIdAttribute($value)
    {
        $this->attributes['id'] = $this->generateUuid();
    }
    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IAmenityTranslation', 'i_amenity_id', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',inventory,amenities,' . $this->id . ',' . 'attachments')
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

        static::created(function (IAmenity $iamenity) {
            Event::dispatch('i_amenity.created', $iamenity);
        });
        static::updated(function (IAmenity $iamenity) {
            Event::dispatch('i_amenity.updated', $iamenity);
        });
        static::saved(function (IAmenity $iamenity) {
            Event::dispatch('i_amenity.saved', $iamenity);
        });
        static::deleted(function (IAmenity $iamenity) {
            Event::dispatch('i_amenity.deleted', $iamenity);
        });
        static::restored(function (IAmenity $iamenity) {
            Event::dispatch('i_amenity.restored', $iamenity);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
