<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $sub = Product::find($this->product_id);
        return [
            'product' => new SubBasketResource($sub),
            'counter'  => $this->counter
        ];

    }
}
