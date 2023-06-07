<?php

namespace App\Listeners;

use App\Events\ErrorHistory;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class storeUserErrorHistory
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
     * @param  \App\Events\ErrorHistory  $event
     * @return void
     */
    public function handle(ErrorHistory $event)
    {
        //

        $current_timestamp = Carbon::now()->toDateTimeString();

        $Data = $event->details;

        $saveHistory = DB::table('error_history')->insert(
            ['table' => $Data['table'], 'error' => $Data['error'], 'created_at' => $current_timestamp, 'updated_at' => $current_timestamp]
        );
        return $saveHistory;
    }
}
