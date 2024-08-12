<?php

namespace NiftyCo\Support\Session;

use Carbon\Carbon;

/**
 * @TODO:
 * 1. Change column `last_activity` => :timestamp to `last_active_at` => :datetime
 * 2. Update all underlining `last_activity` usage to account for new column and format
 * 3. Create `Session` model that has a virtual columns of `browser` and `location` that
 *    return mobiledetect parsing on `browser` and geoip data on `location`
 * 4. Update `User` model to add a `sessions` relationship that returns all sessions
 */
class DatabaseSessionHandler extends \Illuminate\Session\DatabaseSessionHandler
{
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
            'last_active_at' => now(),
        ];

        if (!$this->container) {
            return $payload;
        }

        return tap($payload, function (&$payload) {
            $this->addUserInformation($payload)
                ->addRequestInformation($payload);
        });
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
