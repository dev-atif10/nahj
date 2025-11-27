<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{ 


protected $fillable = [
    'title',
    'description',
    'status',
    'priority',
    'owner_id',
    'start_date',
    'end_date',
    'updated_by',
    'budget',
    'images',
];

public function images()
{
    return $this->hasMany(Image::class);
}

public function getStartDateAttribute($value)
{
    return \Carbon\Carbon::parse($value)->format('Y-m-d');
}

public function getEndDateAttribute($value)
{
    return \Carbon\Carbon::parse($value)->format('Y-m-d');
}

}
