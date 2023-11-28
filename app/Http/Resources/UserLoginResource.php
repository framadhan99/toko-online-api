<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code'=> 200,
            'status'=> true,
            'data'=> [
                'token'=> $this->token,
                'user'=>[
                    'id'=> $this->id,
                    'email'=> $this->email,
                ]
            ]
        ];
    }
}
