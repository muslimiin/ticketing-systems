<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'province',
        'category',
        'description',
        'information',
        'image',
        'start_time',
        'end_time'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
