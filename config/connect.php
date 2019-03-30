<?php
if(!defined('TEMPLATE')){
	die('Ban khong du quyen truy cap');
}
$dbhost ="localhost";
$dbuser = "root";
$dbpass = "";
$dbname ="mobile_shop";



$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if($connect){
    // truy vấn thiết lập tiếng việt: meta, collation, câu truy vấ connect
    mysqli_query($connect, "SET NAMES 'utf8'");
}
else{
    die("Bạn kết nối thất bại". mysqli_connect_error());
}

?>

