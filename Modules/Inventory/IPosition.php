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

class IPosition extends Model
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

    protected $table = 'i_positions';
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
    protected static $logName = 'i_position_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Position ".$this->translations->first()->position." has been {$eventName}" : "Position #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $iposition = $this;
        return Cache::rememberForever('i_position_'.$this->id.'_position_'.App::getLocale(), function() use ($iposition) {
            $iposition = $iposition->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $iposition ? $iposition->position : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IPositionTranslation', 'i_position_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_position_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPosition $iposition) {
            Event::dispatch('i_position.created', $iposition);
        });
        static::updated(function (IPosition $iposition) {
            Event::dispatch('i_position.updated', $iposition);
        });
        static::saved(function (IPosition $iposition) {
            Event::dispatch('i_position.saved', $iposition);
        });
        static::deleted(function (IPosition $iposition) {
            Event::dispatch('i_position.deleted', $iposition);
        });
        static::restored(function (IPosition $iposition) {
            Event::dispatch('i_position.restored', $iposition);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
