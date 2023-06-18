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

class IUnitImage extends Model implements HasMedia
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

    protected $table = 'i_unit_images';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','link','i_unit_id','created_at', 'updated_at'
    ];

    protected $appends = [
        'value'
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
    protected static $logName = 'i_unit_image_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Unit Image " . $this->id . " has been {$eventName}";
    }

    public function getValueAttribute()
    {
        $i_unit_image = $this;
        return Cache::rememberForever('i_unit_image' . $this->id . '_title_' . App::getLocale(), function () use ($i_unit_image) {
            $i_unit_image = $i_unit_image->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_unit_image ? $i_unit_image->title : null;
        });
    }


    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IUnitImageTranslation', 'i_unit_image_id', 'id');
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (IUnitImage $i_unit_image) {
            Event::dispatch('i_unit_image.created', $i_unit_image);
        });
        static::updated(function (IUnitImage $i_unit_image) {
            Event::dispatch('i_unit_image.updated', $i_unit_image);
        });
        static::saved(function (IUnitImage $i_unit_image) {
            Event::dispatch('i_unit_image.saved', $i_unit_image);
        });
        static::deleted(function (IUnitImage $i_unit_image) {
            Event::dispatch('i_unit_image.deleted', $i_unit_image);
        });
        static::restored(function (IUnitImage $i_unit_image) {
            Event::dispatch('i_unit_image.restored', $i_unit_image);
        });
    }
}
