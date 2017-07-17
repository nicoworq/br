var brioApp = angular.module("brioApp", []);

brioApp.controller("LoginController", ["$scope", "LoginService", function ($scope, LoginService) {

        $scope.login = {
            cargando : false,
            usuario: {
                email: "",
                password: ""
            },
            mostrarError: false,
            errorUsuario : '',
            ingresar: function () {
                $scope.login.cargando = true;
                LoginService.makeLogin($scope.login.usuario).then(function (response) {
                    $scope.login.cargando = false;
                    if (response.data.logged) {
                        window.location = Brio.dash_url;
                    } else {
                        $scope.login.mostrarError = true;
                        $scope.login.errorUsuario = response.data.error;
                    }
                }, function () {

                });
            }
        };

    }]);


brioApp.service("LoginService", ['$http', function ($http) {

        this.makeLogin = function (usuario) {
            var data = {usuario: usuario};
            return $http.post(Brio.login_url, data);
        };
    }]);