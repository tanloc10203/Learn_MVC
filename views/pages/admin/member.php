<table class="table table-hover">
  <thead>
    <tr class="bg-success text-white">
      <th scope="col">ID</th>
      <th scope="col">Ảnh</th>
      <th scope="col">Tên thành viên</th>
      <th scope="col">Tài khoản</th>
      <th scope="col">Quyền</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<!-- Modal -->

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete-member" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delete-member">Xác nhận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có chắc muốn xóa ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
        <button type="submit" class="btn btn-danger" id="delete-member-confirm">Xóa</button>
      </div>
    </div>
  </div>
</div>