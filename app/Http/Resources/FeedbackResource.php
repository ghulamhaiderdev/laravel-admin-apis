<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->categories->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_name' => $this->users->name
        ];
    }
}
