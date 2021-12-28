<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style type="text/css">
			p{
				text-align: center;
				font-size: 25px;
				font-style: initial;
				color: #FF0000;
				font-weight: bold;
			}
			.btn{
				width: 200px;
				height: 50px;
				background-color: #FF0000;
				color: #FFFFFF;
				font-size: 15px;
				margin: 15px;
				margin-top: 500px;
			}
			.m{
				width: 450px;
				height: 600px;
				background: url(photos/become_seller.png);
				background-size:100% 100%;
				text-align: center;
				margin: 0px auto;
			}
		</style>
		<?php
			include "../../conn.php";
			session_start();
			$username=$_SESSION['user'];
			$sql="update user set identity=2 where username='$username'";
			if($_POST){
				$b=$_POST['b'];
				if($b=='acc'){
					mysqli_query($conn,$sql) or die($sql);
					$_SESSION['identity']=2;
					echo "<script>alert('注册成功');";
					echo "window.top.location.href='user_main.php';</script>";
				}
			}
		?>
	</head>
	<body>
		<p>加入我们，下一个百万富翁就是你</p>
		<div class="m">
			<form action="become_seller.php" method="post" target="security-right">
				<input type="hidden" name="b" value="acc" />
				<input class="btn" type="submit" value="成为商家"/>
			</form>
		</div>
	</body>
</html>