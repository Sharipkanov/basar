@extends('admin.index')

@section('content')
    <div class="row" ng-controller="users" ng-init="getUserInfo('{{$user["email"]}}')">
        <div class="col-md-9">
            <div class="card">
                <div class="header">
                    <h4 class="title">Профиль пользователя</h4>
                </div>
                <div class="content">
                    <form ng-submit="updateUserInfo()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Статус</label>
                                    <select ng-model="userInfo.is_active" class="form-control">
                                        <option ng-value="1" ng-selected="userInfo.is_active === 1">Активный</option>
                                        <option ng-value="0" ng-selected="userInfo.is_active === 0">Неактивный</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Имя</label>
                                    <input type="text" class="form-control" placeholder="Company" ng-model="userInfo.name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Фамилия</label>
                                    <input type="text" class="form-control" ng-model="userInfo.surname">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" ng-model="userInfo.email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Адрес" ng-model="userInfo.address">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" placeholder="Город" ng-model="userInfo.city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" placeholder="Страна" ng-model="userInfo.country">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">Привилегии</h4>
                                <br>

                            </div>
                        </div>

                        <div class="row checkbox-group permissions" ng-repeat="table in userInfo.permissions track by $index">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>[[table.name]]</label>
                                    <input type="checkbox" ng-model="table.checked" {{--ng-click="checkChilds(table)"--}}>
                                    <div class="clearfix">
                                        <div class="col-md-6" style="padding: 4px;">
                                            <div class="clearfix rows-ckeckbox">
                                                <small>Ключ таблицы</small>
                                                <input type="text" ng-model="table.primary" required class="form-control pull-right" style="width: 60%">
                                            </div>
                                        </div>
                                        <div class="col-md-6" ng-repeat="row in table.rows" style="padding: 4px;">
                                            <div class="clearfix rows-ckeckbox">
                                                <small class="pull-left">[[row.name]]</small>
                                                <select ng-model="row.checked" id="" class="form-control pull-right" style="width: 60%">
                                                    <option ng-value="0" ng-selected="row.checked === 0">Не доступен</option>
                                                    <option ng-value="1" ng-selected="row.checked === 1">Чтение</option>
                                                    <option ng-value="2" ng-selected="row.checked === 2">Редактирование</option>
                                                </select>
                                                {{--<input class="pull-right" type="checkbox" ng-model="row.checked" ng-click="checkParent(table)" ng-true-value="true" ng-true-value="false">--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-info btn-fill pull-right">Обновить информацию</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-user">
                <div class="image">
                    <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                </div>
                <div class="content">
                    <div class="author">
                        <div class="avatar border-gray" style="background-image: url({{Auth::user()->thumbnail}});"></div>
                        <a href="mailto:[[userInfo.email]]">
                            <h4 class="title">[[userInfo.name]] [[userInfo.surname]]<br />
                                <small>[[userInfo.email]]</small>
                            </h4>
                        </a>
                    </div>
                    {{--<p class="description text-center">Должность</p>--}}
                </div>{{--
                <hr>
                <div class="text-center">
                    <a href="https://www.facebook.com/" target="_blank" class="btn btn-simple"><i class="fa fa-facebook-square"></i></a>
                    <a href="https://twitter.com/" target="_blank" class="btn btn-simple"><i class="fa fa-twitter"></i></a>
                    <a href="https://plus.google.com/" target="_blank" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></a>
                </div>--}}
            </div>
        </div>

    </div>
@endsection
