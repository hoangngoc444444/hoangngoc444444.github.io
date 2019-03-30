<?php
if(!defined('TEMPLATE')){
	die('Ban khong du quyen truy cap');
}
if(empty($_SESSION['user_mail'])){
	if(isset($_COOKIE['mail'])){
		$mail = $_COOKIE['mail'];
		$pass = $_COOKIE['pass'];
		$sql = "SELECT * FROM user WHERE user_mail='$mail' AND user_pass='$pass'";
		$row = mysqli_num_rows(mysqli_query($connect,$sql));
		if($row>0){
			$_SESSION['user_mail'] = $mail;
			$_SESSION['user_pass'] = $pass;
			header('location:index.php');
	}
}
}
?>
<!DOCTYPE html>


<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php
	if(isset($_POST['sbm'])){
		$user_mail = $_POST['user_mail'];
		$user_pass = $_POST['user_pass'];
		// các bước thực thi CSDL
		/*
		b1 :gọi file connect (ở index.php)
		b2:viết câu truy vấn	
		b3 thưc thi câu truy vấn
		b4 trả truy vấn về số lượng -> mysqli_num_rows	
		*/
		$sql = "SELECT * FROM user WHERE user_mail = '$user_mail' AND user_pass ='$user_pass'";
		$query = mysqli_query($connect, $sql);
		$num = mysqli_num_rows($query);
		if($num>0){
			$_SESSION['user_mail'] = $user_mail;
			$_SESSION['user_pass'] = $user_pass;
			if(isset($_POST['remember'])){
				setcookie('user_mail',$user_mail,time()+3600);
				setcookie('user_pass',$user_pass,time()+3600);
			}
			if(isset($_POST['autologin'])){
				setcookie('mail',$_SESSION['user_mail'],time()+3600);
				setcookie('pass',$_SESSION['user_pass'],time()+3600);
			}
			header('location:index.php');
		}
		else{
			$error ="<div class='alert alert-danger'>Tài khoản không hợp lệ !</div>";
		}
	}
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Administrator</div>
				<div class="panel-body">
					<?php
					if(isset($error)){
						echo $error;
					}
					?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="user_mail" type="email" value="<?php if(isset($_COOKIE['user_mail'])){echo $_COOKIE['user_mail'];}?>" autofocus required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="user_pass" type="password" value="<?php if(isset($_COOKIE['user_pass'])){echo $_COOKIE['user_pass'];}?>" required>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me" <?php if(isset($_COOKIE['user_mail'])){echo 'checked';}?>>Nhớ tài khoản
								</label>
								<label>
									<input name="autologin" type="checkbox" value="Remember login">Tự động đăng nhập
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name="sbm" >Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>

