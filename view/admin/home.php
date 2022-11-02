<div class="nen">
    
    <div class="listchung">
        <h1>Doanh thu </h1>
        <table class="list" >
           <thead>
           <tr>
                <th>Ngày</th>
                <th>Số đơn hàng</th>
                <th>Doanh thu</th>
                <th>Chức năng</th>
            </tr>
           </thead>
           <tbody>
            <?php $tong= 0?>
           <?php foreach ($doanhthu as $doanhthu_value) : ?>
                <tr>
                    <td><?= $doanhthu_value['ngay'] ?></td>
                    <td><?=$doanhthu_value['sodonhang']?></td>
                    <td><?=format_currency($doanhthu_value['tongdoanhthu']) . " VNĐ"  ?></td>
                    <td><button id="sua"><a href="index.php?act=detail_doanhthu&ngay=<?=$doanhthu_value['ngay']?>">Chi tiêt</a></button></td>
                    <?php $tong +=  $doanhthu_value['tongdoanhthu']?>
                </tr>
            <?php endforeach ?>
                <tr>
                    <th  >Tổng</th>
                    <th></th>
                    <th><?=format_currency($tong). " VNĐ"?></th>
                    <th></th>
                </tr>
                <tr>
                    <td><button id="sua"><a href="index.php?act=bieudo_doanhthu">Biểu đồ</a></button></td>
                    <td></td>
                    <td></td>
                </tr>
           </tbody>
        </table>
    </div>
</div>
<div class="nen3">
    <div class="listchung">
        <h1>Thống kê danh mục</h1>
        <table class="list" >
           <thead>
           <tr>
                <th>Tên danh mục</th>
                <th>Số sản phẩm</th>
                <th>Giá cao nhất</th>
                <th>Giá Thấp nhất nhất</th>
            </tr>
           </thead>
           <tbody>
           <?php foreach ($cate as $cate) : ?>
                <tr>
                    <td><?= $cate['cate_name'] ?></td>
                    <td><?= $cate['soluong'] ?></td>
                    <td><?=  format_currency($cate['max']) . " VNĐ"?></td>
                    <td><?= format_currency($cate['min']) . " VNĐ" ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td><button id="sua"><a href="index.php?act=bieudo_danhmuc">Biểu đồ</a></button></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
           </tbody>
        </table>
    </div>
</div>

<div class="nen3">
<div class="listchung">
        <h1>Top 3 sản phẩm có nhiều lượt xem nhất</h1>
        <table class="list" >
           <thead>
           <tr> 
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Giá</th>
                <th>Số lượt xem</th>
            </tr>
           </thead>
           <tbody>
           <?php foreach ($sanpham_top1_view as $value) : ?>
                <tr>
                    <td><?= $value['product_id'] ?></td>
                    <td><?= $value['product_name'] ?></td>
                    <td><img src="../view/img/<?= $value['img'] ?>" height="100px" alt=""></td>
                    <td><?= format_currency($value['price']) . " VNĐ" ?></td>
                    <td><strong><?= $value['view'] ?></strong></td>
                </tr>
            <?php endforeach ?>
           </tbody>
        </table>
    </div>
</div>
<div class="nen3">
<div class="listchung">
        <h1>Top 3 khách hàng mua hàng nhiều nhất</h1>
        <table class="list" >
           <thead>
           <tr> 
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Ảnh</th>
                <th>Địa chỉ</th>
                <th>Số lần mua hàng</th>
                <th>Chức năng</th>
            </tr>
           </thead>
           <tbody>
           <?php foreach ($khachvip as $value) : ?>
                <tr>
                    <td><?= $value['user_id'] ?></td>
                    <td><?= $value['hovaten'] ?></td>
                    <td><img src="../view/img/<?= $value['img'] ?>" height="100px" alt=""></td>
                    <td><?= $value['address'] ?></td>
                    <td><strong><?= $value['solanmua'] ?></strong></td>
                    <td ><button class="sua"><a href="index.php?act=showdonhang_theo_khachhang&user_id=<?= $value['user_id'] ?> ">Chi tiết</a></button></td>
                </tr>
            <?php endforeach ?>
           </tbody>
        </table>
    </div>
</div>
<div class="nen3">
<div class="listchung">
        <h1>Top 5 Sản phẩm được bình luận nhiều nhất</h1>
        <table class="list" >
           <thead>
           <tr> 
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Giá</th>
                <th>Số bình luận</th>
            </tr>
           </thead>
           <tbody>
           <?php foreach ($sp_binhluannhieu as $value) : ?>
                <tr>
                    <td><?= $value['product_id'] ?></td>
                    <td><?= $value['product_name'] ?></td>
                    <td><img src="../view/img/<?= $value['img'] ?>" height="100px" alt=""></td>
                    <td><?= format_currency($value['price']) . " VNĐ" ?></td>
                    <td><strong><?= $value['sobinhluan'] ?></strong></td>
                </tr>
            <?php endforeach ?>
           </tbody>
        </table>
    </div>
</div>
