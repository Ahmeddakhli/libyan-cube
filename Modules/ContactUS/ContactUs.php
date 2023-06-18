<?php

namespace Modules\ContactUS;

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

class ContactUs extends Model
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
    protected $table = 'contact_us';
    protected $primaryKey = 'id';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'full_name', 'phone', 'email','type','is_readed', 'message','link', 'best_time_to_call_from', 'best_time_to_call_to', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'is_readed' => 'boolean'
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
    protected static $logName = 'contact_us_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Contact us #" . $this->id . " has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (ContactUs $contact_us) {
            Event::dispatch('contact_us.created', $contact_us);
        });
        static::updated(function (ContactUs $contact_us) {
            Event::dispatch('contact_us.updated', $contact_us);
        });
        static::saved(function (ContactUs $contact_us) {
            Event::dispatch('contact_us.saved', $contact_us);
        });
        static::deleted(function (ContactUs $contact_us) {
            Event::dispatch('contact_us.deleted', $contact_us);
        });
        static::restored(function (ContactUs $contact_us) {
            Event::dispatch('contact_us.restored', $contact_us);
        });
    }
}
