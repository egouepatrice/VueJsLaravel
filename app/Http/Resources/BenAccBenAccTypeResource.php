<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BenAccBenAccTypeResource extends JsonResource
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
            'reference' => $this->reference,
            'denomination' => $this->denomination,
            'description' => $this->description,
            'main_color' => $this->main_color,
            'card_picture' => $this->card_picture
        ];
    }
}
