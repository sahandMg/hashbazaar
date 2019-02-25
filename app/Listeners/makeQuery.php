<?php

namespace App\Listeners;

use App\Referral;
use App\Events\ReferralQuery;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class makeQuery
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Referral  $event
     * @return void
     */
    public function handle(ReferralQuery $event)
    {
        $user = $event->user;
        $ref = new Referral();
        $ref->code = $user->code;
        $ref->user_id = $user->id;
        $ref->save();
    }
}
