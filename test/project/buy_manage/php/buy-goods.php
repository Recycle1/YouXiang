<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>商品购买界面</title>
		<link rel="stylesheet" href="../css/base.css"/>
		<link rel="stylesheet" href="../css/buy-goods.css"/>
		<style type="text/css">
			body{
				width: 100%;
			}
			.img_check{
				border: 2px solid #FF0000;
			}
			#btn_search{
				margin-left: 5px;
			    width: 85px;
				height: 42px;
				border:0 ;
				background-color: #b1191a;
				font-size: 16px;
				color: #fff;
				float: right;
			}
		</style>
		<?php
			include '../../conn.php';
			$goods_id='';
			if($_GET){
				$goods_id=$_GET['goods_id'];
			}
			$sql="select * from goods_information where goods_id='$goods_id'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);
		?>
		<script type="text/javascript">
			function search(){
				var text=document.getElementById('text');
				location="../../main/list.php?key="+text.value;
			}
			function number(action){
				num=document.getElementById("num");
				<?php echo "var inventory=".$row["inventory"].";"; ?>
				if(action=="+"){
					if(num.value!=inventory){
						num.value++;
					}
				}
				else{
					if(num.value!=1){
						num.value--;
					}
				}
			}
			function changeimg(i,url){
				var mainimg=document.getElementById("mainimg");
				mainimg.src=url;
				var content=document.getElementById("img_ul");
				var items=content.getElementsByTagName("li");
				length=items.length;
				for(var j=0;j<length;j++){
					items[j].className="";
				}
				items[i].className+="checked";
			}
			function create(action){
				var con="";
				if(action=="dd"){
					con="确认购买？";
				}
				else{
					con="确认加入？";
				}
				if(confirm(con)){
					var goods_id="<?php echo $goods_id;?>";
					var quantity=document.getElementById("num").value;
					var webto="create.php?action="+action+"&goods_id="+goods_id+"&quantity="+quantity;
					if(document.getElementById("size")!=null){
						var size=document.getElementById("size").value;
						webto+="&size="+size;
					}
					if(document.getElementById("style")!=null){
						var style=document.getElementById("style").value;
						webto+="&style="+style;
					}
					location=webto;
				}
			}
		</script>
	</head>
	<body>
		<!-- top start -->
		<?php
			session_start();
			if(empty($_SESSION['user'])){
				echo "<script>location='../../login_register/login.php';</script>";
			}
			include "../../top.php";
		?>
		<!-- top end -->
		
		<!-- head start -->
		<div class="header">
			<!--logo-->
			<div class="logo">
				<h1>
					<img id="logo" src="../../base_photo/logo_name.png" width="170px" height="70px"></img>
				</h1>
			</div>
			<!--search-->
			<div class="search">
				<input type="text" class="text" id="text" value="">
				<button id="btn_search" class="btn" onclick="search()">搜索</button>
			</div>
			<!-- <div class="shopcar"><i class="car"></i>&nbsp;我的购物车<i class="arrow"></i><i class="count">10</i></div> -->
		</div>
		
		<div class="head">
			<div class="title">
				<p><?php echo $row['goods_from']?></p>
			</div>
		</div>
		<!-- head end -->
		
		
		<!-- body start -->
		<div class="body">
			<!--  -->
			<div class="left">
				<div class="pic">
					<img id="mainimg" src="<?php echo $row['photo1'];?>" >
				</div>
				<ul id="img_ul">
					<li class="checked" onclick="changeimg(0,'<?php echo $row['photo1'];?>')"><img src="<?php echo $row['photo1']; ?>" ></li>
					<li class="" onclick="changeimg(1,'<?php echo $row['photo2'];?>')"><img src="<?php echo $row['photo2']; ?>" ></li>
					<li class="" onclick="changeimg(2,'<?php echo $row['photo3'];?>')"><img src="<?php echo $row['photo3']; ?>" ></li>
				</ul>
			</div>
			
			<div class="center">
				<form action="" method="post">
					<p><?php echo $row["name"]; ?></p>
					<p class="price"><label>价格</label><span>￥<?php echo $row["price"]; ?></span></p>
					<?php if(!empty($row["size"])){
						echo "<nav><label>尺码</label><span>
						<select id=\"size\">";
						$i=0;
						$size=explode(";s-i-z-e;",$row["size"]);
						while($i<count($size)){
							echo "<option value=\"".$size[$i]."\">$size[$i]</option>";
							$i++;
						}
						echo "</select>
						</span></nav>";
						}
					?>
					<?php if(!empty($row["style"])){
						echo "<p class=\"style\"><label>分类</label><span>
							<select id=\"style\">";
						$i=0;
						$style=explode(";s-t-y-l-e;",$row["style"]);
						while($i<count($style)){
							echo "<option value=\"".$style[$i]."\">$style[$i]</option>";
							$i++;
						}
						echo "</select>
						</span></p>";
						}
					?>
					<p><label>数量</label><span>
					<a href="javascript:number('-');" class="reduce">-</a>
					<input type="number" name="num" id="num" class="num" value="1" readonly="readonly" />
					<a href="javascript:number('+');" class="add">+</a></span> 件（库存<?php echo $row["inventory"]; ?>件）</p>
					<p class="btn"><a href="javascript:create('dd')" class="buy_btn">立即购买</a>
					<a href="javascript:create('gwc')" class="add_cart">加入购物车</a></p>
					<p class="commit"><label>承诺</label><span>7天无理由退换货</span></p>
					<p class="pay"><label>支付</label><span>支付宝</span>&nbsp;&nbsp;<span>微信支付</span></p>
				</form>
			</div>
			
			<div class="right">
				
			</div>
		</div>
		<?php
			include "../../bottom.php";
		?>
		<!-- bottom end -->
	</body>
</html>