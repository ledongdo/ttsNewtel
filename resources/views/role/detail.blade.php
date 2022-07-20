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
                <label for="inputEmail3" class="col-sm-3 control-label">Tên role</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Vui lòng nhập tên" ng-model="role.name" required />
                  <span id="helpBlock2" class="help-block" ng-if="vldName" ng-repeat="vld in vldName">@{{vld}}</span>
                </div>
              </div>
              <div class="form-group">
              <label for="inputEmail3" class="col-sm-3 control-label text-danger">Quyền role</label>
              </div>


              <div class="card border-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    <label for="">
                        Module user
                        <input type="checkbox" name="" id="">
                    </label>
                </div>
                <div class="row">
                    <div class="card-body text-primary col-md-3">
                        <p class="card-title">Some qu</p>
                    </div>
                </div>
                
            </div>


              <div class="form-group" style="width: 100%;height: 250px;overflow: auto;">
                <div class="col-sm-9" style="padding-left: 50px;"  ng-repeat="permission in permiss " >
                  <input type="checkbox" class="form-check-input" id="name" name="name" ng-model="permission.checked"  value="@{{permission.id}}" />
                  <label class="col-md-7 control-label">@{{permission.display_name}}</label>
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="save"  ng-click="action.save(id)">Lưu</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
