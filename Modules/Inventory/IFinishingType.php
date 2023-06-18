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

class IFinishingType extends Model
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

    protected $table = 'i_finishing_types';
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
    protected static $logName = 'i_finishing_type_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Finishing type ".$this->translations->first()->finishing_type." has been {$eventName}" : "Finishing type #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_finishing_type = $this;
        return Cache::rememberForever('i_finishing_type_'.$this->id.'_finishing_type_'.App::getLocale(), function() use ($i_finishing_type) {
            $i_finishing_type = $i_finishing_type->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_finishing_type ? $i_finishing_type->finishing_type : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IFinishingTypeTranslation', 'i_finishing_type_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_finishing_type_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IFinishingType $i_finishing_type) {
            Event::dispatch('i_finishing_type.created', $i_finishing_type);
        });
        static::updated(function (IFinishingType $i_finishing_type) {
            Event::dispatch('i_finishing_type.updated', $i_finishing_type);
        });
        static::saved(function (IFinishingType $i_finishing_type) {
            Event::dispatch('i_finishing_type.saved', $i_finishing_type);
        });
        static::deleted(function (IFinishingType $i_finishing_type) {
            Event::dispatch('i_finishing_type.deleted', $i_finishing_type);
        });
        static::restored(function (IFinishingType $i_finishing_type) {
            Event::dispatch('i_finishing_type.restored', $i_finishing_type);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
