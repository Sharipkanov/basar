@extends('admin.index')

@section('content')
<div ng-controller="users">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Striped Table with Hover</h4>
                    <p class="category">Here is a subtitle for this table</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="(key, value) in users">
                            <td>[[value.id]]</td>
                            <td>[[value.name]] [[$user.surname]]</td>
                            <td>[[value.email]]</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Добавить пользователя</h4>
                </div>
                <div class="content">
                    <form ng-submit="addNewUser()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email" ng-model="newUserEmail" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Добавить</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
