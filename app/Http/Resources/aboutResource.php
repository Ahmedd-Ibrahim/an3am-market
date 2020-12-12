<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class aboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return  [
           'about_ar' =>$this->about_ar,
           'about_en' =>$this->about_en
       ];
    }
}
