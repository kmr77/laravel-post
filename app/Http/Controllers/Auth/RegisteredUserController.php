<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'avatar' => ['image','max:1024'],
            'aplan' => ['string', 'max:2', 'nullable'],
            'bplan' => ['string', 'max:2', 'nullable'],
            'cplan' => ['string', 'max:2', 'nullable'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //userテーブルのデータ
        $attr = [
            'name' => $request->name,
            'email' => $request->email,
            'aplan' => $request->aplan,
            'bplan' => $request->bplan,
            'cplan' => $request->cplan,
            'password' => Hash::make($request->password),
        ];

        // avatarの保存
        if(request()->hasFile('avatar')) {
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His').'_'.$name;
            request()->file('avatar')->storeAs('public/avatar', $avatar);
            //avatarファイル名をデータに追加
            $attr['avatar']=$avatar;
        }
        $user=User::create($attr);

        event(new Registered($user));

        //各割付与
        $user->roles()->attach(2);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
