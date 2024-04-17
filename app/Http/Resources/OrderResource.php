<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'address' => $this->address,
            'postalCode' => $this->postalCode,
            'payment' => $this->payment,
            'country' => $this->country,
            'orderItems' => $this->items->map(function ($item) {
                return [
                    'product' => $item->product,
                    'quantity' => $item->quantity,
                    'color' => $item->color,
                ];
            }),
        ];
    }
}
