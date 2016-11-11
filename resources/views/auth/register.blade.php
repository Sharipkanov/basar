@extends('auth.index')

@section('content')
<div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12">

        <div class="form-box">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Регистрация</h3>
                    <p>Заполните поля ниже для регистрации</p>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-pencil"></i>
                </div>
            </div>
            <div class="form-bottom">
                <form role="form" method="POST" action="{{ url('/register') }}" class="registration-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="sr-only" for="form-first-name">Имя</label>
                        <input type="text" name="name" placeholder="Имя" class="form-first-name form-control" id="form-first-name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div>
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-last-name">Фамилия</label>
                        <input type="text" name="surname" placeholder="Фамилия" class="form-last-name form-control" id="form-last-name">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-email">Email</label>
                        <input type="email" name="email" placeholder="Email" class="form-email form-control" id="form-email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <div>
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-password">Пароль</label>
                        <input type="password" name="password" placeholder="Пароль" class="form-password form-control" id="form-password" required>
                        @if ($errors->has('password'))
                            <div>
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="form-password">Повторите пароль</label>
                        <input type="password" name="password_confirmation" placeholder="Повторите пароль" class="form-password form-control" id="form-password" required>
                    </div>
                    <button type="submit" class="btn">Sign me up!</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
