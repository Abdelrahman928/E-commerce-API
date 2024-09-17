<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
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
            'name' => $this->name,
            'manufacturer' => $this->manufacturer,
            'price' => $this->price,
            'discount' => $this->discount,
            'price_after_discount' => $this->price - ($this->price * ($this->discount / 100)),
            'stock_status' => $this->stock_status,
            'photo' => $this->photos->first() ? $this->photos->first()->photo_path : null
        ];
    }
}
