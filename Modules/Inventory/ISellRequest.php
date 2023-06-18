<?php

namespace Modules\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use Wildside\Userstamps\Userstamps;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class ISellRequest extends Model implements HasMedia
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

    protected $table = 'i_sell_requests';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'compound', 'i_purpose_id', 'i_purpose_type_id', 'unit_name', 'comments', 'name', 'email', 'phone', 'is_seen', 'created_at', 'updated_at'
    ];

    protected $appends = [
        //
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
    protected static $logName = 'sell_request_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Sell request " . $this->id . " has been {$eventName}";
    }

    public function purposeType()
    {
        return $this->belongsTo('Modules\Inventory\IPurposeType', 'i_purpose_type_id', 'id');
    }

    public function purpose(){
        return $this->belongsTo('Modules\Inventory\IPurpose', 'i_purpose_id', 'id');
    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost() . ',inventory,sell_requests,' . $this->id . ',' . 'attachments')
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

        static::created(function (ISellRequest $i_sell_request) {
            Event::dispatch('i_sell_request.created', $i_sell_request);
        });
        static::updated(function (ISellRequest $i_sell_request) {
            Event::dispatch('i_sell_request.updated', $i_sell_request);
        });
        static::saved(function (ISellRequest $i_sell_request) {
            Event::dispatch('i_sell_request.saved', $i_sell_request);
        });
        static::deleted(function (ISellRequest $i_sell_request) {
            Event::dispatch('i_sell_request.deleted', $i_sell_request);
        });
        static::restored(function (ISellRequest $i_sell_request) {
            Event::dispatch('i_sell_request.restored', $i_sell_request);
        });
    }
}
