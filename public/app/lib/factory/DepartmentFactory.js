app.factory("DepartmentFactory",['$http','$httpParamSerializer',
    function ($http,$httpParamSerializer) { 
        var departmentFactory = {};
        departmentFactory.GetDepart = function (freeText) { 
            let queryParams = {
                freeText: freeText,
            };
            return $http({
                method: 'GET',
                url : siteUrl + "/departments?" + $httpParamSerializer(queryParams),
            }); 
         }

         departmentFactory.DelDepart = function (id) { 
             return $http({
                 method: 'delete',
                 url : siteUrl + "/departments/delete/" + id,
             })
          }
         departmentFactory.CreateDepart = function (DepartModel) { 
             return $http({
                 method: 'post',
                 url : siteUrl + "/departments/store/",
                 data : DepartModel,
                 headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                },

             })
          }
         departmentFactory.ShowDepart = function (id) { 
             return $http({
                 method: 'get',
                 url : siteUrl + "/departments/show/" +id,

             })
          }
         departmentFactory.UpdateDepart = function (id,DepartModel) { 
             return $http({
                 method: 'put',
                 url : siteUrl + "/departments/update/" +id,
                 data : DepartModel,
                 headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                },

             })
          }
        return departmentFactory;
    }
    
]);     