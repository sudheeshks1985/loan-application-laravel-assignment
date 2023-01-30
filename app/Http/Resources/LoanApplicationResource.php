<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanApplicationResource extends JsonResource
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
            'id' => $this->id,
            'loan_application_number' => $this->loan_application_number,
            'loan_amount' => $this->loan_amount,
            //'created_at' => (string) $this->created_at,
            //'updated_at' => (string) $this->updated_at,
          ];
    }
}
