app.factory("RoleFactory",['$http',"$httpParamSerializer",
function ($http,$httpParamSerializer) {

    var roleFactory = {};

    roleFactory.GetRole = function (page, perPage, freeText) { 
        let queryParams = {
            page: page,
        };
        if (freeText) queryParams.freeText = freeText;
        if (perPage) queryParams.perPage = perPage;
        
        let url = siteUrl +  "/roles?" + $httpParamSerializer(queryParams);
        return $http.get(url);
     };
    roleFactory.ShowRole = function (id) { 
        return $http({
            method: 'GET',
            url : siteUrl + "/roles/show/" + id,
        });
     };
     roleFactory.SaveRole = function(RoleModel){
        return $http({
            method : 'Post',
            url : siteUrl +  '/roles/store',
            data : RoleModel,
            headers: {
                "Content-type": "application/x-www-form-urlencoded", 
            },
        })
    }

    roleFactory.UpdateRole = function(RoleModel,id){
        return $http({
            method: "put",
            url:  siteUrl + "/roles/update/" + id,
            data: RoleModel,
            headers: {
                "Content-type": "application/x-www-form-urlencoded",
            },
        })
    }

    roleFactory.DelRole = function(id){
        return $http({
            method: "delete",
            url: siteUrl + "/roles/delete/" + id,
            headers: {
                "Content-type": "application/x-www-form-urlencoded",
            },
        })
    }

    roleFactory.GetPermis = function () { 
        return $http({
            method: 'GET',
            url : siteUrl + "/roles/getPermisstion",
        });
     };
     return roleFactory;
 }]);
