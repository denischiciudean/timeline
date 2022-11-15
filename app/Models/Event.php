<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function updatesRelation()
    {
        return $this->hasMany(Update::class);
    }
}
