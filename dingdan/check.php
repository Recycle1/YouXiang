<?php
	include "../conn.php";
	$order_id=$_GET['order_id'];
	$action=$_GET['action'];
	if($action=="send"){
		$sql="select * from order_form where order_id='$order_id'";
		$result=mysqli_query($conn,$sql) or die($sql);
		$row=mysqli_fetch_assoc($result);
		$goods_id=$row["goods_id"];
		$quantity=$row["quantity"];
		$sql="update goods_information set inventory=inventory-$quantity where goods_id='$goods_id'";
		mysqli_query($conn,$sql) or die($sql);
		$sql="update order_form set status=2 where order_id='$order_id'";
		mysqli_query($conn,$sql) or die($sql);
		echo "<script>history.go(-1);</script>";
	}
	else if($action=="receive"){
		$sql="update order_form set status=3 where order_id='$order_id'";
		mysqli_query($conn,$sql) or die($sql);
		echo "<script>history.go(-1);</script>";
	}
?>