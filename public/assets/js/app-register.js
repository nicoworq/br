var brioApp = angular.module("brioApp", []);

brioApp.controller("RegisterController", ["$scope", "RegisterService", function ($scope, RegisterService) {

        var controller = this;

        $scope.register = {
            cargando: false,
            usuario: {
                email: "",
                password: "",
                password2: "",
                user: ""
            },
            mostrarErrorUsuario: false,
            mostrarErrorPassword: false,
            errorEmail: 'Ingresa un email válido',
            errorUsuario: '',
            mostrarSuccess: false,
            emailOK: false,
            emailKeyPress: function () {
                this.errorEmail = 'Ingresa un email válido';
                $scope.register.emailOK = false;
            },
            emailBlur: function () {

                if (controller.registerform.email.$invalid) {
                    $scope.register.emailOK = false;
                    return false;
                }
                RegisterService.checkEmail(this.usuario.email).then(function (response) {
                    if (!response.data['cliente-existente']) {
                        $scope.register.errorEmail = "El email no pertecene a un cliente registrado"
                        controller.registerform.email.$setValidity('email', false);
                        $scope.register.emailOK = false;

                    } else {
                        $scope.register.emailOK = true;
                    }
                }, function (response) {});

            },
            solicitarAcceso: function () {
                this.cargando = true;
                RegisterService.askAccess($scope.register.usuario).then(function (response) {
                    this.cargando = false;
                    $scope.register.cargando = false;
                    if (response.data.send) {
                        //oculto el form y muestro un mensaje
                        $scope.register.mostrarSuccess = true;

                    } else {

                        if (response.data.error) {
                            controller.registerform.email.$setValidity('email', false);
                            $scope.login.errorUsuario = response.data.error;
                        }
                    }
                }, function () {
                    controller.registerform.email.$setValidity('email', false);
                    $scope.login.errorUsuario = "Ocurrió un error. Intenta nuevamente";
                });
            }
        };
    }]);


brioApp.service("RegisterService", ['$http', function ($http) {
        this.checkEmail = function (email) {

            return $http.get(Brio.main_url + '/register/check-email', {params: {email: email}});
        }
        this.askAccess = function (usuario) {
            var data = {usuario: usuario};
            return $http.post(Brio.ask_access_url, data);
        };
    }]);


var compareTo = function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function (scope, element, attributes, ngModel) {

            ngModel.$validators.compareTo = function (modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function () {
                ngModel.$validate();
            });
        }
    };
};

brioApp.directive("compareTo", compareTo);