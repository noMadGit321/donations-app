<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNewDonation implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $newEntry;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($donationInstance)
    {
        $this->newEntry = $donationInstance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->newEntry->image_url = 'https://www.gravatar.com/avatar/' . md5(strtolower($this->newEntry->email)) . '.jpg?s=200&d=mm';

        $this->newEntry->save();
    }
}
