<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Repositories\OrderRepository;
use App\Mail\EmailRemind;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orderRepository = new OrderRepository;
        $orders = $orderRepository->getOrderUnconfirm();

        if (count($orders) > config('custom.zero'))
        {
            Mail::to(config('custom.mail_admin_receive'))->send(new EmailRemind($orders));
        }
    }
}
