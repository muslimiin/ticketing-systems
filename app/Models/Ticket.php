<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quota',
        'description',
        'max_purchase'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
