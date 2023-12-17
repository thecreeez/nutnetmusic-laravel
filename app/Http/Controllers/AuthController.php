<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request) {
        switch ($request->typeAuth) {
            case 'login': return AuthController::login($request);
            case 'register': return AuthController::register($request);

            default: return redirect(route('index'));
        }
    }

    public function register(Request $request) {
        if (!$request->name)
            return redirect(route('auth'))->withErrors(['error' => 'Имя не введено']);

        if (!$request->password)
            return redirect(route('auth'))->withErrors(['error' => 'Пароль не введен']);

        $users = new User();

        if (!User::where('name', $request->name)->exists()) {
            $user = new User();

            $user->name = $request->name;
            $user->password = $request->password;

            $user->save();
            Auth::login($user);

            return redirect(route('index'))->withErrors(['success' => 'Вы успешно зарегистрировали аккаунт с именем '.$request->name]);
        }

        return redirect(route('auth'))->withErrors(['error' => 'Пользователь с таким именем уже существует']);
    }

    public function login(Request $request) {
        $formFields = $request->only(['name', 'password']);

        if (!$request->name)
            return redirect(route('auth'))->withErrors(['error' => 'Имя не введено']);

        if (!$request->password)
            return redirect(route('auth'))->withErrors(['error' => 'Пароль не введен']);

        if (Auth::attempt($formFields)) {
            return redirect(route('index'))->withErrors(['success' => 'Вы успешно вошли в аккаунт под именем '.$request->name]);
        }

        return redirect(route('auth'))->withErrors(['error' => 'Неверное имя или пароль']);
    }

    public function logout(Request $request) {
        if (Auth::check())
            Auth::logout();

        return redirect(route('index'));
    }
}
