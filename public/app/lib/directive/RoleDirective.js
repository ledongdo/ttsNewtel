app.directive("roleDetail", function (RoleFactory) {
    return {
        restrict: "E",
        templateUrl: "/roles/roleDetail",
        scope: {
            roleId: "=",
        },
        link: function ($scope) {
            $scope.data = {
                ShowRole: {},
                GetPermis: {},
                freeTextPermis: "",
                getListPermiss: [],
                getRole: [],
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

            $scope.checkAll = function (index) {
                console.log($scope.permiss[index].checked);
                $scope.permiss[index].checked = !$scope.permiss[index].checked;
                for (
                    let item = 0;
                    item < $scope.permiss[index].permiss_childrent.length;
                    item++
                ) {
                    $scope.permiss[index].permiss_childrent[item].checked =
                        $scope.permiss[index].checked;
                }
            };
            $scope.action = {
                filterPermis: function () {
                    setTimeout(function () {
                        processData.getListPermiss();
                        processData.getRole();
                    }, 500);
                },

                //Create User
                save: function (id) {
                    var id = $scope.roleId;
                    console.log(id);
                    permissCheck = [];
                    angular.forEach($scope.permiss, function (permission) {
                        checkeds = permission.permiss_childrent.filter(
                            function (permit) {
                                return permit.checked;
                            }
                        );
                        console.log(checkeds);
                        permissCheck = permissCheck.concat(checkeds);
                    });
                    permissChildrent = [];
                    angular.forEach(permissCheck, function (children) {
                        permissChildrent.push(children.id);
                    });
                    // console.log(permissChildrent)
                    RoleModel = $.param({
                        name: $scope.role?.name,
                        permission_id: permissChildrent,
                    });
                    if (typeof id == "undefined") {
                        RoleFactory.SaveRole(RoleModel)
                            .then(function (response) {
                                showmesage(response.data.message);
                                // processData.getRole();
                                $("#myModal").modal("toggle");
                            })
                            .catch(function (response) {
                                if (response.status === 401) {
                                    alert(response.data);
                                } else {
                                    $scope.vldName = response.data?.name;
                                }
                            });
                    }
                    if (typeof id !== "undefined") {
                        RoleFactory.UpdateRole(RoleModel, id)
                            .then(function (response) {
                                console.log(response);
                                showmesage(response.data.message);
                                // processData.getRole();
                                $("#myModal").modal("toggle");
                            })
                            .catch(function (response) {
                                if (response.status === 401) {
                                    alert(response.data);
                                } else {
                                    $scope.vldName = response.data?.name;
                                }
                            });
                    }
                },
            };

            let processData = {
                getRole: function () {
                    RoleFactory.ShowRole($scope.roleId)
                        .then(function (response) {
                            console.log($scope.roleId);
                            $scope.role = response.data.roles;
                            $scope.permission = response.data.roles.permissions;
                            ids = [];
                            angular.forEach($scope.permission, function (item) {
                                ids.push(item.id);
                            });
                            angular.forEach($scope.permiss, function (item) {
                                item.checked = false;
                                angular.forEach(
                                    item.permiss_childrent,
                                    function (permissItem) {
                                        if (ids.indexOf(permissItem.id) > -1) {
                                            permissItem.checked = true;
                                        } else {
                                            permissItem.checked = false;
                                        }
                                    }
                                );
                            });
                        })
                        .catch(function (response) {
                            console.log(response);
                        });
                },

                getListPermiss: function () {
                    RoleFactory.GetPermis($scope.data.freeTextPermis)
                        .then(function (response) {
                            console.log(response);
                            $scope.permiss = response.data.permiss;
                        })
                        .catch(function (response) {
                            console.log(response);
                        });
                },
            };

            $scope.$watch("roleId", function (newVal, oldVal) {
                if (!newVal) return false;
                processData.getRole();
            });

            processData.getListPermiss();
        },
    };
});
