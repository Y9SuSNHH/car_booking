<?php

namespace App\Http\Controllers;

use App\Enums\CarStatusEnum;
use App\Enums\UserRoleEnum;
use App\Http\Requests\Auth\ProcessSignUpRequest;
use App\Models\Bill;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Throwable;
use Exception;

class AuthController extends Controller
{
    public function signin(): Factory|View|Application
    {
        return view('auth.signin');
    }

    public function signup(): Factory|View|Application
    {
        return view('auth.signup');
    }

    public function callback($provider): RedirectResponse
    {
        $data       = Socialite::driver($provider)->user();
        $user       = User::query()
            ->where('email', $data->getEmail())
            ->first();
        $checkExist = true;
        if (is_null($user)) {
            $user        = new User();
            $user->email = $data->getEmail();
            $user->role  = UserRoleEnum::USER;
            $checkExist  = false;
        }
        $user->name = $data->getName();
        $user->save();

        Auth::login($user, true);

        if ($checkExist) {
            $role = strtolower(UserRoleEnum::getKey($user->role));
            return redirect()->route("$role.welcome");
        }
        return redirect()->route('welcome');
    }

    public function processSignIn(Request $request): RedirectResponse
    {
        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->firstOrFail();
            if (!Hash::check($request->get('password'), $user->password)) {
                return redirect()->route('signin')->with('failed', 'Sai mật khẩu');
            }
            Auth::login($user);
            $role = strtolower(UserRoleEnum::getKey($user->role));
            return redirect()->route("$role.welcome");
        } catch (Throwable $e) {
            return redirect()->route('signin')->with('failed', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function processSignUp(Request $request): RedirectResponse
    {
        $password = Hash::make($request->password);
        if (auth()->check()) {
            User::where('id', auth()->user()->id)
                ->update([
                    'name'     => $request->name,
                    'gender'   => $request->gender,
                    'phone'    => $request->phone,
                    'address'  => $request->address,
                    'address2' => $request->address2,
                    'password' => $password,
                ]);
        } else {
            $user = User::create([
                'name'     => $request->name,
                'gender'   => $request->gender,
                'phone'    => $request->phone,
                'address'  => $request->address,
                'address2' => $request->address2,
                'email'    => $request->email,
                'password' => $password,
            ]);
            Auth::login($user);
        }
        return redirect()->route("user.welcome");
    }

    public function signout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('signin');
    }
}
