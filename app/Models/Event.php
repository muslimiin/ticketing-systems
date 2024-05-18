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

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->created_by = auth()->user()->id;
    //     });

    //     static::updating(function ($model) {
    //         $model->updated_by = auth()->user()->id;
    //     });
    // }

}
