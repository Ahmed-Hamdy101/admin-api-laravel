<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'first_name'=>$this->f_name,
            'last_name'=>$this->l_name,
            'email'=>$this->email,
            'order_item'=>OrderItemResource::collection($this->order_items),
        ];
    }
}

