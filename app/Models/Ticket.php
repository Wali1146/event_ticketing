<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'event_id',
        'price',
        'quota',
        'remaining_quota',
    ];
}
