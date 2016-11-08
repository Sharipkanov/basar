@extends('admin.index')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">Профиль пользователя</h4>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Имя</label>
                                <input type="text" class="form-control" placeholder="Company" value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Фамилия</label>
                                <input type="text" class="form-control" value="{{Auth::user()->surname}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Адрес" value="{{Auth::user()->address}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" placeholder="Город" value="{{Auth::user()->city}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" placeholder="Страна" value="{{Auth::user()->country}}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">Обновить информацию</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
            </div>
            <div class="content">
                <div class="author">
                    <img class="avatar border-gray" src="{{Auth::user()->thumbnail}}" alt="..."/>
                    <a href="mailto:{{Auth::user()->email}}">
                        <h4 class="title">{{Auth::user()->name}} {{Auth::user()->surname}}<br />
                            <small>{{Auth::user()->email}}</small>
                        </h4>
                    </a>
                </div>
                <p class="description text-center">Должность</p>
            </div>
            <hr>
            <div class="text-center">
                <a href="https://www.facebook.com/" target="_blank" class="btn btn-simple"><i class="fa fa-facebook-square"></i></a>
                <a href="https://twitter.com/" target="_blank" class="btn btn-simple"><i class="fa fa-twitter"></i></a>
                <a href="https://plus.google.com/" target="_blank" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></a>
            </div>
        </div>
    </div>

</div>
@endsection
