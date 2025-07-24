<?php

namespace App\Http\Resources;

use App\Enums\UserRole;
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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'avatar' => $this->resource->avatar?->url ?? 'https://ui-avatars.com/api/?name='.urlencode($this->resource->name).'&color=000&background=00ffcc',
            'isStaff' => $this->resource->role->is(UserRole::Staff),
            'isConfirmed' => $this->resource->confirmed_at !== null,
        ];
    }
}
