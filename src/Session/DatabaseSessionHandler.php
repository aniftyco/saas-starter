<?php

namespace NiftyCo\Support\Session;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;

class DatabaseSessionHandler extends \Illuminate\Session\DatabaseSessionHandler
{
    private ?object $session = null;

    public function read($sessionId): string|false
    {
        if (!is_null($this->session = $this->getQuery()->find($sessionId))) {
            $this->session = (object) $this->session;
        }

        info('session read: ' . json_encode($this->session));

        if ($this->expired($this->session)) {
            $this->exists = true;

            return '';
        }

        if (isset($this->session->payload)) {
            $this->exists = true;

            return base64_decode($this->session->payload);
        }

        return '';
    }

    protected function expired($session): bool
    {
        if (isset($session->last_active_at)) {
            return Carbon::parse($session->last_active_at)->lessThan(now()->subMinutes($this->minutes));
        }

        return false;
    }

    protected function getDefaultPayload($data): array
    {
        $payload = [
            'payload' => base64_encode($data),
            'last_active_at' => now()->toDateTimeString(),
        ];

        if (!$this->container) {
            return $payload;
        }

        return tap($payload, function (&$payload) {
            $this->addUserInformation($payload)
                ->addRequestInformation($payload)
                ->addLocationInformation($payload);
        });
    }

    protected function addLocationInformation(&$payload): static
    {
        if ($this->container->bound(Guard::class) && !is_null($payload['user_id'])) {
            $payload = array_merge($payload, [
                'location' => $this->session->location ?? $this->container->make(Geo::class)->lookup($this->ipAddress(), json: true),
            ]);
        }

        return $this;
    }

    protected function performInsert($sessionId, $payload): bool|null
    {
        return parent::performInsert($sessionId, [
            ...$payload,
            'created_at' => now(),
        ]);
    }

    public function gc($lifetime): int
    {
        return $this->getQuery()
            ->where('last_active_at', '<=', now()->subMinutes($lifetime))
            ->delete();
    }
}
