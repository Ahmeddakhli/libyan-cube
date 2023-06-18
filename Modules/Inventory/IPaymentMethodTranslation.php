<?php

namespace Modules\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\HasCompositePrimaryKey;
use Illuminate\Support\Facades\Event;
use Cache;
use Wildside\Userstamps\Userstamps;

class IPaymentMethodTranslation extends Model
{
    use HasCompositePrimaryKey, SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

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

    protected $table = 'i_payment_method_trans';
    protected $primaryKey = ['i_payment_method_id', 'language_id'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'i_payment_method_id', 'language_id', 'payment_method', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $softCascade = [];

    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [];
    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $ignoreChangedAttributes = [];
    protected static $logOnlyDirty = true;
    protected static $logName = 'i_payment_method_translation_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Payment Method Translation ".$this->payment_method." has been {$eventName}";
    }

    public function iPaymentMethod()
    {
        return $this->belongsTo('Modules\Inventory\IPaymentMethod', 'i_payment_method_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Language', 'language_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPaymentMethodTranslation $ipayment_method_translation) {
            Event::dispatch('i_payment_method_translation.created', $ipayment_method_translation);
        });
        static::updated(function (IPaymentMethodTranslation $ipayment_method_translation) {
            Event::dispatch('i_payment_method_translation.updated', $ipayment_method_translation);
        });
        static::saved(function (IPaymentMethodTranslation $ipayment_method_translation) {
            Event::dispatch('i_payment_method_translation.saved', $ipayment_method_translation);
        });
        static::deleted(function (IPaymentMethodTranslation $ipayment_method_translation) {
            Event::dispatch('i_payment_method_translation.deleted', $ipayment_method_translation);
        });
        static::restored(function (IPaymentMethodTranslation $ipayment_method_translation) {
            Event::dispatch('i_payment_method_translation.restored', $ipayment_method_translation);
        });
    }
}
