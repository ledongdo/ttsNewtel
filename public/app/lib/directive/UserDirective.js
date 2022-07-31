app.directive("userDetail", function (UserFactory) {
    return {
        restrict: "E",
        templateUrl: "/users/userDetail",
        scope: {
            userId: "=",
        },

        link: function ($scope) {
            $scope.data = {
                ShowUser: {},
                getRole: [],
                listRole: [],
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
            $scope.action = {
                save: function (id) {
                    id = $scope.userId;
                    (idRole = []),
                        angular.forEach($scope.role, function (roleItem) {
                            idRole.push(roleItem.id);
                        });
                    console.log(idRole);
                    var UserModel = $.param({
                        name: $scope.user?.name,
                        email: $scope.user?.email,
                        password: $scope.user?.password,
                        role_id: idRole,
                    });
                    if (typeof id == "undefined") {
                        UserFactory.SaveUser(UserModel)
                            .then(function (response) {
                                showmesage(response.data.message);
                                // processData.listUser();
                                $("#myModal").modal("toggle");
                            })
                            .catch(function (response) {
                                if (response.status === 401) {
                                    alert(response.data);
                                } else {
                                    $scope.vldName = response.data?.name;
                                    $scope.vldEmail = response.data?.email;
                                    $scope.vldPass = response.data?.password;
                                }
                            });
                    }
                    if (typeof id !== "undefined") {
                        UserFactory.UpdateUser(UserModel, id)
                            .then(function (response) {
                                showmesage(response.data.message);
                                // processData.listUser();
                                $("#myModal").modal("toggle");
                            })
                            .catch(function (response) {
                                if (response.status === 401) {
                                    alert(response.data);
                                } else {
                                    $scope.vldName = response.data?.name;
                                    $scope.vldEmail = response.data?.email;
                                    $scope.vldPass = response.data?.password;
                                }
                            });
                    }
                },
            };

            let processData = {
                getRole: function () {
                    UserFactory.ShowUser($scope.userId).then(function (
                        response
                    ) {
                        $scope.user = response.data.user;
                        $scope.role = response.data.user.roles;
                        ids = [];
                        angular.forEach($scope.role, function (item) {
                            ids.push(item.id);
                        });
                        angular.forEach($scope.roleOption, function (role) {
                            if (ids.indexOf(role.id) > -1) {
                                role.selected = true;
                            } else {
                                role.selected = false;
                            }
                        });
                    });
                },

                listRole: function () {
                    UserFactory.ListRole().then(function (response) {
                        $scope.roleOption = response.data.roles;
                    });
                },
            };
            $scope.$watch("userId", function (newVal, oldVal) {
                if (!newVal) return false;
                processData.getRole();
            });
            processData.listRole();
        },
    };
});
