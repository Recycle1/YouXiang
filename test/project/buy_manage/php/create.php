<?php
	include "../../conn.php";
	$goods_id=$quantity=$size=$style=$buy_username=$shop_order="";
	if($_GET){
		if(isset($_GET['size'])){
			$size=$_GET['size'];
		}
		if(isset($_GET['style'])){
			$style=$_GET['style'];
		}
		if(isset($_GET['order'])){
			$shop_order=$_GET['order'];
		}
		if(isset($_GET['goods_id'])){
			$goods_id=$_GET['goods_id'];
		}
		if(isset($_GET['quantity'])){
			$quantity=$_GET['quantity'];
		}
		session_start();
		$buy_username=$_SESSION['user'];
		date_default_timezone_set('PRC');
		$date=date('Y-m-d H:i:s',time());
		if($_GET['action']=='dd'){
			$order_id=uniqid("dd_");
			$sql="insert into order_form values('$order_id','$goods_id',$quantity,'$size','$style','$buy_username','$date',0,'','')";
			mysqli_query($conn,$sql) or die("插入失败".$sql);
			echo "<script>location='../../gouwuche/zhifu.php?action=dd&order=$order_id';</script>";
		}
		else if($_GET['action']=='gwc'){
			$shop_id=uniqid("gwc_");
			$sql="insert into gouwuche values('$buy_username',$quantity,'$size','$style','$goods_id','$shop_id')";
			mysqli_query($conn,$sql) or die("插入失败".$sql);
			echo "<script>location='buy-goods.php?goods_id=$goods_id';alert('加入成功');</script>";
		}
		else if($_GET['action']=='gwc_dd'){

			$shop_row=explode("o-r-d-e-r",$shop_order);
			$order="";
			$length=0;
			for($i=0;$i<count($shop_row);$i++){
				$order_id=uniqid("dd_");
				if($shop_row[$i]!=''){
					$sql="select * from gouwuche where shop_cart_id='$shop_row[$i]'";
				$result=mysqli_query($conn,$sql) or die("查询失败".$sql);
				$row=mysqli_fetch_assoc($result);
				$goods_id=$row["goods_id"];
				$quantity=$row["quantity"];
				$size=$row["size"];
				$style=$row["style"];
				$username=$row["username"];
				$sql="insert into order_form values('$order_id','$goods_id',$quantity,'$size','$style','$username','$date',0,'','')";
				mysqli_query($conn,$sql) or die("插入失败".$sql);
				$sql="delete from gouwuche where shop_cart_id='$shop_row[$i]'";
				mysqli_query($conn,$sql);
				$order.=$order_id."o-r-d-e-r";
				$length++;
				}
				
			}
			echo "<script>location='../../gouwuche/zhifu.php?order=$order&number=$length&action=dd';</script>";
			
		}
	}
?>