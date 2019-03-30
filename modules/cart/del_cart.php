<?php
session_start();
if(isset($_GET['prd_id'])){
    $prd_id = $_GET['prd_id'];
}
unset($_SESSION['cart'][$prd_id]);
if(count($_SESSION['cart']) == 0){
    unset($_SESSION['cart']);
}

header('location:../../index.php?page_layout=cart');
?>