<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
            return [
            "id" => $this->id,
            "name" => $this->name,
            "note" => $this->note,
            "degree" => $this->degree,
            // "created_at" => $this->created_at,
            // "updated_at" => $this->updated_at,
            "created_at" => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,//use carbon
            "updated_at" => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,

        ];

    }
}
