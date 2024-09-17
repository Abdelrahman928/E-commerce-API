<?php

namespace App\Http\Resources\api\v1;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductShowResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'price_after_discount' => $this->price - ($this->price * $this->discount / 100),
            'stock_status' => $this->stock_status,
            'sub_category' => $this->whenLoaded('productable', function () {
                if ($this->productable_type === SubCategory::class) {
                    return new SubCategoryResource($this->productable);
                }
                return null;
            }),
            'category' => $this->whenLoaded('productable', function () {
                if ($this->productable_type === Category::class) {
                    return new CategoryResource($this->productable);
                }
                return null;
            }),
            'photos' => ProductPhotoResource::collection($this->whenLoaded('photos')),
        ];
    }
}
