<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>登录认证</title>
	</head>
	<body>
		<?php
		$user_name=$_POST["user_name"];
		$user_pass=$_POST["user_pass"];
		include "../conn.php";
		$sql="select * from user where username='$user_name' ";
		$result=mysqli_query($conn,$sql) or die("查询失败，请检查sql语法");
		
		if(isset($_REQUEST['authcode'])){
			session_start();
			if(strtolower($_REQUEST['authcode']) == $_SESSION['authcode']){
				if(mysqli_num_rows($result)>0){
					$row=mysqli_fetch_assoc($result);
					if($user_pass==$row['password']){
						session_start();
						$_SESSION["user"]=$user_name;
						$_SESSION["password"]=$user_pass;
						$_SESSION["identity"]=$row["identity"];
						if($row["identity"]==0){
							header("location:../personal-center/php/recommend.php");
						}else{
							header("location:../main/allindex.php");
						}
					}
					else{
						echo "<script language='JavaScript' type='text/javascript'>";
						echo "alert('密码输入错误');";
						echo "location.href='login.php';";
						echo "</script>";
					}
				}
				else{
					echo "<script language='JavaScript' type='text/javascript'>";
					echo "alert('用户名输入错误');";
					echo "location.href='login.php';";
					echo "</script>";
				}
					   
			}
			else{
				echo "<script language='JavaScript' type='text/javascript'>";
				echo "alert('验证码输入错误');";
				echo "location.href='login.php';";
				echo "</script>";
			}
			exit();
		}
		?>
	</body>
</html>
