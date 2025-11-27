<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProjectController;


class Image extends Model
{
    public function project()
{
    return $this->belongsTo(Project::class);
}

}
