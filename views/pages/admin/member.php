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
  <tbody>
    <?php if (isset($params['data_member']) && is_array($params['data_member']) && count($params['data_member'])) : ?>
      <?php foreach ($params['data_member'] as $member) : ?>
        <tr>
          <th scope="row"><?= $member['id'] ?></th>
          <td>
            <img src="<?= PUBLIC_PATH_USER_UPLOAD . $member['thumb'] ?>" alt="" class="img-thumbnail img-user">
          </td>
          <td><?= $member['fullName'] ?></td>
          <td><?= $member['username'] ?></td>
          <td><?= $member['role'] ?></td>
          <td>
            <button class="btn btn-primary btn-size-small">Sửa</button>
            <button class="btn btn-danger btn-size-small">Xóa</button>
          </td>
        </tr>
      <?php endforeach ?>
    <?php else : ?>
      <tr>
        <th scope="row" colspan="6">Không có dữ liệu</th>
      </tr>
    <?php endif; ?>
  </tbody>
</table>