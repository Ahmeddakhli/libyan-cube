<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    use SoftDeletes,
        SoftCascadeTrait;
}
