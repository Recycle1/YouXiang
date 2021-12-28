<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册界面</title>
		<style type="text/css">
			body{
				background:url(back.jpg) no-repeat;
				background-size: 100% 100%;
				background-attachment: fixed;
			}
		#register{
			position: relative;
			height: 330px;
			width: 600px;
			margin: 35px auto;
			border-radius: 40px;
			line-height: 15px;
			font-size: 10px;
			background-color:antiquewhite;
		}
		#div1{
			margin-top: 20px; 
			margin-left: 190px;
		}
		#div2{
			margin-top: 20px;
			margin-left: 190px;
		}
		#div3{
			margin-top: 20px;
			margin-left: 202px;
		}
		#div4{
			margin-top: 25px;
			margin-left: 250px;
		}
		h1{
			padding-top: 20px;
			padding-left: 230px;
			font-size: 40px;
			
		}
		h2{
			display: inline-block;
			font-size: 20px;
		}
		h3{
			display: inline-block;
			font-size: 15px;
		}
		.button{
			width: 245px;
			height: 35px;
			text-align: center;
			margin: 25px 0px;
			font-size: 14px;
			font-weight: 500;
			color: #FFFFFF;
			background-color: #f24349;
			border: 0px;
			padding: 8px 35px;
			text-decoration: none;
		}
		.button:hover{
			background-color: #FF6700;
		}
		</style>
		
		
	</head>
	<body>
		<?php 
		//链接数据库
		include "../conn.php";
		
		$user_id=$_GET["user_id"];        //账号
		$sql="select * from user where username='$user_id' ";
		$result=mysqli_query($conn,$sql)or die("查询失败，请检查sql语法");
		$row=mysqli_fetch_assoc($result);
		?>
		
		
		
		<div id="register">
			
			<h1>
				找回成功
			</h1>
			 			
			<div id="div3">
				<h2>账号：</h2><h3><?php echo $row["username"]; ?></h3>
			</div>
			
			<div id="div3">
				<h2>密码：</h2><h3><?php echo $row["password"]; ?></h3>
			</div>
							
			<div id="div4">
				<a href="login.php" class="button">返回</a>
			</div>
		</div>
	</body>
</html>
