<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailStatistic;

class StatisticMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistic:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send statistic monthly for admin';

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
        $job = new SendEmailStatistic();
        dispatch($job);

        $this->info('Send email statistic monthly successful');
    }
}
