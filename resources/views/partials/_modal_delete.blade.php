<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">注意！</h4>
      </div>
      <div class="modal-body">
        <p>该操作一旦执行将无法被撤销，您确定要继续此操作吗？</p>
      </div>
      <div class="modal-footer">
        <a id="btn_delete" class="btn btn-danger" v-on="click:removeData"><i class="fa fa-trash"></i> 删除</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->