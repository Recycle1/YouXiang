<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php
			$user_id=$_POST["user_id"];        //账号
			$user_tel=$_POST["user_tel"];      //电话号
			$user_sp=$_POST["user_sp"];        //密保
			include "../conn.php";
			$sql="select * from user where username='$user_id' and tel='$user_tel'";
			$result=mysqli_query($conn,$sql)or die("查询失败，请检查sql语法");
						
			if(!mysqli_num_rows($result)>0){
				echo "<script>";
				echo "alert('手机号输入错误');";
				echo "location.href='find.php';";
				echo "</script>";
			}
			else{
				$sql.=" and answer='$user_sp'";
				$result=mysqli_query($conn,$sql)or die("查询失败，请检查sql语法");
				if(!mysqli_num_rows($result)>0){
					echo "<script>";
					echo "alert('密保输入错误');";
					echo "location.href='find.php';";
					echo "</script>";
				}
				else{
					header("location:successfind.php?user_id=$user_id");
				}
			}
		?>
	</body>
</html>
