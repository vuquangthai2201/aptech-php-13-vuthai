<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;
use App\Jobs\NotifyYourOrder;
use App\Notifications\ConfirmOrder;
use Pusher\Pusher;

class OrderController extends Controller
{
    public function __construct(OrderRepository $orderRepository, OrderDetailRepository $orderDetailRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->latest();

        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderRepository->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    public function destroy(Request $request, $id)
    {
        $order = $this->orderRepository->findOrFail($id);
        try {
            $order->delete();
            $this->orderDetailRepository->delOrderDetail($order->id);
            $request->session()->flash('suc', trans('message.admin.del_order_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $order = $this->orderRepository->findOrFail($request->id);
        if ($order->status == config('custom.min')){
            $order->status = config('custom.two');
        } else {
            $order->status = config('custom.min');
        }
        $order->save();

        return view('admin.order.change_status', compact('order'));
    }

    public function confirm(Request $request, $id)
    {
        $order = $this->orderRepository->findOrFail($id);
        $order->status = config('custom.min');
        $order->save();
        $job = new NotifyYourOrder($order->customer->user->email, $order);
        dispatch($job)->delay(config('custom.min'));

        $getOrder = $this->orderRepository->getOrderUnconfirm();
        $countOrder = $this->orderRepository->countOrderUnconfirmCustomer($order->customer->id);
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $getData = [
            'count' => $countOrder,
            'id' => $order->customer->user->id,
        ];
        $pusher->trigger('notify-unconfirm', 'notify-admin', $getOrder);
        $pusher->trigger('notify-confirmed', 'notify-user', $getData);

        $request->session()->flash('suc', 'Order number '. $order->id .' was confirmed!!');

        return redirect()->route('dashboard.index');
    }
}
