<?php
	$name=$_GET["name"];
	$id=$_GET["id"];
	$action=$_GET["action"];
	$number="";
	$inventory="";
	if(isset($_GET["number"])){
		$number=$_GET["number"];
	}
	if(isset($_GET["inventory"])){
		$inventory=$_GET["inventory"];
	}
	
	include 'conn.php';
	if($action=="1"){
		if((int)$number<(int)$inventory){
			$sql = "update gouwuche set quantity=quantity+1 where username='$name' and shop_cart_id='$id'";
			$result = mysqli_query($conn,$sql) or die ("增加失败".$sql);
		}
		
	}
	else if($action=="2"){
		if((int)$number>1){
			$sql = "update gouwuche set quantity=quantity-1 where username='$name' and shop_cart_id='$id'";
			$result = mysqli_query($conn,$sql) or die ("减少失败".$sql);
		}
		
	}
	else if($action=="3"){
		$sql = "delete from gouwuche where username='$name' and shop_cart_id='$id'";
		$result = mysqli_query($conn,$sql) or die ("删除失败".$sql);
	}
	header("location:shopping_cart.php");
?>