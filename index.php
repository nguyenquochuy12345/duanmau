<?php
session_start();
include './ketnoi/ketnoi.php';
include './view/user/header.php';
include "./model/sanpham.php";
include "./model/danhmuc.php";
include "./model/taikhoan.php";
include './model/binhluan.php';
include './model/donhang.php';
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
if (isset($_GET['act'])) {
  $act = $_GET['act'];
  switch ($act) {
    case 'guibinhluan':
      unset($_SESSION['thongbaobinhluan']);
      if (isset($_POST['gui'])) {
        if (isset($_SESSION['user'])) {
          if (isset($_GET['id'])) {
            extract($_SESSION['user']);
            $id = $_GET['id'];
            $noidung = $_POST['noidungbl'];
            if ($noidung != "") {
              gui_binhluan($user_id, $id, $noidung);
            } else {
              $_SESSION['thongbaobinhluan'] = "Nội dung bình luận không được để trống ";
            }
          }
        } else {
          $_SESSION['thongbaobinhluan'] = "Bạn cần đăng nhập để bình luận.  ";
        }
      }

      if (isset($_GET['id'])) {
        if (isset($_GET['iddm'])) {
          $id = $_GET['id'];
          $iddm = $_GET['iddm'];
          $reps = show_rep($id);
          $product = chitiet_sp($id);
          if (isset($_GET['so_sanpham_tren1trang'])) {
            $so_sanpham_tren1trang = $_GET['so_sanpham_tren1trang'];
          } else {
            $so_sanpham_tren1trang = 4;
          }
          if (isset($_GET['trang'])) {
            $trang = $_GET['trang'];
          } else {
            $trang = 1;
          }
          $binhluan = show_binhluan($id, $so_sanpham_tren1trang, $trang);
          $sotrang = sotrang($id, $so_sanpham_tren1trang);
          $so_binhluan = dem_binh_luan_theo_sanpham($id);
          $products_lienquan = sanpham_lienquan($id, $iddm);
          header("location: index.php?act=chitiet_sanpham&id=$id&iddm=$iddm");
        }
      }

      break;
    case 'gioithieu':
        include './view/user/gioithieu.php';
      break;
    case 'sanpham':
      if (isset($_GET['iddm'])) {
        $iddm = $_GET['iddm'];
        $products = showsp_theodm($iddm);
        $categories = showdm_user();
        $top10sp = show_top10_sp();
      }
      include './view/user/home.php';
      break;
    case 'trangchu':
      $products = showsp_trangchu();
      $categories = showdm_user();
      $top10sp = show_top10_sp();
      include './view/user/home.php';
      break;
    case 'timsp':
      if (isset($_POST['timsp'])) {
        if (isset($_POST['kyw']) && ($_POST['kyw'] != " ")) {
          $kyw = $_POST['kyw'];
          
          $products = timsp($kyw);
        }
      }
      $categories = showdm_user();
      $top10sp = show_top10_sp();
      require_once './view/user/home.php';
      break;
    case 'chitiet_sanpham':

      if (isset($_GET['id'])) {
        if (isset($_GET['iddm'])) {
          $id = $_GET['id'];
          $iddm = $_GET['iddm'];
          if (isset($_GET['so_sanpham_tren1trang'])) {
            $so_sanpham_tren1trang = $_GET['so_sanpham_tren1trang'];
          } else {
            $so_sanpham_tren1trang = 4;
          }
          if (isset($_GET['trang'])) {
            $trang = $_GET['trang'];
          } else {
            $trang = 1;
          }
          $so_binhluan = dem_binh_luan_theo_sanpham($id);
          $binhluan = show_binhluan($id, $so_sanpham_tren1trang, $trang);
          $sotrang = sotrang($id, $so_sanpham_tren1trang);
          $product = chitiet_sp($id);
          $reps = show_rep($id);
          $products_lienquan = sanpham_lienquan($id, $iddm);
          view($id);
        }
      }
      include './view/user/detail_product.php';
      unset($_SESSION['thongbaobinhluan']);
      break;
    case 'phanhoi':
      include './view/user/phanhoi.php';
      break;
    case 'vao_trang_dangnhap':

      include_once './view/user/login.php';
      unset($_SESSION['dangkythanhcong']);
      $_SESSION['thongbao'] = " ";
      break;
    case 'vao_trang_dangky':
      include_once './view/user/sign_up.php';
      break;
    case 'dangnhap':
      if (isset($_POST['dangnhap'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $checkuser = checkuser($username, $password);
        if (is_array($checkuser)) {
          $_SESSION['user'] = $checkuser;
          header('location: index.php');
        } else {
          $_SESSION['thongbao'] = "Tài khoản hoặc mật khẩu không đúng";
          header('location: index.php?act=vao_trang_dangnhap');
        }
      }
      break;
    case 'dangkytk':

      if (isset($_POST['dangky'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $hovaten = $_POST['hovaten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $address = $_POST['address'];
        $file = $_FILES['img'];
        dangky($username, $password, $repassword, $hovaten, $email, $address, $sdt, $file);
        if (!isset($_SESSION['errors']['img']) && !isset($_SESSION['errors']['username']) && !isset($_SESSION['errors']['password']) && !isset($_SESSION['errors']['repassword']) && !isset($_SESSION['errors']['hovaten']) && !isset($_SESSION['errors']['email']) && !isset($_SESSION['errors']['address']) && !isset($_SESSION['errors']['sdt'])) {
          $_SESSION['dangkythanhcong'] = "Đăng ký thành công";
          header("location: index.php?act=vao_trang_dangnhap");
        } else {
          header("location: index.php?act=vao_trang_dangky");
        }
      }


      break;
    case 'dangxuat':
      session_unset();
      header('location: index.php');
      break;
    case 'vao_trang_quenmk':
      include_once './view/user/forget_password.php';
      break;
    case 'quen_mat_khau':
      if (isset($_POST['gui'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];

        if (!isset($_SESSION['errors']['username']) && !isset($_SESSION['errors']['email'])) {
          quenmatkhau($email, $username);
        }
      }
      include './view/user/forget_password.php';
      break;

    case 'delete_binhluan':
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_GET['iddm'])) {
          $iddm = $_GET['iddm'];
          if (isset($_GET['id_binhluan'])) {
            $id_binhluan = $_GET['id_binhluan'];
            if (isset($_GET['so_sanpham_tren1trang'])) {
              $so_sanpham_tren1trang = $_GET['so_sanpham_tren1trang'];
            } else {
              $so_sanpham_tren1trang = 4;
            }
            if (isset($_GET['trang'])) {
              $trang = $_GET['trang'];
            } else {
              $trang = 1;
            }
            delete_binhluan2($id_binhluan);
            delete_binhluan($id_binhluan);
            $reps = show_rep($id);
            $product = chitiet_sp($id);
            $so_binhluan = dem_binh_luan_theo_sanpham($id);
            $sotrang = sotrang($id, $so_sanpham_tren1trang);
            $binhluan = show_binhluan($id, $so_sanpham_tren1trang, $trang);
            $products_lienquan = sanpham_lienquan($id, $iddm);
            include_once './view/user/detail_product.php';
          }
        }
      }
      break;
    case 'guirep':
      if (isset($_POST['guirep'])) {
        if (isset($_SESSION['user'])) {
          if (isset($_GET['id_binhluan'])) {
            if (isset($_GET['id'])) {
              if (isset($_GET['iddm'])) {
                extract($_SESSION['user']);
                $id = $_GET['id'];
                $iddm = $_GET['iddm'];
                $id_binhluan = $_GET['id_binhluan'];
                $noidungrep = $_POST['rep'];
                if($noidungrep != ""){
                  guirep($user_id, $id, $noidungrep, $id_binhluan);
                }
                else{
                  $_SESSION['thongbaobinhluan'] = "Nội dung trả lời không được để trống ";
                }
                
                if (isset($_GET['so_sanpham_tren1trang'])) {
                  $so_sanpham_tren1trang = $_GET['so_sanpham_tren1trang'];
                } else {
                  $so_sanpham_tren1trang = 4;
                }
                if (isset($_GET['trang'])) {
                  $trang = $_GET['trang'];
                } else {
                  $trang = 1;
                }
                $binhluan = show_binhluan($id, $so_sanpham_tren1trang, $trang);
                $sotrang = sotrang($id, $so_sanpham_tren1trang);
                $so_binhluan = dem_binh_luan_theo_sanpham($id);
                $product = chitiet_sp($id);
                $reps = show_rep($id);
                $products_lienquan = sanpham_lienquan($id, $iddm);
                include_once './view/user/detail_product.php';
              }
            }
          }
        }
      }
      break;
    case 'delete_rep':
      if (isset($_GET['id'])) {
        if (isset($_GET['rep_id'])) {
          if (isset($_GET['iddm'])) {
            $id = $_GET['id'];
            $iddm = $_GET['iddm'];
            $rep_id = $_GET['rep_id'];
            delete_rep($rep_id);
            $products_lienquan = sanpham_lienquan($id, $iddm);
            $reps = show_rep($id);
            $product = chitiet_sp($id);
            if (isset($_GET['so_sanpham_tren1trang'])) {
              $so_sanpham_tren1trang = $_GET['so_sanpham_tren1trang'];
            } else {
              $so_sanpham_tren1trang = 4;
            }
            if (isset($_GET['trang'])) {
              $trang = $_GET['trang'];
            } else {
              $trang = 1;
            }
            $sotrang = sotrang($id, $so_sanpham_tren1trang);
            $so_binhluan = dem_binh_luan_theo_sanpham($id);
            $binhluan = show_binhluan($id, $so_sanpham_tren1trang, $trang);
            include_once './view/user/detail_product.php';
          }
        }
      }
      break;
    case 'add_cart':
      if (isset($_POST['btn_cart'])) {
        $product_id = $_POST['product_id'];
        $soluongcuasp = $_POST['quantity'];
        for ($i = 0; $i <= count(($_SESSION['cart'])) - 1; $i++) {
          if ($_SESSION['cart'][$i][0] == $product_id) {
            $temp = $_SESSION['cart'][$i][4] + $_POST['soluong'];
            if ($temp >= $soluongcuasp) {
              $_SESSION['checksoluong'] = "Số lượng sản phẩm trong giỏ hàng lớn hơn số lượng sản phẩm";
              header("location: index.php?act=viewcart");
              exit;
            } else {
              $_SESSION['cart'][$i][4] += $_POST['soluong'];
              header("location: index.php?act=viewcart");
              exit;
            }
          }
        }
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $img = $_POST['img'];
        $quantity = $_POST['soluong'];
        $spadd = [$product_id, $product_name, $price, $img, $quantity];
        array_push($_SESSION['cart'], $spadd);
      }
      header("location: index.php?act=viewcart");
      break;
    case 'deleteCart':
      if (isset($_GET['idcart'])) {
        array_splice($_SESSION['cart'], $_GET['idcart'], 1);
      } else {
        $_SESSION['cart'] = [];
      }
      header("location: index.php?act=viewcart");
      break;
    case 'viewcart':
      include "./view/user/cart.php";
      break;
    case 'muahang':
      if (isset($_POST['btn_muahang'])) {
        $hovaten = trim($_POST['hovaten']);
        $tel = $_POST['tel'];
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $id_user = $_SESSION['user']['user_id'];
        $tong = $_POST['tong'];
        dathang($id_user, $hovaten, $tel, $email, $address, $tong);
        if (!isset($_SESSION['errors_muahhang']['hovaten']) && !isset($_SESSION['errors_muahhang']['email']) && !isset($_SESSION['errors_muahhang']['address']) && !isset($_SESSION['errors_muahhang']['tel'])) {
          $_SESSION['dangkythanhcong'] = "Đăng ký thành công";
          header("location: index.php?act=vao_trang_xacnhan_muahang");
        } else {
          header("location: index.php?act=vao_trang_xacnhan_muahang");
        }
      }
      break;
    case 'vao_trang_xacnhan_muahang';
      include './view/user/order_confirmation.php';
      break;
    case 'vao_donhang':
      if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['user_id'];
        $my_orders = showdonhang_theo_user($user_id);
      }
      include './view/user/my_order.php';
      break;
    case 'chitiet_order':
      if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $order_details = show_chitiet_order($order_id);
      }
      include './view/user/order_detail.php';
      break;
    case 'capnhat_cart':
      if (isset($_POST['caphnhatgiohang'])) {
        $soluong = $_POST['soluong'];
        for ($i = 0; $i <= count(($soluong)) - 1; $i++) {
          $_SESSION['cart'][$i][4] = $soluong[$i];
          echo $_SESSION['cart'][$i][4];
        }
      }
      $_SESSION['capnhatgiohang'] = "Cập nhật giỏ hàng thành công";
      header("location: index.php?act=viewcart");
      break;
    case 'vao_trang_doimatkhau':

      include './view/user/change_password.php';
      break;
    case 'doimatkhau':
      if (isset($_POST['xacnhandoimk'])) {
        $username = $_POST['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $re_new_password = $_POST['re_new_password'];
        doimatkhau($username, $old_password, $new_password, $re_new_password);
        if (!isset($_SESSION['error_doimk']['username']) && !isset($_SESSION['error_doimk']['old_password']) && !isset($_SESSION['error_doimk']['new_password']) && !isset($_SESSION['error_doimk']['re_new_password'])) {
          $_SESSION['doimatkhau_thanhcong'] = "Đổi mật khẩu thành công";
          header("location: index.php?act=vao_trang_doimatkhau");
        }
      }
      break;
    case 'vao_trang_taikhoan':
      if (isset($_SESSION['user']['user_id'])) {
        $user_id = $_SESSION['user']['user_id'];
        $user = show_tt_theo_user($user_id);
        include './view/user/detail_user.php';
      }

      break;
    case 'capnhat_tk';
      if (isset($_POST['capnhattk'])) {
        $user_id = $_POST['user_id'];
        $hovaten = $_POST['hovaten'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        $file = $_FILES['img'];
        $old_img = $_POST['old_img'];
        $ngaydangky = $_POST['ngaydangky'];
        capnhat_tk($user_id, $hovaten, $email, $tel, $address, $file, $old_img,$ngaydangky);
        if (!isset($_SESSION['errors']['img']) && !isset($_SESSION['errors']['hovaten']) && !isset($_SESSION['errors']['email']) && !isset($_SESSION['errors']['address']) && !isset($_SESSION['errors']['sdt'])) {
          $_SESSION['capnhatthanhcong'] = "Cập nhật tài khoản thành công";
          header("location: index.php?act=vao_trang_taikhoan");
        } else {
          header("location: index.php?act=vao_trang_taikhoan");
        }
      }
      break;
    default:
        $products = showsp_trangchu();
        $categories = showdm_user();
        $top10sp = show_top10_sp();
      include './view/user/home.php';
  }
} else {
  $products = showsp_trangchu();
  $categories = showdm_user();
  $top10sp = show_top10_sp();
  include './view/user/home.php';
}
include './view/user/footer.php';
