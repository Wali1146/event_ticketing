<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $fillable = [
        'title',
        'description',
        'category',
        'date',
        'time',
        'location',
    ];
}
