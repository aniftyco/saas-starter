<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'ipAddress' => $this->ip_address,
            'platform' => $this->platform,
            'location' => $this->location,
            'browser' => $this->browser,
            'isDesktop' => $this->is_desktop,
            'lastActiveAt' => $this->last_active_at->diffForHumans(),
            'isCurrentDevice' => $this->when($request->session()->getId() === $this->id, true),
        ];
    }
}
