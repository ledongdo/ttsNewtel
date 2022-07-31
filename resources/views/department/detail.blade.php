<div class="modal fade" tabindex="-1" role="dialog" id="FormDepartment">
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
                <label for="inputEmail3" class="col-sm-3 control-label">Tên Department</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Vui lòng nhập tên" ng-model="department.name" required />
                  <span id="helpBlock2" class="help-block" ng-if="vldName" ng-repeat="vld in vldName">@{{vld}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Department cha</label>
                    <div class="col-sm-9">
                        <select ng-model="item" class="form-control" >
                            <option ng-repeat="item in departmentOption" ng-selected="item.selected" ng-value="item">@{{item.name}}</option>
                        </select>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="save"  ng-click="action.save()">Lưu</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
