<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>个人中心</title>
		<link rel="stylesheet" type="text/css" href="../css/personal-base.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-header.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-content.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-footer.css" />
		<link rel="stylesheet" type="text/css" href="../css/shop-management.css" />
	</head>
	<style type="text/css">
		.shop_null{
			font-size: 20px;
			text-align: center;
			color: #000033;
			margin-top: 50px;
		}
		a{
			text-decoration: none;
			font-size: 17px;
			color: #0050D0;
			margin: 15px 25px;
			border: #CCCCCC solid 1px;
			padding: 5px 15px;
		}
		a:hover{
			background-color: #00B3FF;
		}
		.checked{
			background-color: #00B3FF;
			color: #fff;
		}
	</style>
	<script>
		function change(pos){
			var items=document.getElementsByTagName("a");
			for(var i=0;i<items.length;i++){
				items[i].className="";
			}
			items[pos].className="checked";
		}
		window.onload=function(){
			change(0);
		}
	</script>
	<body>
		<div class="security-right-title">
				<img class="security-right-title-img" src="../img/message4.png">
				<span class="security-right-title-text">我的订单</span>
			</div>
		<div class="profile-detail">
			<div class="profile-search">
			</div>
			<div>
				<a href="../../dingdan/all_my.php" target="order" onclick="change(0)">全部</a>
				<a href="../../dingdan/all_my.php?status=5" target="order" onclick="change(1)">未付款</a>
				<a href="../../dingdan/all_my.php?status=1" target="order" onclick="change(2)">未发货</a>
				<a href="../../dingdan/all_my.php?status=2" target="order" onclick="change(3)">未收货</a>
				<a href="../../dingdan/all_my.php?status=3" target="order" onclick="change(4)">已收货</a>
			</div>
			<iframe src="../../dingdan/all_my.php" style="margin-top: 15px;" name="order" frameborder="0" width="100%" height="570px" scrolling="no"></iframe>
		</div>
	</body>
</html>
