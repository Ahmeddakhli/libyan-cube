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

class IPurposeType extends Model
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

    protected $table = 'i_purpose_types';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'svg', 'i_purpose_id', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value','default_value'
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
    protected static $logName = 'i_purpose_type_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Purpose type ".$this->translations->first()->purpose_type." has been {$eventName}" : "Purpose type #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_purpose_type = $this;
        return Cache::rememberForever('i_purpose_type_'.$this->id.'_purpose_type_'.App::getLocale(), function() use ($i_purpose_type) {
            $i_purpose_type = $i_purpose_type->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_purpose_type ? $i_purpose_type->purpose_type : null;
        });
    }

    public function getDefaultValueAttribute()
    {
        $i_purpose_type = $this;
        return Cache::rememberForever('i_purpose_type_'.$this->id.'_purpose_type_'.'en', function() use ($i_purpose_type) {
            $i_purpose_type = $i_purpose_type->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $i_purpose_type ? $i_purpose_type->purpose_type : null;
        });
    }
    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IPurposeTypeTranslation', 'i_purpose_type_id', 'id');
    }

    public function purpose()
    {
        return $this->belongsTo('Modules\Inventory\IPurpose', 'i_purpose_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_purpose_type_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPurposeType $i_purpose_type) {
            Event::dispatch('i_purpose_type.created', $i_purpose_type);
        });
        static::updated(function (IPurposeType $i_purpose_type) {
            Event::dispatch('i_purpose_type.updated', $i_purpose_type);
        });
        static::saved(function (IPurposeType $i_purpose_type) {
            Event::dispatch('i_purpose_type.saved', $i_purpose_type);
        });
        static::deleted(function (IPurposeType $i_purpose_type) {
            Event::dispatch('i_purpose_type.deleted', $i_purpose_type);
        });
        static::restored(function (IPurposeType $i_purpose_type) {
            Event::dispatch('i_purpose_type.restored', $i_purpose_type);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
