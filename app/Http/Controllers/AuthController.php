<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Auth\SignUpRequest;
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
        if (checkFindCars()) {
            return redirect()->route('index');
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
            if (checkFindCars()) {
                return redirect()->route('index');
            }
            return redirect()->route("$role.welcome");
        } catch (Throwable $e) {
            return redirect()->route('signin')->with('failed', 'Tài khoản không đúng');
        }
    }

    public function processSignUp(SignUpRequest $request): RedirectResponse
    {
        try {
            $password = Hash::make($request->password);
            if (auth()->check()) {
                User::query()->where('id', auth()->user()->id)
                    ->update([
                        'name'     => $request->name,
                        'gender'   => $request->gender,
                        'phone'    => $request->phone,
                        'password' => $password,
                    ]);
            } else {
                $user = User::create([
                    'name'     => $request->name,
                    'gender'   => $request->gender,
                    'phone'    => $request->phone,
                    'email'    => $request->email,
                    'password' => $password,
                ]);
                Auth::login($user);
            }
            return redirect()->route("user.welcome");
        } catch (\Throwable $e) {
            return redirect()->back();
        }
    }

    public function signout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('signin');
    }
}
