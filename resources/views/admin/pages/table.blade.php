@extends('admin.index')

@section('content')
    <div ng-controller="users" ng-init="getTable('{{$tableName}}', '{{$tableInfo->resolveCurrentPage()}}')">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Striped Table with Hover</h4>
                        <p class="category">Here is a subtitle for this table</p>
                    </div>
                    <hr>
                    <div class="table-form disablecopy">
                        <div class="table-form-body">
                            <div class="table-form-row">
                                @foreach($tableRows as $row)
                                    <div class="table-form-cell">{{$row}}</div>
                                @endforeach
                            </div>
                        </div>
                        [[tablePrimaryKey]]
                        <div class="table-form-body" ng-repeat="(key, val) in tableRowsInfo">
                            <div class="table-form-row">
                                <div class="table-form-cell" ng-repeat="(key2, val2) in val">[[val2]]</div>
                                <div class="table-form-cell">
                                    <button class="btn btn-primary btn-small" type="button" ng-click="dropdownEvent('#dropdown-' + key, $event)">
                                        <i class="pe-7s-pen"></i>
                                    </button>
                                </div>
                            </div>
                            <form class="table-form-row dropdown-collapse" id="dropdown-[[key]]" ng-submit="updateTableInfo('{{$tableName}}', '{{$tablePrimaryKey}}', key)">
                                <div class="table-form-cell" ng-repeat="(key2, val2) in val track by $index">
                                    <p ng-if="checkTypes[$index] === 1">[[val2]]</p>
                                    <textarea ng-if="checkTypes[$index] === 2" ng-model="tableRowsInfo[key][key2]" class="form-control not-resizble">[[val2]]</textarea>
                                </div>
                                <div class="table-form-cell">
                                    <button class="btn btn-success btn-small" type="submit" ng-click="updateRowInfo()">
                                        <i class="pe-7s-diskette"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-md-12">
                            {{ $tableInfo->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
