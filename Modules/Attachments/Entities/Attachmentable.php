<?php

namespace Modules\Attachments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class Attachmentable extends Model
{   
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'attachmentables';
    protected $fillable = ['attachmentable_id','attachmentable_type', 'mime', 'path', 'size', 'file_name', 'order', 'type','alt'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }
}
