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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar?->url ?? 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=000&background=00ffcc',
            'isStaff' => $this->role->is(UserRole::Staff),
            'isConfirmed' => $this->confirmed_at !== null,
        ];
    }
}
