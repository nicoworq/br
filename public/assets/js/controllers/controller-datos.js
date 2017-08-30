

brioApp.controller("DatosController", ["$scope", "DatosService", function ($scope, DatosService) {

        $scope.datos = {
            cargando: false,
            usuario: {},
            mostrarSuccess: false,
            mostrarError: false,
            modificarDatos: function () {
                $scope.datos.cargando = true;
                DatosService.modificarDatos(this.usuario).then(function (response) {
                    $scope.datos.cargando = false;
                    if (response.data.modificado) {
                        $scope.datos.mostrarSuccess = true;
                        $scope.datos.mostrarError = false;
                    } else {
                        $scope.datos.mostrarSuccess = false;
                        $scope.datos.mostrarError = true;
                    }

                }, function (response) {
                    $scope.datos.mostrarError = true;
                });
            }
        };

        $scope.datos.usuario = window.usuario;

    }]);
