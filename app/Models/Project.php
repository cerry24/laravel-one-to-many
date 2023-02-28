<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = array('title', 'slug', 'thumbnail', 'description', 'creation_date');

    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isThumbnailAUrl() {
        return filter_var($this->thumbnail, FILTER_VALIDATE_URL);
    }
}
