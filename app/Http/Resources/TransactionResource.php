<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_transaksi' => $this->id,
            'pembeli' => $this->user->name,
            'judul_acara' => $this->ticket->event->title,
            'jumlah_tiket' => $this->qty,
            'harga_tiket' => 'Rp' . number_format($this->ticket->price, 0, ',', '.'),
            'total_harga' => 'Rp' . number_format($this->total_price, 0, ',', '.'),
        ];
    }
}
