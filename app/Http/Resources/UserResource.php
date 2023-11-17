<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'status' => true,
            'message' => 'success',
            'data' => [
                'id'=> $this->id,
                'name'=> $this->name,
                'email'=> $this->email,
                'token'=> $this->whenNotNull($this->token),
            ],
        ];
    }
}