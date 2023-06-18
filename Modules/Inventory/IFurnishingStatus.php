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

class IFurnishingStatus extends Model
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

    protected $table = 'i_furnishing_statuses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'color_class', 'created_at', 'updated_at'
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
    protected static $logName = 'i_furnishing_status_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Furnishing status ".$this->translations->first()->furnishing_status." has been {$eventName}" : "Furnishing status #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $ifurnishing_status = $this;
        return Cache::rememberForever('i_furnishing_status_'.$this->id.'_furnishing_status_'.App::getLocale(), function() use ($ifurnishing_status) {
            $ifurnishing_status = $ifurnishing_status->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $ifurnishing_status ? $ifurnishing_status->furnishing_status : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IFurnishingStatusTranslation', 'i_fur_status_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_furnishing_status_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IFurnishingStatus $ifurnishing_status) {
            Event::dispatch('i_furnishing_status.created', $ifurnishing_status);
        });
        static::updated(function (IFurnishingStatus $ifurnishing_status) {
            Event::dispatch('i_furnishing_status.updated', $ifurnishing_status);
        });
        static::saved(function (IFurnishingStatus $ifurnishing_status) {
            Event::dispatch('i_furnishing_status.saved', $ifurnishing_status);
        });
        static::deleted(function (IFurnishingStatus $ifurnishing_status) {
            Event::dispatch('i_furnishing_status.deleted', $ifurnishing_status);
        });
        static::restored(function (IFurnishingStatus $ifurnishing_status) {
            Event::dispatch('i_furnishing_status.restored', $ifurnishing_status);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
