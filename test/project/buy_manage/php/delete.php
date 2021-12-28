<?php
	include "../../conn.php";
	$goods_id=$_GET['goods_id'];
	$sql="select status from order_form where goods_id='$goods_id'";
	$result=mysqli_query($conn,$sql);
	$flag=0;
		while($row=mysqli_fetch_assoc($result)){
			if($row['status']==1||$row['status']==2){
				echo "<script>alert('已有买家付款且未收货，不可删除商品');";
				echo "history.go(-1);</script>";
				$flag=1;
				break;
			}
		}
	if($flag==0){
		if(mysqli_num_rows($result)>0){
			$sql="delete from order_form where goods_id='$goods_id'";
			mysqli_query($conn,$sql) or die($sql);
		}
		$sql="select * from gouwuche where goods_id='$goods_id'";
		$result=mysqli_query($conn,$sql) or die($sql);
		if(mysqli_num_rows($result)>0){
			$sql="delete from gouwuche where goods_id='$goods_id'";
			mysqli_query($conn,$sql) or die($sql);
		}
		$sql="select * from recommend";
		$result=mysqli_query($conn,$sql) or die($sql);
		$row=mysqli_fetch_array($result);
		$row_name=mysqli_fetch_field($result);
		for($i=1;$i<37;$i++){
			if($row[$i]==$goods_id){
				$sql1="update recommend set $row_name[$i]=''";
				mysqli_query($conn,$sql1) or die($sql1);
			}
		}
		$sql="select * from goods_information where goods_id='$goods_id'";
		$result=mysqli_query($conn,$sql) or die($sql);
		$row=mysqli_fetch_assoc($result);
		if(!empty($row['photo1'])){
			$r=explode("http://localhost/test/project/tmp_photo/",$row['photo1'])[1];
			unlink("../../tmp_photo/".$r);
		}
		if(!empty($row['photo2'])){
			$r=explode("http://localhost/test/project/tmp_photo/",$row['photo2'])[1];
			unlink("../../tmp_photo/".$r);
		}
		if(!empty($row['photo3'])){
			$r=explode("http://localhost/test/project/tmp_photo/",$row['photo3'])[1];
			unlink("../../tmp_photo/".$r);
		}
		$sql="delete from goods_information where goods_id='$goods_id'";
		mysqli_query($conn,$sql) or die($sql);
		echo "<script>alert('删除成功');";
		echo "history.go(-1);</script>";
	}
?>