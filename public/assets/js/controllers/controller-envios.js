
brioApp.controller("EnviosController", ["$scope", "EnviosService", function ($scope, EnviosService) {


        $scope.pagination = {
            currentPage: 1,
            enviosPerPage: 5,
            totalEnvios: 0,
            envioPageChanged: function (newPageNumber) {

                
                
                if($scope.buscar.direccionDestinatario === '' && $scope.buscar.fechaInicio ==='' && $scope.buscar.fechaFin === ''){
                    $scope.envios.traerEnvios(newPageNumber);
                }else{
                    $scope.buscar.buscarEnvios(newPageNumber);
                }
                /*
                 if ($scope.prescriptionData.patientName === '' && $scope.prescriptionData.areaName === '' && $scope.prescriptionData.doctorName === '') {
                 $scope.prescriptionData.getPrescriptions(newPageNumber);
                 } else {
                 $scope.prescriptionData.searchPrescriptions(newPageNumber);
                 }*/
            }
        };


        $scope.envios = {
            formatearFecha: function (fecha) {
                var f = new Date(fecha);
                var mes = f.getMonth() + 1
                return f.getDate() + "/" + mes + "/" + f.getFullYear();

            },
            listadoEnvios: {},
            cargandoEnvios: false,
            mostrarDetalleEnvio: false,
            envioSeleccionado: {},
            cerrarDetalleEnvio: function () {
                this.mostrarDetalleEnvio = false;
                this.envioSeleccionado = {}
            },
            traerEnvios: function (pagina) {
                this.cargandoEnvios = true;
                EnviosService.traerEnvios(pagina).then(function (response) {
                    $scope.envios.cargandoEnvios = false;
                    $scope.envios.listadoEnvios = response.data.envios;
                    $scope.pagination.currentPage = pagina;
                    $scope.pagination.totalEnvios = response.data.count;
                }, function (response) {});

            },
            traerEnvio: function (id_envio) {

                this.cargandoEnvios = true;
                EnviosService.traerEnvio(id_envio).then(function (response) {
                    $scope.envios.cargandoEnvios = false;
                    $scope.dashboard.mostrarDetalleEnvio = true;
                    $scope.dashboard.envioSeleccionado = response.data;
                    console.log(response.data);
                }, function () {

                });
            }
        };

        $scope.buscar = {
            direccionDestinatario: '',
            fechaMaxima : Date(),
            fechaInicio: '',
            fechaFin: '',
            cargandoEnvios: false,
            fechaChange: function () {
                if (this.fechaInicio !== '' && this.fechaFin !== '') {
                    $scope.buscar.buscarEnvios(1);
                } else {
                    $scope.envios.traerEnvios(1);
                }
            },
            buscarEnvios: function (pagina) {

                var searchTerms = {
                    direccionDestinatario: this.direccionDestinatario,
                    fechaInicio: this.fechaInicio,
                    fechaFin: this.fechaFin,
                    pageNumber: pagina
                };


                EnviosService.buscarEnvios(searchTerms).then(function (response) {
                    $scope.envios.listadoEnvios = response.data.envios;
                    $scope.pagination.currentPage = pagina;
                    $scope.pagination.totalEnvios = response.data.count;

                }, function (response) {
                    console.log("error", response.data);
                });

            }


        };

        $scope.$watch('buscar.direccionDestinatario', function (newValue) {
            if (newValue.length) {
                $scope.buscar.buscarEnvios(1);
            } else {
                $scope.envios.traerEnvios(1);
            }
        });


        $scope.envios.traerEnvios(1);


    }]);



