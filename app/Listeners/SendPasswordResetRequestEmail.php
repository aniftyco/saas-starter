<?php

namespace App\Listeners;

use App\Events\ResetPasswordRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordResetRequestEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ResetPasswordRequest $event): void
    {
        info('Password reset request sent to ' . $event->email);
        info('Reset URL: ' . $event->url);
    }
}
