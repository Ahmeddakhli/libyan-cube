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

class IRentalCase extends Model
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

    protected $table = 'i_rental_cases';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'i_unit_id', 'renter_id', 'from', 'to', 'price', 'created_at', 'updated_at'
    ];

    protected $appends = [
        //
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
    protected static $logName = 'i_rental_case_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Rental case ".$this->id." for unit ".($this->unit ? $this->unit->unit_number : '')." has been {$eventName}";
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Inventory\IUnit', 'i_unit_id', 'id');
    }

    /*************************************************************************
     * Modules
     *************************************************************************/

    public function renter()
    {
        return $this->belongsTo('App\User', 'renter_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IRentalCase $i_rental_case) {
            Event::dispatch('i_rental_case.created', $i_rental_case);
        });
        static::updated(function (IRentalCase $i_rental_case) {
            Event::dispatch('i_rental_case.updated', $i_rental_case);
        });
        static::saved(function (IRentalCase $i_rental_case) {
            Event::dispatch('i_rental_case.saved', $i_rental_case);
        });
        static::deleted(function (IRentalCase $i_rental_case) {
            Event::dispatch('i_rental_case.deleted', $i_rental_case);
        });
        static::restored(function (IRentalCase $i_rental_case) {
            Event::dispatch('i_rental_case.restored', $i_rental_case);
        });
    }
}
