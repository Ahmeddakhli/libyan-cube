<?php

namespace Modules\Settings;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Event;

class Setting extends Model
{
    use SoftDeletes, SoftCascadeTrait, LogsActivity, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'settings';
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
        'id', 'tags_manager',
        'pixel_code',
        'enable_ar',
        'aside_title_en',
        'aside_title_ar',
        'body_tag_manager',
        'thank_you_message_en',
        'thank_you_message_ar',
        'auto_reply_message_en',
        'auto_reply_message_ar',
        'active_whatsapp_icon',
        'active_messanger_icon',
        'active_phone_icon',
        'about_en',
        'about_ar',
        'slogan_en',
        'slogan_ar',
        'created_at', 'updated_at'
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
    protected static $logName = 'setting_log';

    /*
     * Types <careers,setting_us,phone,email>
     */

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Setting " . $this->type . " of ID #" . $this->id . " has been {$eventName}";
    }

    public function setEnableArAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['enable_ar'] = 1;
        } elseif ($value == "off") {
            $this->attributes['enable_ar'] = 0;
        }
    }

    public function setActiveWhatsappIconAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['active_whatsapp_icon'] = 1;
        } elseif ($value == "off") {
            $this->attributes['active_whatsapp_icon'] = 0;
        }
    }
    public function setActiveMessangerIconAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['active_messanger_icon'] = 1;
        } elseif ($value == "off") {
            $this->attributes['active_messanger_icon'] = 0;
        }
    }
    public function setActivePhoneIconAttribute($value)
    {
        if ($value === "on") {
            $this->attributes['active_phone_icon'] = 1;
        } elseif ($value == "off") {
            $this->attributes['active_phone_icon'] = 0;
        }
    }
}
