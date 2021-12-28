<?php
	echo "123";
	mysqli_query($conn,$sql) or die($sql);
	$_SESSION['identity']=2;
	echo "<script>alert('注册成功')";
	echo "location='user_main.php';</script>";
?>