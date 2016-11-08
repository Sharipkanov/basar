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

                    if(parseInt(resMsg.status) ===  1){
                        $scope.newUserEmail = '';
                        getUsers();
                    }
                }, function error(response) {});
            }

        }, function error(response) {

        });
    };

    var getUsers = function () {
        $http({
            method: 'GET',
            url: '/admin/users/all'
        }).then(function success(response) {
            $scope.users = response.data;

        }, function error(response) {});
    };

    getUsers();
});