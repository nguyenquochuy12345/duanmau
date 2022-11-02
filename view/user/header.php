<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./view/style/trangchu.css">
    <link rel="stylesheet" href="./view/icon/fontawesome-free-6.2.0/css/all.min.css">
    <link rel="stylesheet" href="./view//style/responsive.css">
    <?php
          function format_currency($n = 0){
            $n=(string)$n;
            $n=strrev($n);
            $res='';
            for($i=0;$i<strlen($n);$i++){
                if($i%3==0 && $i!=0){
                    $res.='.';
                }
                $res.=$n[$i];
            }
            $res=strrev($res);
            return $res;
        }
    ?>

</head>

<body>
    <div class="container">
        <header>
            <div class="trai">
                <div class="logo">
                    <img src="./view/img/logo.png" alt="">
                </div>
                <ul>
                    <li><a href="index.php?act=trangchu">Trang chủ</a></li>
                    <li><a href="index.php?act=gioithieu">Giới thiệu</a></li>
                    <li><a href="index.php?act=phanhoi">Phản hồi</a></li>
                </ul>
            </div>
            <div class="phai">
                <a href="index.php?act=viewcart"><i id="cart" class="fa-solid fa-cart-shopping"></i></a>

                <?php if (isset($_SESSION['user'])) {
                    extract($_SESSION['user']);
                ?>

                    <ul class="user">
                        <li class="an"><a class="tenuser" href="#">
                                <div class="chao">Chào:</div> <img src="/duanmau/view/img/<?= $img ?>" alt="">
                                <div class="chao"> <?= $hovaten ?> </div> <i id="muiten" class="fa-solid fa-chevron-down"></i>
                            </a>
                            <ul>    
                                <li><a href="index.php?act=vao_trang_taikhoan">Thông tin tài khoản</a></li>
                                <li><a href="index.php?act=vao_trang_doimatkhau">Đổi mật khẩu</a></li> 
                                <li><a href="index.php?act=vao_donhang">Đơn hàng của tôi</a></li>                              
                                <?php if($vaitro_id==2):?>
                                    <li><a href="admin/index.php">Trang quản trị</a></li>       
                                <?php endif ?>
                                <li><a href="index.php?act=dangxuat">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>

                <?php
                } else {
                ?>

                    <button><a href="index.php?act=vao_trang_dangnhap">Đăng nhập</a></button>
                <?php } ?>
            </div>
        </header>