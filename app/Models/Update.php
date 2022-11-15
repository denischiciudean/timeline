<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'remind_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
