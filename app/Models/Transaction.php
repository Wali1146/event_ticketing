<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Override;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'ticket_id',
        'qty',
        'total_price',
    ];

    #[Override]
    protected static function booted()
    {
        static::creating(function ($transaction) {
            if (Auth::check()) {
                $transaction->user_id = Auth::id();
            }
            $ticket = Ticket::query()->where('id', $transaction->ticket_id)->first();
            if ($ticket) {
                $transaction->total_price = $transaction->qty * $ticket->price;
            }
        });
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
