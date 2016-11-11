@extends('auth.index')

@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12">

            <div class="form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Sign up now</h3>
                        <p>Fill in the form below to get instant access:</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-pencil"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" method="POST" action="/admin/profile/activate" class="registration-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="activation_hash" value="{{$user->activation_hash}}">
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
                            <input type="email" name="email" placeholder="Email" class="form-email form-control" id="form-email" value="{{$user->email}}" required>
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
                            @if ($error)
                                <div>
                                <span class="help-block">
                                    <strong>{{ $error }}</strong>
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
