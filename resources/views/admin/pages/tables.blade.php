@extends('admin.index')

@section('content')
    <div ng-controller="users" ng-init="getTables()">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Таблицы</h4>
                        <p class="category">Доступные таблицы</p>
                    </div>
                    <div class="content">
                        <div class="table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="(key, table) in tables">
                                    <td><a href="/admin/profile/table/[[table]]">[[table]]</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="footer" ng-if="isEmpty(tables) === true">
                            <div class="stats">К сожелению у Вас нет таблиц для просмотра или редактирования</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
