<?php
function add($cate_name)
{
    include '../ketnoi/ketnoi.php';
    $error = [];
    if ($cate_name == "") {
        $error['cate_name'] = "Bạn chưa nhập tên danh mục";
    } 
    else if($cate_name != " ") {
        $sql = "SELECT cate_name FROM categories WHERE cate_name ='$cate_name'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $check_cate_name = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($check_cate_name) {
            $error['cate_name'] = "Tên danh mục đã tồn tại";
        }    
    }
    $_SESSION['cate_error'] = $error;
       
    if(!$error){   
        $sql = "INSERT INTO  categories(cate_name) values('$cate_name')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }    
}
function delete($id)
{
    include '../ketnoi/ketnoi.php';
    $sql = " UPDATE products SET cate_id = '48' WHERE cate_id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($sql) {
        $sql = "DELETE FROM categories WHERE cate_id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}
function edit($id)
{
    include '../ketnoi/ketnoi.php';
    $sql = "SELECT * FROM  categories  WHERE cate_id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cate = $stmt->fetch(PDO::FETCH_ASSOC);
    return $cate;
}
function updatedm($cate_id, $cate_name)
{
    include '../ketnoi/ketnoi.php';
    $error = [];
    if ($cate_name == "") {
        $error['cate_name'] = "Bạn chưa nhập tên danh mục";
    } 
    else if($cate_name != " ") {
        $sql = "SELECT cate_name FROM categories WHERE cate_id !='$cate_id' AND  cate_name ='$cate_name' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $check_cate_name = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($check_cate_name) {
            $error['cate_name'] = "Tên danh mục đã tồn tại";
        }    
    }
    $_SESSION['cate_error'] = $error;
       
    if(!$error){   
        $sql = "UPDATE   categories set  cate_name = ('$cate_name') WHERE cate_id = '$cate_id '";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }    
  
}
function showdm()
{
    include '../ketnoi/ketnoi.php';
    $sql = "SELECT * FROM categories order by cate_id desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cates;
}
function showdm_user()
{
    include './ketnoi/ketnoi.php';
    $sql = "SELECT * FROM categories order by cate_id desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cates;
}
function thongke_dm()
{
    include '../ketnoi/ketnoi.php';
    $sql = "SELECT cate_name , COUNT(categories.cate_id) as 'soluong', MAX(products.price) AS 'max' , MIN(products.price) AS 'min' FROM categories JOIN products ON products.cate_id=categories.cate_id GROUP BY cate_name ORDER BY categories.cate_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $cates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $cates;
}
