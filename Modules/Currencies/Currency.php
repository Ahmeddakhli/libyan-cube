<?php

namespace Modules\Currencies;

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

class Currency extends Model
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

    protected $table = 'currencies';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'priority', 'iso_code', 'name', 'symbol', 'subunit', 'subunit_to_unit', 'symbol_first', 'html_entity', 'decimal_mark', 'thousands_separator', 'iso_numeric', 'created_at', 'updated_at'
    ];

    protected $appends = [];

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
    protected static $logName = 'currency_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Currency ".$this->name." has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Currency $currency) {
            Event::fire('currency.created', $currency);
        });
        static::updated(function (Currency $currency) {
            Event::fire('currency.updated', $currency);
        });
        static::saved(function (Currency $currency) {
            Event::fire('currency.saved', $currency);
        });
        static::deleted(function (Currency $currency) {
            Event::fire('currency.deleted', $currency);
        });
        static::restored(function (Currency $currency) {
            Event::fire('currency.restored', $currency);
        });
    }
}
