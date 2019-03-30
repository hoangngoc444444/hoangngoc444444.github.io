<?php
session_start();
if(isset($_SESSION['user_mail']) && isset($_SESSION['user_pass'])){
    define('TEMPLATE', true);
    include_once('../config/connect.php');
    $sql ="DELETE FROM category WHERE cat_id = $_GET[cat_id]";
    mysqli_query($connect,$sql);
    header('location:index.php?page_layout=category');

}
else{
    header('location:index.php?page_layout=category');
}









?>