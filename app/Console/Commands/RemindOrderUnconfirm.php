<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendReminderEmail;

class RemindOrderUnconfirm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail remind the number of order unconfirm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $job = new SendReminderEmail();
        dispatch($job);

        $this->info('Send email remind successfully');
    }
}
