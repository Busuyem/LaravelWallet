<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_id' =>$this->user_id,
            'type' => $this->type,
            'name' => $this->name,
            'monthly_interest'=> $this->monthly_interest,
            'minimum_balance' => $this->minimum_balance,
            'balance' => $this->balance
        ];
    }
}
