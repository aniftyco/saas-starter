<?php

namespace App\Listeners;

use App\Events\UserSignedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewSignInEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(UserSignedIn $event): void
    {
        //
    }
}
