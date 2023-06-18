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

class IBedroom extends Model
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

    protected $table = 'i_bedrooms';
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
    protected static $logName = 'i_bedroom_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Bedroom ".$this->translations->first()->displayed_text." has been {$eventName}" : "Bedroom #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_bedroom = $this;
        return Cache::rememberForever('i_bedroom_'.$this->id.'_bedroom_'.App::getLocale(), function() use ($i_bedroom) {
            $i_bedroom = $i_bedroom->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_bedroom ? $i_bedroom->displayed_text : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IBedroomTranslation', 'i_bedroom_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_bedroom_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IBedroom $i_bedroom) {
            Event::dispatch('i_bedroom.created', $i_bedroom);
        });
        static::updated(function (IBedroom $i_bedroom) {
            Event::dispatch('i_bedroom.updated', $i_bedroom);
        });
        static::saved(function (IBedroom $i_bedroom) {
            Event::dispatch('i_bedroom.saved', $i_bedroom);
        });
        static::deleted(function (IBedroom $i_bedroom) {
            Event::dispatch('i_bedroom.deleted', $i_bedroom);
        });
        static::restored(function (IBedroom $i_bedroom) {
            Event::dispatch('i_bedroom.restored', $i_bedroom);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
