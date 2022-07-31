app.directive("departDetail", function (DepartmentFactory) {
    return {
        restrict: "E",
        templateUrl: "/departments/departDetail",
        scope: {
            departId: "=",
        },
        link: function ($scope) {
            $scope.data = {
                getDepartment: [],
                getAllDepartment: [],
                all : [],
            };
            function showmesage(message) {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: message,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
             
            
            const processData = {
                getAllDepartment: function () {
                    DepartmentFactory.GetDepart().then(function (response) {
                        $scope.data.all = response.data.department
                        $scope.departmentOption = response.data.department;
                    });
                },
                getDepartment: function () {
                    DepartmentFactory.ShowDepart($scope.departId)
                        .then(function (response) {
                            $scope.department = response.data;
                            idDep = $scope.departId
                            allDepartM = _.find($scope.data.all, (i) => i.id == idDep)  
                            $scope.departmentOption = _.each($scope.data.all, (i) => {
                                if(allDepartM.parent_id == i.id){
                                    i.selected = true
                                    return i
                                }
                            })
                            console.log($scope.departmentOption);
                        })
                        .catch(function (response) {
                            console.log(response);
                        });
                },
                
            };
            $scope.$watch("departId", function (newVal, oldVal) {
                if (!newVal) return false;
                processData.getDepartment();
            });
            processData.getAllDepartment();
        },
    };
});
