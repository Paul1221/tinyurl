<?php

namespace App\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource{
    public function toArray($resuest){
        return [
            'id' => $this->id,
            'url' => $this->url,
            'hash' => $this->hash
        ];
    }
}