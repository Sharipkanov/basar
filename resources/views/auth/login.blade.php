@extends('auth.index')

@section('content')
<div class="row">
    <div class="col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12">

        <div class="form-box">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Авторизация</h3>
                    <p>Введите данные для входа в систему</p>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <div class="form-bottom">
                <form role="form" method="POST" action="{{ url('/login') }}" class="login-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="sr-only" for="form-email">Email</label>
                        <input type="email" name="email" placeholder="Email" class="form-username form-control" id="form-email" value="{{ old('email') }}" required>
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
                    <button type="submit" class="btn">Вход</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
