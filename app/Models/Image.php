<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Allow mass assignment for path (and optionally project_id)
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
