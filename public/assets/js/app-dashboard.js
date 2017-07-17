var brioApp = angular.module("brioApp", []);

brioApp.controller("DashboardController", ["$scope", "EnviosService", function ($scope, EnviosService) {

        $scope.dashboard = {
            cargandoEnvios: false,
            mostrarDetalleEnvio: false,
            envioSeleccionado: {},
            cerrarDetalleEnvio: function () {
                this.mostrarDetalleEnvio = false;
                this.envioSeleccionado = {}
            },
            traerEnvios: function () {},
            traerEnvio: function (id_envio) {
                console.log("traerenvio");
                this.cargandoEnvios = true;
                EnviosService.traerEnvio(id_envio).then(function (response) {
                    $scope.dashboard.cargandoEnvios = false;
                    $scope.dashboard.mostrarDetalleEnvio = true;
                    $scope.dashboard.envioSeleccionado = response.data;
                    console.log(response.data);
                }, function () {

                });
            }
        };

    }]);


brioApp.service("EnviosService", ['$http', function ($http) {

        this.traerEnvio = function (id_envio) {
            return $http.get(Brio.main_url + '/traer-envio/' + id_envio);
        };
    }]);

brioApp.controller("EnviosController", ["$scope", "EnviosService", function ($scope, EnviosService) {

        $scope.envios = {
            cargandoEnvios: false,
            mostrarDetalleEnvio: false,
            envioSeleccionado: {},
            cerrarDetalleEnvio: function () {
                this.mostrarDetalleEnvio = false;
                this.envioSeleccionado = {}
            },
            traerEnvios: function () {},
            traerEnvio: function (id_envio) {
                console.log("traerenvio");
                this.cargandoEnvios = true;
                EnviosService.traerEnvio(id_envio).then(function (response) {
                    $scope.dashboard.cargandoEnvios = false;
                    $scope.dashboard.mostrarDetalleEnvio = true;
                    $scope.dashboard.envioSeleccionado = response.data;
                    console.log(response.data);
                }, function () {

                });
            }
        };

    }]);


jQuery(document).ready(function ($) {
    $('#datepicker2,#datepicker3').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
});