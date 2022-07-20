app.factory("UserFactory", [
    "$http",
    "$httpParamSerializer",
    function ($http, $httpParamSerializer) {
        var userFactory = {};
        //getUser
        userFactory.GetUser = function (page, perPage, freeText) {
            let queryParams = {
                page: page,
            };
            if (freeText) queryParams.freeText = freeText;
            if (perPage) queryParams.perPage = perPage;
            
            let url = siteUrl +  "/users/getUser?" + $httpParamSerializer(queryParams);
            return $http.get(url);
        };

        //showUser
        userFactory.ShowUser = function (id) {
            return $http({
                method: "Get",
                url: siteUrl + "/users/show/" + id,
            });
        };

        //SaveUser
        userFactory.SaveUser = function (UserModel) {
            return $http({
                method: "Post",
                url: siteUrl + "/users/store",
                data: UserModel,
                headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                },
            });
        };

        //UpdateUser
        userFactory.UpdateUser = function (UserModel, id) {
            return $http({
                method: "put",
                url: siteUrl + "/users/update/" + id,
                data: UserModel,
                headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                },
            });
        };

        //DelUser
        userFactory.DelUser = function (id) {
            return $http({
                method: "delete",
                url: siteUrl + "/users/delete/" + id,
                headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                },
            });
        };

        //Logout
        userFactory.Logout = function () {
            return $http({
                method: "Get",
                url: siteUrl + "/users/logout",
            });
        };

        //login
        userFactory.Login = function () {
            window.location.replace(siteUrl + "/users/login");
        };

        userFactory.ListRole = function () {
            return $http({
                method: "Get",
                url: siteUrl + "/users/getRole",
            });
        };

        return userFactory;
    },
]);
