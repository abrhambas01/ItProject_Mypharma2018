<?php

namespace App\Listeners;

use App\Events\MemberIsAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User ; 

class MemberIsAddedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  MemberIsAdded  $event
     * @return void
     */
    public function handle(MemberIsAdded $event)
    {
        //
    }
}
