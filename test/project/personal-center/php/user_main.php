<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>个人中心</title>
		<link rel="stylesheet" type="text/css" href="../css/personal-base.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-header.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-content.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-footer.css" />
	</head>
	<style type="text/css">
		.checked {
			background-color: #ff4e37;
		}
		
		.checked a {
			color: #fff !important;
			opacity: 0.9;
		}
		
		#become{
			color: #CC0000;
			font-style: italic;
		}
		
		.security-right{
			float: left;
		}
		
	</style>
	<script>
		function change(pos){
			var content=document.getElementById("security-left-nav");
			var items=content.getElementsByTagName("li");
			for(var i=0;i<items.length;i++){
				items[i].className="";
			}
			items[pos].className+="checked";
			if(pos==3){
				<?php session_start();
				if($_SESSION['identity']==1){
					echo "document.getElementById(\"become\").click()";
				}
				else{
					echo "document.getElementById(\"a3\").click()";
				}
				?>
			}
			else{
				document.getElementById("a"+pos).click();
			}
		}
		window.onload=function(){
			var pos=0;
			<?php if(isset($_GET['pos'])){
				echo "pos=".$_GET['pos'].";";
			}?>
			pos=Number(pos);
			change(pos);
		}
	</script>
	
	<body>
		<?php include '../../top.php'; ?>
		<!-- headbox end -->
		<!-- bodybox begin -->
		<div class="content">
			<div class="icon">
				<img src="../../base_photo/logo.png">
			</div>
			<div class="personal-container">
				<div class="security-left">
					<span class="security-left-title">个人中心</span>
					<ul class="security-left-nav" id="security-left-nav">
						<li class="checked"><a id="a0" href="user_info.php" target="security-right" onclick="change(0)">我的信息</a></li>
						<li><a id="a1" href="user_order.php" target="security-right" onclick="change(1)">我的订单</a></li>
						<li><a id="a2" href="../../gouwuche/shopping_cart.php" target="security-right" onclick="change(2)">我的购物车</a></li>
						<?php
							//session_start();
							if($_SESSION['identity']==2){
								echo "<li><a id='a3' href=\"seller_goods.php\" target=\"security-right\" onclick=\"change(3)\">店铺管理</a></li>
										<li><a id='a4' href=\"seller_order.php\" target=\"security-right\" onclick=\"change(4)\">店铺订单</a></li>";
							}
							else if($_SESSION['identity']==1){
								echo "<li><a id=\"become\" href=\"become_seller.php\" target=\"security-right\" onclick=\"change(3)\">成为卖家!</a></li>";
							}
						?>
					</ul>
				</div>
				<iframe class="security-right" name="security-right" frameborder="no">	
					<!-- profile-detail-end -->
				</iframe>
				<!-- security-right-end -->
			</div>
			<!-- profile-container-end -->
		</div>
		<!-- bodybox end -->
		<!-- foot begin -->
		<?php include '../../bottom.php'; ?>
		<!-- foot end -->
	</body>
</html>
