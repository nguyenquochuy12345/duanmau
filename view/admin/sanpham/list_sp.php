<div class="nen">
    <div class="listchung">
        <h1>Danh sách sản phẩm</h1>
        <form action="index.php?act=showsp" method="post" class="search">
        <input type="text" name="kyw">
            <select  name="cate_id">
            <option value="0" selected>Tất cả</option>
                <?php foreach ($cates as $cate) : ?>    
                    <option value="<?= $cate['cate_id'] ?>"><?= $cate['cate_name'] ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" name="tim">Tìm kiếm</button>
        </form>
        <table class="list">

          <thead>
          <tr>
                <th>Product_id</th>
                <th>Product_name</th>
                <th>Price</th>
                <th>Img</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Cate_id</th>
                <th><button id="them"><a href="index.php?act=addsp">Thêm</a></button></th>
            </tr>
          </thead>
            <tbody> <?php foreach ($products as $product) : ?>
                
                <tr>
                      <td id="proid"><?= $product['product_id'] ?></td>
                      <td id="tensp"><?= $product['product_name'] ?></td>
                      <td id="gia"> <?= format_currency($product['price']). " VNĐ" ?></td>
                      <td><img src="/duanmau/view/img/<?= $product['img'] ?> "height="100px" alt=""></td>
                      <td id="description" ><?= $product['description'] ?></td>
                      <td><?=$product['quantity']?></td>
                      <td><?= $product['cate_name'] ?></td>
                      <td  id="chucnang"><button id="sua"><a href="index.php?act=editsp&id=<?= $product['product_id'] ?>">Sửa</a></button><button id="xoa"><a href="index.php?act=delete_sp&id=<?= $product['product_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')">Xóa</a></button></td>
  
                  </tr>
  
                  
              <?php endforeach ?></tbody>
          
        </table>
        
    </div>
</div>