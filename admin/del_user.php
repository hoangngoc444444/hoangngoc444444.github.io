<?php
session_start();
if(isset($_SESSION['user_mail']) && isset($_SESSION['user_pass'])){
define('TEMPLATE', true);
include_once('../config/connect.php');
$sql = "DELETE FROM `user` WHERE `user_id` = $_GET[user_id]";
mysqli_query($connect,$sql);
header('location:index.php?page_layout=user');

}
else{
    header('location:index.php');
}












?>