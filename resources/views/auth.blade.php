@extends('parts.app')

@section('title')Авторизация@endsection

@section('content')
    <form action="{{ route('api-auth') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="inputLogin" class="form-label">Логин</label>
            <input type="text" class="form-control" id="inputLogin" name="name">
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="inputPassword" name="password">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="typeAuth" id="inputRegister" value="register">
            <label class="form-check-label" for="inputRegister">
                Регистрация
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="typeAuth" id="inputAuth" checked value="login">
            <label class="form-check-label" for="inputAuth">
                Авторизация
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
