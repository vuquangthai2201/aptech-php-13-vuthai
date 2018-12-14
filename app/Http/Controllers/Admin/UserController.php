<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Exception;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate(config('custom.ten'));

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $data = [
            'email' => trim($request->email),
            'password' => bcrypt($request->password),
            'name' => trim($request->name),
            'role' => config('custom.admin'),
            'active' => config('custom.zero'),
        ];
        try {
            $result = $this->userRepository->create($data);
            $request->session()->flash('suc', trans('message.admin.add_user_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', trans('message.admin.add_user_err'));
        }

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepository->findOrFail($id);
        try {
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
            $request->session()->flash('suc', trans('message.edit_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->route('user.edit', [$user->id]);
    }

    public function destroy(Request $request, $id)
    {
        $user = $this->userRepository->findOrFail($id);
        try {
            $user->delete();
            $request->session()->flash('suc', trans('message.delete_suc'));
        } catch (Exception $e) {
            $request->session()->flash('err', $e->getMessage());
        }

        return redirect()->back();
    }

    public function changeActive(Request $request)
    {
        $user = $this->userRepository->findOrFail($request->id);
        if ($user->active == config('custom.zero')){
            $user->active = config('custom.min');
        } else {
            $user->active = config('custom.zero');
        }
        $user->save();

        return view('admin.user.change_active', compact('user'));
    }
}
