<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'id_acara' => $this->id,
            'judul_acara' => $this->title,
            'deskripsi' => $this->description,
            'kategory_acara' => $this->category,
            'tanggal' => date('d F Y', strtotime($this->date)),
            'jam' => date('H:i A', strtotime($this->time)),
            'lokasi' => $this->location,
        ];
    }
}
