<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
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
			margin: 55px auto;
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
			margin-left: 190px;
		}
		#div4{
			margin-top: 20px;
			margin-left: 280px;
		}
		h1{
			padding-top: 20px;
			text-align: center;
			font-size: 40px;
			
		}
		h2{
			display: inline-table;
		}
		span{
			color: #F00;
			font-size: 6px;
		}
		.button{
			transform: translate(-50%,-50%);
			width: 245px;
			height: 35px;
			text-align: center;
			margin: 25px 0px;
			font-size: 14px;
			font-weight: 500;
			color: #FFFFFF;
			background-color: #f24349;
			border: 0px;
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
		
		//过滤字符函数
		function filterInput($data){
			$data = trim($data);//不必要的字符
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}  
		
		$telErr="";
		$spErr="";
		$idErr="";
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
		$user_id=$_POST["user_id"];        //账号
		$user_tel=$_POST["user_tel"];      //电话号
		$user_sp=$_POST["user_sp"];        //密保
		
		//过滤字符 
		$user_id=filterInput($user_id);
		$user_tel=filterInput($user_tel);
		$user_sp=filterInput($user_sp);
		
		if(empty($user_id))
		{
			 $idErr="账号为空";
		}
		if(empty($user_tel))
		{
			$telErr="电话号为空";
		}
		if(empty($user_sp))
		{
			$spErr="密保为空";
		}
		
		if($idErr=='' and  $telErr=='' and  $spErr=='' )
		{
		  //$conn=mysqli_connect("localhost","root","","user") or die("数据库连接失败");
		  //先查询账号
		  $sql="select * from user where username='$user_id' ";  
		  $result=mysqli_query($conn,$sql) or die("查询失败，请检查sql语法".$sql);
		  
		  //如果查询到该账号则进行核对密码与密保
		  if (mysqli_num_rows($result)>0)
		  {
				echo "<script language='JavaScript' type='text/javascript'>";
				echo "location.href='find_check.php';";
				echo "</script>";
		  }
		  //如果没有查询到该账户
		  else
		  {
		   //$user_hash=password_hash($user_pass,PASSWORD_DEFAULT);
		   //$sql="insert into user(user_name,user_pass) values('$user_name','$user_pass')";
		   //$result=mysqli_query($conn,$sql) or die("插入失败，语法错误");
		   echo "<script language='JavaScript' type='text/javascript'>";
		   echo "alert('用户名错误');";
		   echo "location.href='find.php';";
		   echo "</script>";
		  }
		}
		}
		?>
		
		
		<div id="register">
			<form name="reg" method="post" action="find_check.php">
			<h1>
				找回密码
			</h1>
			
			
			<div id="div3">
				<h2>账号信息：</h2></td><td><input class="text" type="text" name="user_id" /><span><?php echo $idErr; ?></span>
			</div>
			
			<div id="div2">
				<h2>手机号码：</h2><input class="text" type="text" name="user_tel" /><span><?php echo $telErr; ?></span>
			</div>
				
			<div id="div3">				
				<h2>密保答案：</h2></td><td><input class="text" type="text" name="user_sp" /><span><?php echo $spErr; ?></span>
			</div>
							
			<div id="div4">
			<input type="submit" name="" class="button" value="找回密码" />
			</div>
								
			</form>
		</div>
	</body>
</html>
