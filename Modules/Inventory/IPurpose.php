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

class IPurpose extends Model
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

    protected $table = 'i_purposes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order','image', 'created_at', 'updated_at'
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
    protected static $logName = 'i_purpose_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Purpose ".$this->translations->first()->purpose." has been {$eventName}" : "Purpose #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $ipurpose = $this;
        return Cache::rememberForever('i_purpose_'.$this->id.'_purpose_'.App::getLocale(), function() use ($ipurpose) {
            $ipurpose = $ipurpose->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $ipurpose ? $ipurpose->purpose : null;
        });
    }
    public function getDefaultValueAttribute()
    {
        $ipurpose = $this;
        return Cache::rememberForever('i_purpose_'.$this->id.'_purpose_'.'default', function() use ($ipurpose) {
            $ipurpose = $ipurpose->translations->where('language_id', Language::where('code', 'en')->select('id')->first()->id)->first();
            return $ipurpose ? $ipurpose->purpose : null;
        });
    }
    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IPurposeTranslation', 'i_purpose_id', 'id');
    }

    public function purposeTypes()
    {
        return $this->hasMany('Modules\Inventory\IPurposeType', 'i_purpose_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_purpose_id', 'id');
    }

    public function types()
    {
        return $this->belongsToMany('Modules\KeyWords\KeyWordType','key_word_types','type_id','key_word_id', 'id');
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (IPurpose $ipurpose) {
            Event::dispatch('i_purpose.created', $ipurpose);
        });
        static::updated(function (IPurpose $ipurpose) {
            Event::dispatch('i_purpose.updated', $ipurpose);
        });
        static::saved(function (IPurpose $ipurpose) {
            Event::dispatch('i_purpose.saved', $ipurpose);
        });
        static::deleted(function (IPurpose $ipurpose) {
            Event::dispatch('i_purpose.deleted', $ipurpose);
        });
        static::restored(function (IPurpose $ipurpose) {
            Event::dispatch('i_purpose.restored', $ipurpose);
        });
        // static::addGlobalScope('order', function (Builder $builder) {
        //     $builder->orderBy('order', 'asc');
        // });
    }

}
