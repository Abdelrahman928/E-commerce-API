<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingAddressResource extends JsonResource
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
            'user_id' => $this->user_id,
            'country' => $this->country,
            'city' => $this->city,
            'state' => $this->state,
            'street_name' => $this->street_address,
            'postal_code' => $this->postal_code,
            'address_line_2'  => $this->address_line_2
        ];
    }
}
