app.controller("RoleController", function ($scope, RoleFactory) {
    $scope.data = {
        ListRole: [],
        ListPermis: [],
        listPerPage: [5, 10, 15],
        filter: {
            freeText: "",
            page: 1,
            perPage: 5,
        },
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

    //showform
    $scope.modal = function (id) {
        $scope.id = id;
        if (typeof id == "undefined") {
            $scope.FormTitle = "Thêm Role";
        }
        if (typeof id !== "undefined") {
            $scope.FormTitle = "Sửa Role";
            RoleFactory.ShowRole(id).then(function (response) {
                console.log(response);
                $scope.role = response.data.roles;
                $scope.permission = response.data.roles.permissions;
                ids = [];
                angular.forEach($scope.permission, function (item) {
                    ids.push(item.id);
                });
                angular.forEach($scope.permiss, function (permission) {
                    if (ids.indexOf(permission.id) > -1) {
                        permission.checked = true;
                    } else {
                        permission.checked = false;
                    }
                });
            });
        }

        $("#myModal").modal("show");

        //event
        //
    };

    //action
    $scope.action = {
        filter: function () {
            processData.ListRole();
        },
        paginate: function (pageNo) {
            $scope.data.filter.page = pageNo;
            processData.ListRole();
        },
        delete: function (id) {
            var confmDel = confirm("Ban muon xoa khong");
            if (confmDel == true) {
                RoleFactory.DelRole(id)
                    .then(function (resp) {
                        showmesage(resp.data.message);
                        processData.ListRole();
                    })
                    .catch(function (response) {
                        if (response.status === 401) {
                            alert(response.data);
                        }
                    });
            } else {
                return false;
            }
        },

        //Create User
        save: function (id) {
            var album = $scope.permiss.filter(function (permission) {
                return permission.checked;
            });
            console.log($scope.permiss);
            $scope.permission = [];
            angular.forEach(album, function (item) {
                $scope.permission.push(item.id);
            });
            RoleModel = $.param({
                name: $scope.role?.name,
                permission_id: $scope?.permission,
            });
            if (typeof id == "undefined") {
                RoleFactory.SaveRole(RoleModel)
                    .then(function (response) {
                        showmesage(response.data.message);
                        processData.ListRole();
                        $("#myModal").modal("toggle");
                    })
                    .catch(function (response) {
                        if (response.status === 401) {
                            alert(response.data);
                        } else {
                            $scope.vldName = response.data.name;
                        }
                    });
            }
            if (typeof id !== "undefined") {
                RoleFactory.UpdateRole(RoleModel, id)
                    .then(function (response) {
                        showmesage(response.data.message);
                        processData.ListRole();
                        $("#myModal").modal("toggle");
                    })
                    .catch(function (response) {
                        if (response.status === 401) {
                            alert(response.data);
                        } else {
                            $scope.vldName = response.data.name;
                        }
                    });
            }
        },
    };

    const processData = {
        ListRole: function () {
            RoleFactory.GetRole(
                $scope.data.filter.page,
                $scope.data.filter.perPage,
                $scope.data.filter.freeText
            )
                .then(function (response) {
                    $scope.roles = response.data.roles.data;
                    console.log(response);

                    var allRole = response.data.roles.total;
                    var per = response.data.roles.per_page;

                    //buttonPage
                    var tmpPages = [];
                    var count = Math.ceil(allRole / per);
                    for (var i = 1; i <= count; i++) {
                        tmpPages.push(i);
                    }

                    $scope.pages = tmpPages;
                })
                .catch(function (err) {});
        },

        ListPermis: function () {
            RoleFactory.GetPermis().then(function (response) {
                $scope.permiss = response.data.permiss;
            });
        },
    };

    processData.ListRole();
    processData.ListPermis();
});
$(document).ready(function () {
    $("#btn-add,#btn-edit").click(function () {
        $("#myModal").modal("show");
    });
});
