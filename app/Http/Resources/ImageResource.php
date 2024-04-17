<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'width' => $this->width,
            'height' => $this->height,
            'url' => $this->url,
            'filename' => $this->filename,
            'size' => $this->size,
            'type' => $this->type,
            'thumbnails' => [
                'small' => [
                    'url' => $this->thumbnails['small']['url'],
                    'width' => $this->thumbnails['small']['width'],
                    'height' => $this->thumbnails['small']['height'],
                ],
                'large' => [
                    'url' => $this->thumbnails['large']['url'],
                    'width' => $this->thumbnails['large']['width'],
                    'height' => $this->thumbnails['large']['height'],
                ],
                'full' => [
                    'url' => $this->thumbnails['full']['url'],
                    'width' => $this->thumbnails['full']['width'],
                    'height' => $this->thumbnails['full']['height'],
                ],
            ],
        ];
    }
}
