<div class="nen">
    <div class="listchung">
        <h1>Danh sách đơn hàng</h1>

        
            <table class="list">

              <thead>
              <tr>  
                    <th>Mã đơn hàng</th>
                    <th> Người đặt hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
              </thead>
                <tbody>
                <?php foreach ($showdonhang_theo_khachhang as $value) : ?>
                    <tr>
                        
                        <td ><?=$value['order_id']?></td>
                        <td><?= $value['hovaten'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td><?= $value['tel'] ?></td>
                        <td><?= $value['address'] ?></td>
                        <td id="ngaythang"><?= $value['ngaydathang'] ?></td>
                        <td><?=$value['status']?></td>
                        <td><button class="sua"><a href="index.php?act=chitiet_donhang_theo_khachhang&order_id=<?=$value['order_id']?>">Chi tiết</a></button></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        
    </div>
</div>