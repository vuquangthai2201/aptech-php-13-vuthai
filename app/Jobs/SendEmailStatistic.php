<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailStatistic;
use Carbon\Carbon;

class SendEmailStatistic implements ShouldQueue
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
        $data['countOrder'] = $orderRepository->countAllOrderMonth();
        $data['countUnconfirm'] = $orderRepository->countUnconfirmOrderMonth();
        $data['countDelivering'] = $orderRepository->countDeliveringOrderMonth();
        $data['getRevenue'] = $orderRepository->getRevenueOrderMonth();
        $data['month'] = Carbon::now()->format('m-Y');
        Mail::to(config('custom.mail_admin_receive'))->send(new EmailStatistic($data));
    }
}
