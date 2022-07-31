app.controller("DepartmentController", function ($scope, DepartmentFactory) {
    $scope.data = {
        ListDepartment: [],
        all : [],
        item : [],
    };
    $scope.handle = {
        FormData: function (ListDepartment, DepartmentParent) {
            if (
                !$scope.handle.CheckParentId(
                    ListDepartment,
                    DepartmentParent.id
                )
            ) {
                return DepartmentParent;
            }
            for (let i = 0; i < ListDepartment.length; i++) {
                if (ListDepartment[i].parent_id == DepartmentParent.id) {
                    DepartmentParent.expanded = true
                    DepartmentParent.items.push(
                        $scope.handle.FormData(
                            ListDepartment,
                            ListDepartment[i]
                        )
                    );
                }
            }
            return DepartmentParent;
        },
        CheckParentId: function (ListDepartment, parentId) {
            for (let i = 0; i < ListDepartment.length; i++) {
                if (ListDepartment[i].parent_id == parentId) {
                    return true;
                }
            }
            return false;
        },
    };
    const processData = {
        //ListDepartment
        ListDepartment: function () {
            DepartmentFactory.GetDepart().then(function (response) {
                $scope.data.ListDepartment = response.data.department;
                $scope.data.all = response.data.department;
                let DepartmentParent = _.find(
                    $scope.data.ListDepartment,
                    (i) => !i.parent_id
                );

                $scope.data.ListDepartment = _.map(
                    $scope.data.ListDepartment,
                    (item) => {
                        item.items = [];
                        return item;
                    }
                );

                $scope.data.ListDepartment = [
                    $scope.handle.FormData(
                        $scope.data.ListDepartment,
                        DepartmentParent
                    ),
                ];

                $scope.treeViewOptions = {
                    bindingOptions: {
                        searchMode: "searchMode",
                    },
                    displayExpr: "name",
                    items: $scope.data.ListDepartment,
                    width: 500,
                };
                console.log($scope.data.ListDepartment);
            });
        },
    };
    //showForm
    $scope.modal = function (id) {
        $scope.data.departId = id;
        if (!id) {
        }
        if (id) {
        }
        $("#FormDepartment").modal("show");
    };

    $scope.action = {
        delete: function (id) {
            clickDelete = confirm("ban muon xoa khong");
            if (clickDelete == true) {
                DepartmentFactory.DelDepart(id)
                    .then(function (response) {
                        processData.listUser();
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            }
        },
    };
    processData.ListDepartment();
});
