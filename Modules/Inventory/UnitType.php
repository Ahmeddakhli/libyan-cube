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

class UnitType extends Model
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

    protected $table = 'i_unit_types';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','project_id','image','area_from','area_to','price_from','price_to', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','description','default','default_description'
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
    protected static $logName = 'i_unit_type_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Unit Type ".$this->translations->first()->unit_type." has been {$eventName}" : "Unit Type #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $unit_type = $this;
        return Cache::rememberForever('i_unit_type_'.$this->id.'_unit_type_'.App::getLocale(), function() use ($unit_type) {
            $unit_type = $unit_type->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $unit_type ? $unit_type->unit_type : null;
        });
    }
    public function getDefaultAttribute()
    {
        $unit_type = $this;
        return Cache::rememberForever('i_unit_type_'.$this->id.'_unit_type_'.'default', function() use ($unit_type) {
            $unit_type = $unit_type->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $unit_type ? $unit_type->unit_type : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $i_project = $this;
        return Cache::rememberForever('i_unit_type_' . $this->id . '_description_' . App::getLocale(), function () use ($i_project) {
            $i_project = $i_project->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_project ? $i_project->description : null;
        });
    }

    public function getDefaultDescriptionAttribute()
    {
        $unit_type = $this;
        return Cache::rememberForever('i_unit_type_'.$this->id.'_description_'.'default', function() use ($unit_type) {
            $unit_type = $unit_type->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $unit_type ? $unit_type->description : null;
        });
    }
    public function translations()
    {
        return $this->hasMany('Modules\Inventory\UnitTypeTranslation', 'i_unit_type_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_unit_type_id', 'id');
    }
    public function project()
    {
        return $this->belongsTo('Modules\Inventory\IProject', 'project_id', 'id');
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (UnitType $unit_type) {
            Event::dispatch('i_unit_type.created', $unit_type);
        });
        static::updated(function (UnitType $unit_type) {
            Event::dispatch('i_unit_type.updated', $unit_type);
        });
        static::saved(function (UnitType $unit_type) {
            Event::dispatch('i_unit_type.saved', $unit_type);
        });
        static::deleted(function (UnitType $unit_type) {
            Event::dispatch('i_unit_type.deleted', $unit_type);
        });
        static::restored(function (UnitType $unit_type) {
            Event::dispatch('i_unit_type.restored', $unit_type);
        });
    }

}
