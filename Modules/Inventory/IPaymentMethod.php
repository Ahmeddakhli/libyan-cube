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

class IPaymentMethod extends Model
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

    protected $table = 'i_payment_methods';
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
    protected static $logName = 'i_payment_method_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Payment method ".$this->translations->first()->payment_method." has been {$eventName}" : "Payment method #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $ipayment_method = $this;
        return Cache::rememberForever('i_payment_method_'.$this->id.'_payment_method_'.App::getLocale(), function() use ($ipayment_method) {
            $ipayment_method = $ipayment_method->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $ipayment_method ? $ipayment_method->payment_method : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IPaymentMethodTranslation', 'i_payment_method_id', 'id');
    }

    public function units()
    {
        return $this->hasMany('Modules\Inventory\IUnit', 'i_payment_method_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPaymentMethod $ipayment_method) {
            Event::dispatch('i_payment_method.created', $ipayment_method);
        });
        static::updated(function (IPaymentMethod $ipayment_method) {
            Event::dispatch('i_payment_method.updated', $ipayment_method);
        });
        static::saved(function (IPaymentMethod $ipayment_method) {
            Event::dispatch('i_payment_method.saved', $ipayment_method);
        });
        static::deleted(function (IPaymentMethod $ipayment_method) {
            Event::dispatch('i_payment_method.deleted', $ipayment_method);
        });
        static::restored(function (IPaymentMethod $ipayment_method) {
            Event::dispatch('i_payment_method.restored', $ipayment_method);
        });
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
