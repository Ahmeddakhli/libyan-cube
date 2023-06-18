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

class IAreaUnit extends Model
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

    protected $table = 'i_area_units';
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
    protected static $logName = 'i_area_unit_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Area unit ".$this->translations->first()->area_unit." has been {$eventName}" : "Area unit #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_area_unit = $this;
        return Cache::rememberForever('i_area_unit_'.$this->id.'_area_unit_'.App::getLocale(), function() use ($i_area_unit) {
            $i_area_unit = $i_area_unit->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_area_unit ? $i_area_unit->area_unit : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IAreaUnitTranslation', 'i_area_unit_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_area_unit_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IAreaUnit $i_area_unit) {
            Event::dispatch('i_area_unit.created', $i_area_unit);
        });
        static::updated(function (IAreaUnit $i_area_unit) {
            Event::dispatch('i_area_unit.updated', $i_area_unit);
        });
        static::saved(function (IAreaUnit $i_area_unit) {
            Event::dispatch('i_area_unit.saved', $i_area_unit);
        });
        static::deleted(function (IAreaUnit $i_area_unit) {
            Event::dispatch('i_area_unit.deleted', $i_area_unit);
        });
        static::restored(function (IAreaUnit $i_area_unit) {
            Event::dispatch('i_area_unit.restored', $i_area_unit);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
