<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">@{{FormTitle}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div> 
          <div class="modal-body">
            <form name="frmUser" class="form-horizontal" method="POST">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Vui lòng nhập tên" ng-model="user.name" required />
                  <span id="helpBlock2" class="help-block" ng-if="vldName" ng-repeat="erorr in vldName">@{{erorr}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Vui lòng nhập Email" ng-model="user.email" required />
                  <span id="helpBlock2" class="help-block" ng-if="vldEmail" ng-repeat="erorr in vldEmail">@{{erorr}}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Vui lòng nhập password" ng-model="user.password" required />
                  <span id="helpBlock2" class="help-block" ng-if="vldPass" ng-repeat="erorr in vldPass">@{{erorr}}</span>
                </div>
              </div>

                <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Role</label>
                    <div class="col-sm-9">
                        <select ng-model="role" class="form-control" >
                            <option ng-repeat="role in roleOption"  ng-value="role.id" >@{{role.name}}</option>
                        </select>
                    </div>
                </div>
              

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="save" ng-click="action.save(id)">Lưu</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
