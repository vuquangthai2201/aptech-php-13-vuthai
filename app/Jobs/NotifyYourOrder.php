<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\EmailYourOrderConfirmed;
use Illuminate\Support\Facades\Mail;

class NotifyYourOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $order)
    {
        $this->email = $email;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new EmailYourOrderConfirmed($this->order));
    }
}
