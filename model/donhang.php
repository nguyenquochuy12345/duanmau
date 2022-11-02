<?php
function dathang($id_user, $hovaten, $tel, $email, $address, $tong)
{
    include './ketnoi/ketnoi.php';
    $errors = [];
    if ($email == "") {
        $errors['email'] = "Email không được để trống";
    } else if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không đúng định dạng";
    }
    if ($hovaten == "") {
        $errors['hovaten'] = "Họ và tên không được để trống";
    }
    if ($address == "") {
        $errors['address'] = "Địa chỉ không được để trống";
    }
    if ($tel == "") {
        $errors['tel'] = "Số điện thoại không được để trống";
    }
    $sdt = '/0\d{9,10}/';
    if (!preg_match($sdt, $tel)) {
        $errors['tel'] = "Số điện thoại không đúng định dạng";
    }
    $_SESSION['errors_muahhang'] =  $errors;
    if (!$errors) {
        $sql = "INSERT INTO tbl_order(user_id,hovaten,tel,email,address,status_id,tong) VALUES('$id_user','$hovaten','$tel', '$email','$address',1,'$tong')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($sql) {
            $last_id = $conn->lastInsertId();
            foreach ($_SESSION['cart'] as $cart) {
                $product_id = $cart[0];
                $quantity = $cart[4];
                $sql = "INSERT INTO order_detail(order_id,product_id,quantity) VALUES('$last_id','$product_id','$quantity')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                if ($sql) {
                    $sql = "UPDATE products SET quantity = quantity - '$quantity' WHERE product_id =  '$product_id' ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                }
            }
        }
    }
    unset($_SESSION['cart']);
}

function showdonhang_theo_user($user_id)
{
    include './ketnoi/ketnoi.php';
    $sql = "SELECT order_id,hovaten,email,tel,address,ngaydathang,tbl_order.status_id,order_status.status FROM tbl_order JOIN order_status ON order_status.status_id = tbl_order.status_id  WHERE user_id = '$user_id' order by ngaydathang DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $my_order = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $my_order;
}
function show_chitiet_order($order_id)
{
    include './ketnoi/ketnoi.php';
    $sql = " SELECT order_id, order_detail.quantity, products.product_name,products.price,products.img  FROM order_detail JOIN products ON products.product_id = order_detail.product_id WHERE order_id = '$order_id' order by products.price desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $order_details;
}
function show_chitiet_order_theokhachhang($order_id)
{
    include '../ketnoi/ketnoi.php';
    $sql = " SELECT order_id, order_detail.quantity, products.product_name,products.price,products.img  FROM order_detail JOIN products ON products.product_id = order_detail.product_id WHERE order_id = '$order_id' order by products.price desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $order_details;
}
function admin_show_chitiet_order($order_id)
{
    include '../ketnoi/ketnoi.php';
    $sql = " SELECT order_id, order_detail.quantity, products.product_name,products.price,products.img  FROM order_detail JOIN products ON products.product_id = order_detail.product_id WHERE order_id = '$order_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $order_details;
}
function showdonhang()
{
    include '../ketnoi/ketnoi.php';
    $sql = "SELECT * FROM tbl_order order by ngaydathang desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $show_order = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $show_order;
}
function showdonhang_theo_khachhang($user_id)
{
    include '../ketnoi/ketnoi.php';
    $sql = "SELECT *  FROM tbl_order   JOIN order_status on order_status.status_id = tbl_order.status_id WHERE user_id = '$user_id' order by ngaydathang desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $show_order_theo_khachhang = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $show_order_theo_khachhang;
}
function capnhat_donhang($status, $order_id, $tong, $ngaydathang)
{
    include '../ketnoi/ketnoi.php';
    if ($status == 3) {
        $sql = "UPDATE  tbl_order SET status_id = 3 ,ngayhoanthanhdonhang = CURRENT_DATE, ngaydathang = '$ngaydathang'   WHERE order_id = '$order_id'  ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($sql) {
            $sql = "SELECT ngay FROM   doanhthu WHERE ngay = CURRENT_DATE ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $doanhthu = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$doanhthu) {
                $sql = "INSERT INTO doanhthu VALUES (CURRENT_DATE,'$tong')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            } else {
                $sql = "UPDATE doanhthu SET tongdoanhthu = tongdoanhthu+$tong WHERE ngay = CURRENT_DATE";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            }
        }
    } else {
        $sql = "UPDATE  tbl_order SET status_id = '$status',ngaydathang = '$ngaydathang' WHERE order_id = '$order_id'  ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}
function show_status()
{
    include '../ketnoi/ketnoi.php';
    $sql = "SELECT * FROM order_status";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $status;
}
