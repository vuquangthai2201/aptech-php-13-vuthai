<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SocialAuthController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user);

        if (!$authUser) {
            Session::flash('err', trans('message.email_registered'));
            return redirect()->route('login');
        }

        Auth::login($authUser, true);

        return redirect()->route('index');
    }

    private function findOrCreateUser($socialUser){
        $checkUser = $this->userRepository->checkUserExist($socialUser->email);
        if ($checkUser) {
            return false;
        }

        $authUser = $this->userRepository->getUserExist($socialUser->id);
        if ($authUser) {
            return $authUser;
        }
        $data = [
            'name' => $socialUser->name,
            'password' => $socialUser->token,
            'email' => $socialUser->email,
            'provide_id' => $socialUser->id,
            'provide' => $socialUser->id,
            'role' => 'customer',
            'active' => config('custom.min'),
        ];
        return $this->userRepository->create($data);
    }
}
