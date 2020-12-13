<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubBasketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'desc' => $this->desc,
            'age' => $this->age,
            'sale_price' => $this->sale_price,
            'regular_price' => $this->regular_price,
            'image' => $this->image,
        ];
    }
}
