
app.controller("RoleController", function ($scope, RoleFactory) {
    $scope.data = {
        ListRole: [],
        ListPermis: [],
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
            });
        }
        $("#myModal").modal("show");
    };

    //action
    $scope.action = {
        delete: function (id) {
            var confmDel = confirm("Ban muon xoa khong");
            if (confmDel == true) {
                RoleFactory.DelRole(id)
                    .then(function (resp) {
                        showmesage(resp.data.message);
                        processData.ListRole();
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
            // var modelPer = [];
            // var alertMsg = '';
            // angular.forEach($scope.permiss,function(permission){
            //     if(permission.selected){
            //         modelPer.push(permission);
            //         alertMsg += 'id'+ permission.id
            //     }
                
            // });
            
               
            var album = $scope.permiss.filter(function(permission){
                return permission.selected;
              });
            
            console.log(album)
             
            RoleModel = $.param({
                name: $scope.role.name,
                permission_id: $scope.permission ,
            });
            if (typeof id == "undefined") {
                RoleFactory.SaveRole(RoleModel)
                    .then(function (response) {
                        showmesage(response.data.message);
                        processData.ListRole();
                    })
                    .catch(function (response) {
                        console.log(response)
                    });
            }
            if (typeof id !== "undefined") {
                RoleFactory.UpdateRole(RoleModel, id)
                    .then(function (response) {
                        showmesage(response.data.message);
                        processData.ListRole();
                    })
                    .catch(function (response) {
                        console.log(response.data.message);
                        
                    });
            }
        },
    };

    const processData = {
        ListRole: function () {
            RoleFactory.GetRole().then(function (response) {
                console.log(response);
                $scope.roles = response.data.roles;
            });
        },

        ListPermis : function () { 
            RoleFactory.GetPermis().then(function (response) { 
                console.log(response)
                $scope.permiss = response.data.permiss
                // $scope.permObj = new Object
                // Object.keys($scope.permiss).forEach(jjjjj =>{
                //     $scope.permObj[$scope.permiss[jjjjj]] = false
                // })
                
                // $scope.aa = function (param) { 
                //     $scope.permiss[param] =  !$scope.permiss[param]
                //  }
             })
         }
    };

    processData.ListRole();
    processData.ListPermis();
});
$(document).ready(function () {
    $("#btn-add,#btn-edit").click(function () {
        $("#myModal").modal("show");
    });
});
