<?php

namespace Modules\Settings;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class TopAgent extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'top_agents';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * Get the class being used to provide a User.
     *
     * @return string
     */
    protected function getUserClass()
    {
        return "App\User";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'created_at', 'updated_at'
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
    protected static $logName = 'top_agent_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Top Agent " . $this->id . " has been {$eventName}";
    }

    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

    public function socials()
    {
        return $this->hasMany('Modules\Settings\AgentSocials', 'top_agent_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (TopAgent $top_agent) {
            Event::dispatch('top_agent.created', $top_agent);
        });
        static::updated(function (TopAgent $top_agent) {
            Event::dispatch('top_agent.updated', $top_agent);
        });
        static::saved(function (TopAgent $top_agent) {
            Event::dispatch('top_agent.saved', $top_agent);
        });
        static::deleted(function (TopAgent $top_agent) {
            Event::dispatch('top_agent.deleted', $top_agent);
        });
        static::restored(function (TopAgent $top_agent) {
            Event::dispatch('top_agent.restored', $top_agent);
        });
    }
}
