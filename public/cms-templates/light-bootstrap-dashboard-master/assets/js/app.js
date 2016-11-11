// Конфигурация токена перед отправкой AJAX запросов
XMLHttpRequest.prototype.realSend = XMLHttpRequest.prototype.send;

var newSend = function(vData) {
    this.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    this.realSend(vData);
};

XMLHttpRequest.prototype.send = newSend;

// Модуль приложения
var app = angular.module('basarApp', []);

// Замена стандартных ковычек angular
app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

// Контроллер добавление нового пользователя
app.controller('users', function ($scope, $http) {
    $scope.newUserEmail = '';
    $scope.users = {};
    $scope.userInfo = {};
    $scope.tables = {};
    $scope.tableRowsInfo = {};
    $scope.checkTypes = [];

    // Добавление нового пользователя
    $scope.addNewUser = function (e) {
        var currentEmail = $scope.newUserEmail;

        $http({
            method: 'POST',
            url: '/admin/users/add',
            data: {
                email: currentEmail
            }
        }).then(function success(response) {
            var responseData = response.data;

            if(parseInt(responseData.status) === 1) {
                $http({
                    method: 'POST',
                    url: '/admin/users/send/registration',
                    data: {
                        route: responseData.data,
                        email: currentEmail
                    }
                }).then(function success(response) {
                    var resMsg = response.data;

                    if(parseInt(resMsg.status) ===  1) {
                        $scope.newUserEmail = '';
                        $scope.getUsers(function() {
                            $.notify({
                                icon: 'pe-7s-check',
                                message: "Новый пользователь - был добавлен"
                            },{
                                type: 'info',
                                timer: 2000
                            });
                        });
                    }
                }, function error(response) {});
            }

        }, function error(response) {

        });
    };

    // Удаление пользователя
    $scope.removeUser = function (email) {
        $http({
            method: 'POST',
            url: '/admin/profile/remove',
            data: {
                email: email
            }
        }).then(function success(response) {
            if(parseInt(response.data) === 1) $scope.getUsers();

        }, function error(response) {});
    };

    // Вывод пользователей
    $scope.getUsers = function (callback) {
        $http({
            method: 'GET',
            url: '/admin/users/all'
        }).then(function success(response) {
            $scope.users = response.data;
            if(callback) {
                callback();
            }
        }, function error(response) {});
    };

    $scope.getUserInfo = function (email, callback) {
        $http({
            method: 'GET',
            url: '/admin/profile/' + email + '/info'
        }).then(function success(response) {
            var responseData = response.data;

            responseData.permissions = JSON.parse(responseData.permissions);
            $scope.userInfo = responseData;

            if(callback) {
                callback();
            }

        }, function error(response) {});
    };

    // Редактирование пользователя
    $scope.updateUserInfo = function () {
        var data = $scope.userInfo;

        for(var i=0; i<data['permissions'].length; i++) {
            for(var y=0; y<data['permissions'][i]['rows'].length; y++) {
                data['permissions'][i]['rows'][y]['checked'] = parseInt(data['permissions'][i]['rows'][y]['checked']);
            }
        }

        $http({
            method: 'POST',
            url: '/admin/profile/update',
            data: data
        }).then(function success(response) {
            var responseData = response.data;
            if(parseInt(responseData) === 1) {
                $scope.getUserInfo(data.email, function () {
                    $.notify({
                        icon: 'pe-7s-check',
                        message: "Информация <b>" + data.name + " " + data.surname + "</b> - была обновлена"

                    },{
                        type: 'info',
                        timer: 2000
                    });
                });
            }
        }, function error(response) {});
    };

    $scope.checkChilds = function (table) {
        if(table.checked === true) {
            table.rows.forEach(function(e){
                e.checked = true;
            });
        } else {
            table.rows.forEach(function(e){
                e.checked = false;
            });
        }
    };

    $scope.checkParent = function (table) {
        var tempCkecked = [];

        table.rows.forEach(function(e){
            tempCkecked.push(e.checked);
        });

        if($.inArray(true, tempCkecked) > -1) table.checked = true;
        else table.checked = false;
    };

    $scope.getTables = function (email) {
        $http({
            method: 'GET',
            url: '/admin/profile/tables/get'
        }).then(function success(response) {
            $scope.tables = response.data;
        }, function error(response) {});
    };

    $scope.getTable = function (table, page) {
        $http({
            method: 'GET',
            url: '/admin/profile/table/' + table + '/get?page=' + page
        }).then(function success(response) {
            $scope.tableRowsInfo = response.data.data.data;
            $scope.checkTypes = response.data.checkTypes;
        }, function error(response) {});
    };

    $scope.isEmpty = function(obj) {
        for(var prop in obj) {
            if(obj.hasOwnProperty(prop))
                return false;
        }
        return true;
    };

    $scope.dropdownEvent = function (current, event) {
        console.log(event.target);
        if($(current).hasClass('in') !== true) {
            $('.dropdown-collapse').removeClass('in');
            $(current).addClass('in');
        }
        else {
            $(current).removeClass('in');
        }
    };

    $scope.updateTableInfo = function (table, primaryKey, key) {
        var data = $scope.tableRowsInfo[key]
        console.log(data);
    };
});