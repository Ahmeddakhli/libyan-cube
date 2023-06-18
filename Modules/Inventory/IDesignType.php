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
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class IDesignType extends Model implements HasMedia
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps, HasMediaTrait;

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

    protected $table = 'i_design_types';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value', 'description'
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
    protected static $logName = 'i_design_type_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Design type ".$this->translations->first()->type." has been {$eventName}" : "Design type #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_design_type = $this;
        return Cache::rememberForever('i_design_type_'.$this->id.'_design_type_'.App::getLocale(), function() use ($i_design_type) {
            $i_design_type = $i_design_type->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_design_type ? $i_design_type->type : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $i_design_type = $this;
        return Cache::rememberForever('i_design_type_' . $this->id . '_description_' . App::getLocale(), function () use ($i_design_type) {
            $i_design_type = $i_design_type->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_design_type ? $i_design_type->description : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IDesignTypeTranslation', 'i_design_type_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_design_type_id', 'id');
    }

    // Laravel Media Library
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',inventory,design_types,' . $this->id . ',' . 'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                ));
            })
            ->useDisk('public');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IDesignType $i_design_type) {
            Event::dispatch('i_design_type.created', $i_design_type);
        });
        static::updated(function (IDesignType $i_design_type) {
            Event::dispatch('i_design_type.updated', $i_design_type);
        });
        static::saved(function (IDesignType $i_design_type) {
            Event::dispatch('i_design_type.saved', $i_design_type);
        });
        static::deleted(function (IDesignType $i_design_type) {
            Event::dispatch('i_design_type.deleted', $i_design_type);
        });
        static::restored(function (IDesignType $i_design_type) {
            Event::dispatch('i_design_type.restored', $i_design_type);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
