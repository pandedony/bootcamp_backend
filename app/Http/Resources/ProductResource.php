<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'stock' => $this->stock,
            'price' => $this->price,
            'featured' => $this->featured,
            'shipping' => $this->shipping,
            'colors' => json_decode($this->colors),
            'category' => $this->category,
            'images' => json_decode($this->images), // Assuming you have an ImageResource for formatting images
            'image' => $this->image,
            'reviews' => $this->reviews,
            'stars' => $this->stars,
            'name' => $this->name,
            'description' => $this->description,
            'company' => $this->company,
        ];
    }
}
