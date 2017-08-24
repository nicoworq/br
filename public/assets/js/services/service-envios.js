brioApp.service("EnviosService", ['$http', function ($http) {
        
        
        
        this.listadoEnvios = window.envios? window.envios[0]: [];
        
        this.traerEnvios = function(pagina){
            return $http.get(Brio.main_url + '/traer-envios/'+pagina);
        };
        
        this.buscarEnvios = function (searchParameters) {
            
            return $http({url: Brio.main_url + '/buscar-envio', method: 'GET', params: {searchFront: searchParameters}});
            
        };

        this.traerEnvio = function (id_envio) {
            return $http.get(Brio.main_url + '/traer-envio/' + id_envio);
        };
    }]);