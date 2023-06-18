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

class IFloorNumber extends Model
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

    protected $table = 'i_floor_numbers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'count', 'created_at', 'updated_at'
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
    protected static $logName = 'i_floor_number_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Floor Number ".$this->translations->first()->displayed_text." has been {$eventName}" : "Floor Number #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $ifloor_number = $this;
        return Cache::rememberForever('i_floor_number_'.$this->id.'_floor_number_'.App::getLocale(), function() use ($ifloor_number) {
            $ifloor_number = $ifloor_number->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $ifloor_number ? $ifloor_number->displayed_text : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IFloorNumberTranslation', 'i_floor_number_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_floor_number_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IFloorNumber $ifloor_number) {
            Event::dispatch('i_floor_number.created', $ifloor_number);
        });
        static::updated(function (IFloorNumber $ifloor_number) {
            Event::dispatch('i_floor_number.updated', $ifloor_number);
        });
        static::saved(function (IFloorNumber $ifloor_number) {
            Event::dispatch('i_floor_number.saved', $ifloor_number);
        });
        static::deleted(function (IFloorNumber $ifloor_number) {
            Event::dispatch('i_floor_number.deleted', $ifloor_number);
        });
        static::restored(function (IFloorNumber $ifloor_number) {
            Event::dispatch('i_floor_number.restored', $ifloor_number);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
