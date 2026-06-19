<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id_tiket' => $this->id,
            'judul_acara' => $this->event->title,
            'harga_tiket' => 'Rp' . number_format($this->price, 0, ',', '.'),
            'kuota_awal' => $this->quota,
            'kuota_tersisa' => $this->remaining_quota,
        ];
    }
}
