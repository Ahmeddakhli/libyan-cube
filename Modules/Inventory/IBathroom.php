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

class IBathroom extends Model
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

    protected $table = 'i_bathrooms';
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
    protected static $logName = 'i_bathroom_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Bathroom ".$this->translations->first()->displayed_text." has been {$eventName}" : "Bathroom #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $ibathroom = $this;
        return Cache::rememberForever('i_bathroom_'.$this->id.'_bathroom_'.App::getLocale(), function() use ($ibathroom) {
            $ibathroom = $ibathroom->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $ibathroom ? $ibathroom->displayed_text : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IBathroomTranslation', 'i_bathroom_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_bathroom_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IBathroom $ibathroom) {
            Event::dispatch('i_bathroom.created', $ibathroom);
        });
        static::updated(function (IBathroom $ibathroom) {
            Event::dispatch('i_bathroom.updated', $ibathroom);
        });
        static::saved(function (IBathroom $ibathroom) {
            Event::dispatch('i_bathroom.saved', $ibathroom);
        });
        static::deleted(function (IBathroom $ibathroom) {
            Event::dispatch('i_bathroom.deleted', $ibathroom);
        });
        static::restored(function (IBathroom $ibathroom) {
            Event::dispatch('i_bathroom.restored', $ibathroom);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
