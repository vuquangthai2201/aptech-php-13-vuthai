<?php

namespace App\Http\Controllers\Watch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;

class ProfileController extends Controller
{
    public function __construct(UserRepository $userRepository, CustomerRepository $customerRepository)
    {
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $user = $this->userRepository->findOrFail(Auth::user()->id);

        return view('watch.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $customer = $this->customerRepository->firstCustomer();
        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password != null) {
            $data_user['password'] = bcrypt($request->password);
        }
        $user->update($data_user);
        $user->save();

        try {
            if ($customer != null){
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $path = 'images/users/'.$user->customers->avatar;

                if ($request->avatar != null){
                    if ($user->customers->avatar != null) {
                        Storage::delete($path);
                    }
                    $image = $request->file('avatar')->store('images/users');
                    $tmp = explode('/', $image);
                    $avatar = end($tmp);
                    $customer->avatar = $avatar;
                }
                $customer->save();
            }
            $request->session()->flash('suc', trans('message.update_success'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('profile.index');
    }

    public function yourOrder()
    {
        $customer = $this->userRepository->findOrFail(Auth::user()->id);
        if (!$customer->customers){
            return redirect()->route('index');
        }

        $orders = $customer->customers->orders;

        return view('watch.order', compact('orders'));
    }
}
