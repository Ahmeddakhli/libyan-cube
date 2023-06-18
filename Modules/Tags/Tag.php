<?php

namespace Modules\Tags;

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

class Tag extends Model
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

    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tag', 'color', 'created_at', 'updated_at'
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
    protected static $logName = 'tag_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Tag " . $this->tag . " has been {$eventName}";
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Tag $tag) {
            Event::dispatch('tag.created', $tag);
        });
        static::updated(function (Tag $tag) {
            Event::dispatch('tag.updated', $tag);
        });
        static::saved(function (Tag $tag) {
            Event::dispatch('tag.saved', $tag);
        });
        static::deleted(function (Tag $tag) {
            Event::dispatch('tag.deleted', $tag);
        });
        static::restored(function (Tag $tag) {
            Event::dispatch('tag.restored', $tag);
        });
    }
}
