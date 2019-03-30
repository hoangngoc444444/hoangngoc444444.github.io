<?php
session_start();
if(isset($_SESSION['user_mail']) && isset($_SESSION['user_pass'])){
    define('TEMPLATE', true);
    include_once('../config/connect.php');
    $sql = "DELETE FROM `product` WHERE `prd_id` = $_GET[prd_id]";
    mysqli_query($connect, $sql);
    header('location:index.php?page_layout=product');
}
else{
    header('location:index.php');
}







?>