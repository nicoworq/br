brioApp.service("DatosService", ['$http', function ($http) {

        this.modificarDatos = function (nuevosDatos) {
            return $http({url: Brio.main_url + '/datos-personales/actualizar', method: 'post', data: {nuevosDatos: nuevosDatos}});
        };


    }]);