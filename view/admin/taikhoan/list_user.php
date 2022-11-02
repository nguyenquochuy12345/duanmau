<div class="nen">
    <div class="listchung">
        <h1>Danh sách tài khoản </h1>
        <table class="list">

          <thead>
          <tr>  <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>img</th>
                <th>username</th>
                <th>password</th>
                <th>Số điện thoại</th>  
                <th>Vai trò</th>
                <th>Chức năng</th>
            </tr>
          </thead>
            <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?=$user['user_id']?></td>
                    <td><?=  $user['hovaten'] ?></td>
                    <td> <img  class="anhuser" src="../view/img/<?= $user['img'] ?>" alt=""></td>
                    <td><?=$user['username']?></td>
                    <td><?= $user['password']?></td>
                    <td><?= $user['tel']?></td>
                    <td><?= $user['vaitro'] ?></td>
                    <td  id="chucnang"><button id="sua"><a href="index.php?act=edit_user&user_id=<?= $user['user_id'] ?>">Sửa</a></button><?php if($_SESSION['user']['user_id'] != $user['user_id']):?> <button id="xoa" ><a href="index.php?act=delete_user&user_id=<?= $user['user_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')">Xóa</a></button>  <?php endif?></td>

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>