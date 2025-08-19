<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
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
            "UserAuth" => Auth::user()->email,
            // "created_at" => $this->created_at,
            // "updated_at" => $this->updated_at,
            "created_at" => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,//use carbon
            "updated_at" => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,

        ];
    }
}

           // "user" => $this->user->name,
            // دا اتشيك عشان لو مفيش صورة مبيعتهاش
            // "image" => $this->whenNotNull($this->image), // check the first if the post have pic or not if have send to api
            // بقول له لو الرول ادمن اعرض ليه الاستيتس
            // "status" => $this->when($this->role == "admin",$this->status),
            // "status" => $this->when($this->role == "author",$this->status),
            // "UserAuth" => Auth::user()->email,// دي ليا بس عشان اتاكد ان الايميل
