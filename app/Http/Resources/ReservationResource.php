<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'reservation_date'=>$this->reservation_date,
            'method'=> ($this->is_walkin==TRUE?'Walkin':'Online'),
            'customer'=>$this->customer_name,
            'user'=>['id'=>$this->user->id,'name'=>$this->user->name],
            'dining_table'=>
                            ['id'=>$this->dining_table_id,
                            'table_number'=>$this->diningtable->table_number
                            ]
        ];
    }
}
