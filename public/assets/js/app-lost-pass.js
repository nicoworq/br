var brioApp = angular.module("brioApp", []);

brioApp.controller("LostPasswordController", ["$scope", "LostService", function ($scope, LostService) {


        $scope.lost = {
            cargando: false,
            usuario: {
                email: ""
            },
            mostrarErrorEmail: false,
            errorEmail: 'Ingresa un email válido',
            mostrarSuccess: false,
            emailOK: false,
            recuperarPass: function () {
                this.cargando = true;
                LostService.restorePass($scope.lost.usuario).then(function (response) {
                    this.cargando = false;
                    $scope.lost.cargando = false;
                    if (response.data.send) {
                        //oculto el form y muestro un mensaje
                        $scope.register.mostrarSuccess = true;

                    } else {
                        $scope.lost.mostrarErrorEmail = true;
                        $scope.lost.errorEmail = "Ocurrió un error. Intenta nuevamente";
                    }
                }, function () {
                    $scope.lost.mostrarErrorEmail = true;
                    $scope.lost.errorEmail = "Ocurrió un error. Intenta nuevamente";
                });
            }
        };
    }]);


brioApp.service("LostService", ['$http', function ($http) {

        this.restorePass = function (usuario) {
            var data = {usuario: usuario};
            return $http.post(Brio.restore_url, data);
        };
    }]);

