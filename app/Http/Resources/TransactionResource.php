<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'wallet_id' => $this->wallet_id,
            'receiver_id'=> $this->receiver_id,
            'type' => $this->type,
            'amount' => $this->amount,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'created_at' =>  Carbon::parse($this->created_at)->tz('Africa/Lagos')->format('d M, Y, i:s A')
        ];
    }
}
