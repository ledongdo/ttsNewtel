app.controller("UserController", function ($scope, UserFactory, RoleFactory) {
    $scope.data = {
        listUser: [],
        listRole: [],
        listPerPage: [5, 10, 15],
        filter: {
            freeText: "",
            page: 1,
            perPage: 5,
        },
    };

    $scope.customer = {
        name: "Naomi",
        address: "1600 Amphitheatre",
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
    //delete User
    $scope.action = {
        filter: function () {
            processData.listUser();
        },
        paginate: function (pageNo) {
            $scope.data.filter.page = pageNo;
            processData.listUser();
        },
        delete: function (id) {
            var confmDel = confirm("Ban muon xoa khong");
            if (confmDel == true) {
                UserFactory.DelUser(id)
                    .then(function (resp) {
                        showmesage(resp.data.message);
                        processData.listUser();
                    })
                    .catch(function (err) {
                        console.log(err);
                    });
            } else {
                return false;
            }
        },

        //Create User
        save: function (id) {
            var UserModel = $.param({
                name: $scope.user?.name,
                email: $scope.user?.email,
                password: $scope.user?.password,
                role_id: $scope?.role,
            });

            if (typeof id == "undefined") {
                UserFactory.SaveUser(UserModel)
                    .then(function (response) {
                        showmesage(response.data.message);
                        processData.listUser();
                        $("#myModal").modal("toggle");
                    })
                    .catch(function (response) {
                        $scope.vldName = response.data?.name;
                        $scope.vldEmail = response.data?.email;
                        $scope.vldPass = response.data?.password;
                    });
            }
            if (typeof id !== "undefined") {
                UserFactory.UpdateUser(UserModel, id)
                    .then(function (response) {
                        showmesage(response.data.message);
                        processData.listUser();
                        $("#myModal").modal("toggle");
                    })
                    .catch(function (response) {
                        console.log(response.data.message);
                        $scope.vldName = response.data.name;
                        $scope.vldEmail = response.data.email;
                        $scope.vldPass = response.data.password;
                    });
            }
        },
    };

    //Show User
    $scope.modal = function (id) {
        $scope.id = id;
        if (typeof id == "undefined") {
            $scope.FormTitle = "Thêm User";
        }
        if (typeof id !== "undefined") {
            $scope.FormTitle = "Sửa User";
            UserFactory.ShowUser(id).then(function (response) {
                console.log(response);
                $scope.user = response.data.user;
                $scope.optionRole = response.data.user.roles;
                $scope.role = response.data.user.roles;
            });
        }
        $("#myModal").modal("show");
    };

    //ListUser

    const processData = {
        listUser: function () {
            UserFactory.GetUser(
                $scope.data.filter.page,
                $scope.data.filter.perPage,
                $scope.data.filter.freeText
            )
                .then(function (response) {
                    $scope.users = response.data.users.data;
                    console.log(response);

                    var allUser = response.data.users.total;
                    var per = response.data.users.per_page;
                    

                    //buttonPage
                    var tmpPages = [];
                    var count = Math.ceil(allUser / per);
                    for (var i = 1; i <= count; i++) {
                        tmpPages.push(i);
                    }

                    $scope.pages = tmpPages;

                })
                .catch(function (err) {
                });
        },
        //getrole
        listRole: function () {
            RoleFactory.GetRole().then(function (response) {
                $scope.roleOption = response.data.roles;
            });
        },
    };
    //logout
    $scope.logout = function () {
        UserFactory.Logout().then(function (resp) {
            console.log(resp);
            UserFactory.Login();
        });
    };

    processData.listUser();
    processData.listRole();
});

$(document).ready(function () {
    $("#btn-add,#btn-edit").click(function () {
        $("#myModal").modal("show");
    });
});
