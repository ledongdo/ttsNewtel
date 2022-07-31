appLogin.factory("LoginFactory",['$http',
    function ($http) { 
        var loginFactory = {};
        loginFactory.LoginUser = function (ModelUser) { 
            return $http({
                method : 'Post',
                url : siteUrl + '/Postlogin',
                data : ModelUser,
                headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                },
            })
        }
        loginFactory.GetUser = function () { 
            window.location.replace( siteUrl + "/users/index");
        }
        

        return loginFactory
}]);