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
use App\Http\Resources\MediaResource;
use App\Media;
use Cache;
use Wildside\Userstamps\Userstamps;
use App\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;

class IPhase extends Model implements HasMedia
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

    protected $table = 'i_phases';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'delivery_date', 'project_id', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'value', 'description'
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
    protected static $logName = 'phase_log';

    public function getDescriptionForEvent(string $eventName): string
    {
        return $this->translations->first() ? "Phase ".$this->translations->first()->name." has been {$eventName}" : "Phase #".$this->id." has been created";
    }

    public function getValueAttribute()
    {
        $i_phase = $this;
        return Cache::rememberForever('i_phase_'.$this->id.'_phase_'.App::getLocale(), function() use ($i_phase) {
            $i_phase = $i_phase->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_phase ? $i_phase->name : null;
        });
    }

    public function getDescriptionAttribute()
    {
        $i_phase = $this;
        return Cache::rememberForever('i_phase_'.$this->id.'_description_'.App::getLocale(), function() use ($i_phase) {
            $i_phase = $i_phase->translations->where('language_id', Language::where('code', App::getLocale())->select('id')->first()->id)->first();
            return $i_phase ? $i_phase->description : null;
        });
    }

    public function translations()
    {
        return $this->hasMany('Modules\Inventory\IPhaseTranslation', 'i_phase_id', 'id');
    }

    public function attachments()
    {
        
        return $this->morphMany(Media::class,'model');

    }
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection(request()->getHttpHost().',inventory,phases,'.$this->id.','.'attachments')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, array(
                    'xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xls', 'application/vnd.ms-excel', // Excel
                    'pdf', 'application/pdf', 'csv', 'text/csv', 'txt', 'text/plain', // Other Files
                    'tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png', // Images
                    'ai', 'application/postscript', 'psd', 'image/vnd.adobe.photoshop', // Images
                    'mp4', 'video/mp4', 'm4v', 'video/x-m4v', 'f4v', 'video/x-f4v', // MP4
                    '3gp', 'video/3gpp', '3g2', 'video/3gpp2', // 3GP
                    'oga', 'audio/ogg', 'ogv', 'video/ogg', 'ogx', 'application/ogg', // OGG
                    'wmv', 'video/x-ms-wmv', 'wma', 'audio/x-ms-wma', 'asf', 'video/x-ms-asf', // WMV
                    'webm', 'video/webm', 'flv', 'video/x-flv', 'avi', 'video/x-msvideo', 'wmx', 'video/x-ms-wmx', 'wvx', 'video/x-ms-wvx', 'mkv', 'video/x-matroska', 'mpeg', 'video/mpeg', // Other video formats
                    'wav', 'audio/x-wav', 'aif', 'audio/x-aiff', 'flac', 'audio/x-flac', 'acc', 'application/vnd.americandynamics.acc', 'audio/mpeg', 'mpga', // Audio
                    'doc', 'application/msword', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', // Microsoft Office
                ));
            })->useDisk('public');
            
    }

    public function attachmentables()
    {
        return $this->morphMany('Modules\Attachments\Entities\Attachmentable', 'attachmentable');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (IPhase $i_phase) {
            Event::dispatch('i_phase.created', $i_phase);
        });
        static::updated(function (IPhase $i_phase) {
            Event::dispatch('i_phase.updated', $i_phase);
        });
        static::saved(function (IPhase $i_phase) {
            Event::dispatch('i_phase.saved', $i_phase);
        });
        static::deleted(function (IPhase $i_phase) {
            Event::dispatch('i_phase.deleted', $i_phase);
        });
        static::restored(function (IPhase $i_phase) {
            Event::dispatch('i_phase.restored', $i_phase);
        });
    }
}
