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

class IView extends Model
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

    protected $table = 'i_views';
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
    protected static $logName = 'i_view_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "View ".$this->translations->first()->view." has been {$eventName}" : "View #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_view = $this;
        return Cache::rememberForever('i_view_'.$this->id.'_view_'.App::getLocale(), function() use ( $i_view) {
            $i_view = $i_view->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_view ? $i_view->view : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IViewTranslation', 'i_view_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_view_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IView $i_view) {
            Event::dispatch('i_view.created', $i_view);
        });
        static::updated(function (IView $i_view) {
            Event::dispatch('i_view.updated', $i_view);
        });
        static::saved(function (IView $i_view) {
            Event::dispatch('i_view.saved', $i_view);
        });
        static::deleted(function (IView $i_view) {
            Event::dispatch('i_view.deleted', $i_view);
        });
        static::restored(function (IView $i_view) {
            Event::dispatch('i_view.restored', $i_view);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
