appLogin.controller("LoginController",function ($scope,LoginFactory) { 
    $scope.save = function () { 
        var ModelUser = $.param({
            email: $scope.user?.email,
            password: $scope.user?.password,
        })
        LoginFactory.LoginUser(ModelUser)
            .then(function(response){
                console.log(response);
                LoginFactory.GetUser();
            }).catch(function (response) { 
                $scope.errorEmail = response.data.email
                $scope.errorPassword = response.data.password
                $scope.errorLogin = response.data.error
             })
     }
 })