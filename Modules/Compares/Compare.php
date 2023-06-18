<?php

namespace Modules\Compares;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Builder;

class Compare extends Model
{

    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'compares';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id', 'user_id', 'unit_id', 'session','order','created_at', 'updated_at'
    ];

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
    protected static $logName = 'compare_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Career #" . $this->id . " has been {$eventName}";
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Inventory\IUnit', 'unit_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('data', function (Builder $builder) {
            $builder->whereHas('unit');
        });
    }
}
