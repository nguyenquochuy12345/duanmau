<script>
    var mang = [];
    var i = 0;
    mang[0] = "./view/img/banner1.jpg";
    mang[1] = "./view/img/banner2.jpg";
    mang[2] = "./view/img/banner3.png";

    function show() {
        i++;
        if (i > mang.length - 1) {
            i = 0;
        }


        document.getElementById("banner").src = mang[i];
        time = setTimeout(show, 2000)

    }
    window.onload = function() {
        xoa();
        time = setTimeout(show, 2000)
    }

    function xoa() {
        document.getElementsByName('timsp')[0].value = "";
    }
</script>
<div class="content">
    <div class="dau">
        <div class="banner2">
            <img id="banner" onclick="show()" src="./view/img/banner1.jpg" alt="">
        </div>
        <div class="tieudelon">Sản phẩm</div>
    </div>
    <div class="cuoi">

        <div class="menucon">
            <aside>
                <div class="search">

                    <form action="index.php?act=timsp" method="post">
                        <input type="text" name="kyw" placeholder="Nhập tên sản phẩm ">
                        <button type="submit" name="timsp">Tìm kiếm</button>
                    </form>

                </div>
                <div class="tieude">
                    <h3>Danh mục</h3>
                </div>
                <ul>
                    <?php foreach ($categories as $cate) : ?>

                        <li><a href="index.php?act=sanpham&iddm=<?= $cate['cate_id'] ?>"><?= $cate['cate_name'] ?></a></li>

                    <?php endforeach ?>
                </ul>

            </aside>
            <aside class="topsp">
                <div class="tieude">
                    <h3>Top 10 yêu thích </h3>
                </div>
                <ul class="yeuthich">
                    <?php foreach ($top10sp as $top10sp) : ?>
                        <li><a href="index.php?act=chitiet_sanpham&id=<?= $top10sp['product_id'] ?>&iddm=<?= $top10sp['cate_id'] ?>"><img src="/duanmau/view/img/<?= $top10sp['img'] ?>" alt="">
                                <div class="tensp_yeuthich"><?= $top10sp['product_name'] ?></div>
                            </a></li>
                    <?php endforeach ?>
                </ul>

            </aside>
        </div>
        <section>
            <?php foreach ($products as $product) : ?>
                <div class="sp">
                    <div class="anhsp">
                        <img src="./view/img/<?= $product['img'] ?>" alt="">
                        <div class="nut">
                            <button><a href="index.php?act=chitiet_sanpham&id=<?= $product['product_id'] ?>&iddm=<?= $product['cate_id'] ?>">CHI TIẾT</a></button>

                        </div>
                    </div>
                    <div class="tensp"><a href="index.php?act=chitiet_sanpham&id=<?= $product['product_id'] ?>&iddm=<?= $product['cate_id'] ?>">
                            <h5><?= $product['product_name'] ?></h5>
                        </a></div>
                    <div class="gia"><?= format_currency($product['price'])  ?> VNĐ</div>

                </div>
            <?php endforeach ?>
        </section>

        <div class="banner">
            <div class="tienich">
                <i class="fa-sharp fa-solid fa-truck-fast"></i>
                <div class="kbt">
                    <h3>CHÍNH SÁCH GIAO HÀNG</h3>
                    <p>Nhận hàng và thanh toán tại nhà</p>
                </div>
            </div>
            <div class="tienich">
                <i class="fa-solid fa-repeat"></i>
                <div class="kbt">
                    <h3>ĐỔI TRẢ DỄ DÀNG </h3>
                    <p>Đổi mới trong 7 ngày đầu</p>
                </div>
            </div>
            <div class="tienich">
                <i class="fa-solid fa-credit-card"></i>
                <div class="kbt">
                    <h3>
                        THANH TOÁN TIỆN LỢI</h3>
                    <p>Trả tiền mặt, CK, trả góp 0%</p>
                </div>
            </div>
            <div class="tienich">
            <i class="fa-solid fa-comments"></i>
                <div class="kbt">
                    <h3>
                    HỖ TRỢ NHIỆT TÌNH</h3>
                    <p>Tư vấn, giải đáp mọi thắc mắc</p>
                </div>
            </div>
        </div>
    </div>

</div>