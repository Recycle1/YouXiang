<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="css/index1.css">
    <link rel="stylesheet" href="css/basis.css">
    <!--引入css初始化\公共\首页的css文件-->
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
	<?php
		include '../conn.php';
		$sql="select * from recommend";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		function get_img($id){
			global $conn;
			$sql="select * from goods_information where goods_id='".$id."'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);
			return $row['photo1'];
		}
		function get_name($id){
			global $conn;
			$sql="select * from goods_information where goods_id='".$id."'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);
			return $row['name'];
		}
		function get_price($id){
			global $conn;
			$sql="select * from goods_information where goods_id='".$id."'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);
			return $row['price'];
		}
	?>
	<style type="text/css">
		<?php
			for($i=1;$i<6;$i++){
				echo ".container-2 .slider-box-".$i." img{";
				if(empty($row['ad_screen_'.$i])){
					echo "content: url('../base_photo/default_goods.png');";
				}
				else{
					echo "content: url('".get_img($row['ad_screen_'.$i])."');";
				}
				echo "width: 81.3%;height: 100%;}";
			}
		?>
	</style>
	<script>
		function get_goods(id){
			if(id){
				location="../buy_manage/php/buy-goods.php?goods_id="+id;
			}
		}
		function get_img_goods(){
			var img=document.getElementById("img");
			var number=img.parentElement.className.split("x slider-box-")[1];
			if(number=="1"){
				<?php if(!empty($row['ad_screen_1']))
					echo "location='../buy_manage/php/buy-goods.php?goods_id=".$row['ad_screen_1']."';";
				?>
			}
			else if(number=="2"){
				<?php if(!empty($row['ad_screen_2']))
					echo "location='../buy_manage/php/buy-goods.php?goods_id=".$row['ad_screen_2']."';";
				?>
			}
			else if(number=="3"){
				<?php if(!empty($row['ad_screen_3']))
					echo "location='../buy_manage/php/buy-goods.php?goods_id=".$row['ad_screen_3']."';";
				?>
			}
			else if(number=="4"){
				<?php if(!empty($row['ad_screen_4']))
					echo "location='../buy_manage/php/buy-goods.php?goods_id=".$row['ad_screen_4']."';";
				?>
			}
			else if(number=="5"){
				<?php if(!empty($row['ad_screen_5']))
					echo "location='../buy_manage/php/buy-goods.php?goods_id=".$row['ad_screen_5']."';";
				?>
			}
		}
	</script>
</head>

<body>
<div id="app">
    <div class="fix-tool">
        <a target="_self" href="#dingbu">顶部</a>
        <a target="_self" href="#shangou">特价</a>
        <a target="_self" href="#jiayongdianqi">活动</a>
        <a target="_self" href="#bankuai">品牌</a>
        <a target="_self" href="#dibu">底部</a>
    </div>
   <?php include '../top.php';?>
    <div class="main-body">
        <!-- 盒子一  -->
        <div class="container-1">
            <img src="../base_photo/logo_name.png">
            <div class="nav-list">
                <a class="hid-content" target="_self" href="#">
					<span class="top_6" style="color: #AA5500;font-size: 20px;font-weight: 500;font-style: italic;">Top 6</span>
					<?php
						for($i=1;$i<7;$i++){
							$goods=$row['top_6_'.$i];
							echo "<div class=\"item\" onclick=\"get_goods('$goods')\">";
							if(empty($goods)){
								echo "<img src=\"../base_photo/default_goods.png\" alt=\"\">
								<p>无商品信息;</p>
								<p>0元</p>
								</div>";
							}
							else{
								echo "<img src=\"".get_img($goods)."\" title=\"点击查看详情\">
									<p>".get_name($goods)."</p>
									<p>".get_price($goods)."元</p>
									</div>";
							}
						}
					?>
                </a>
            </div>
            <div class="search">
                <input type="text" class="text" id="text" value="">
                <button id="btn_search" class="btn" onclick="search()">搜索</button>
            </div>

        </div>
        <!-- 盒子二  -->
        <div id="dingbu" class="container-2">
            <ul class="left-nav">
                <a class="item" target="_self" href="list.php?catagory=0">食品</a>
                <a class="item" target="_self" href="list.php?catagory=1">服装</a>
                <a class="item" target="_self" href="list.php?catagory=2">电子</a>
                <a class="item" target="_self" href="list.php?catagory=3">家居</a>
                <a class="item" target="_self" href="list.php?catagory=4">出行</a>
                <a class="item" target="_self" href="list.php?catagory=5">母婴</a>
                <a class="item" target="_self" href="list.php?catagory=6">图书</a>
                <a class="item" target="_self" href="list.php?catagory=7">美妆</a>
                <a class="item" target="_self" href="list.php?catagory=8">健康</a>
                <a class="item" target="_self" href="list.php?catagory=9">艺术</a>
                <!-- <div class="hid-content">

                </div> -->
            </ul>
            <div id="slider-box" class="slider-box slider-box-1">
                <div class="switch">
                    <span class="btn" id="per" onclick="pre()">	&lt;</span>
                    <span class="btn" id="next" onclick="next()">&gt;</span>
                </div>
				<img id="img" align="right" onclick="get_img_goods()"/>
            </div>
        </div>
        <!-- 盒子三  -->
        <div class="container-3">
            <div class="nav-list">
                <div class="item">
                    <img class="icon"
                         src="https://cdn.cnbj1.fds.api.mi-img.com/mi-mall/82abdba456e8caaea5848a0cddce03db.png?w=48&h=48">
                    <span>海量商品</span>
                </div>
                <div class="item">
                    <img class="icon"
                         src="https://cdn.cnbj1.fds.api.mi-img.com/mi-mall/82abdba456e8caaea5848a0cddce03db.png?w=48&h=48">
                    <span>品质保证</span>
                </div>
                <div class="item">
                    <img class="icon"
                         src="https://cdn.cnbj1.fds.api.mi-img.com/mi-mall/82abdba456e8caaea5848a0cddce03db.png?w=48&h=48">
                    <span>7天退换</span>
                </div>
                <div class="item">
                    <img class="icon"
                         src="https://cdn.cnbj1.fds.api.mi-img.com/mi-mall/82abdba456e8caaea5848a0cddce03db.png?w=48&h=48">
                    <span>精挑细选</span>
                </div>
                <div class="item">
                    <img class="icon"
                         src="https://cdn.cnbj1.fds.api.mi-img.com/mi-mall/82abdba456e8caaea5848a0cddce03db.png?w=48&h=48">
                    <span>无忧浏览</span>
                </div>
                <div class="item">
                    <img class="icon"
                         src="https://cdn.cnbj1.fds.api.mi-img.com/mi-mall/82abdba456e8caaea5848a0cddce03db.png?w=48&h=48">
                    <span>悠享购物</span>
                </div>
            </div>
			<?php
				for($i=1;$i<4;$i++){
					if(empty($row['new_3_'.$i])){
						echo "<img class=\"img-con-3\" src=\"../base_photo/default_goods.png\">";
					}
					else{
						echo "<img class=\"img-con-3\" src=\"".get_img($row['new_3_'.$i])."\" title=\"点击查看详情\" onclick=\"get_goods('".$row['new_3_'.$i]."')\">";
					}
				}
			?>
        </div>
        <!-- 盒子四  -->
        <div class="container-4">
            <div class="box">
                <div id="shangou" class="title">特价专区</div>
                <div class="content">
					<?php
						for($i=1;$i<6;$i++){
							$goods=$row['bargain_'.$i];
							echo "<div class=\"item item-".$i."\" onclick=\"get_goods('$goods')\">";
							if(empty($goods)){
								echo "<div class=\"img\" style=\"background: url('../base_photo/default_goods.png') center no-repeat;\"></div>
										<p class=\"name\">暂无商品信息</p>
										<p>&nbsp;</p>
										<div class=\"price\"><span class=\"price-now\">0元</span></div>
										</div>";
							}
							else{
								echo "<div class=\"img\" style=\"background: url('".get_img($goods)."') center no-repeat;background-size:100% 100%;\" title=\"点击查看详情\"></div>
										<p class=\"name\">".get_name($goods)."</p>
										<p>&nbsp;</p>
										<div class=\"price\"><span class=\"price-now\">".get_price($goods)."元</span></div>
										</div>";
							}
						}
					?>
                    
                </div>
            </div>
        </div>



        <div id="jiayongdianqi" class="floor">
            <div class="jiadian w">
                <div class="box-hd">
                    <h3 style="color: #464646;">活动专区</h3>
                    <div class="tab-list">
                        <ul>
                            <!-- <li><a href="#" class="style-red">热门</a>|</li>
                            <li><a href="#">大家电</a>|</li>
                            <li><a href="#">生活电器</a>|</li>
                            <li><a href="#">厨房电器</a>|</li>
                            <li><a href="#">个护健康</a>|</li>
                            <li><a href="#">应季电器</a>|</li>
                            <li><a href="#">空气、净水</a>|</li>
                            <li><a href="#">新奇特</a>|</li>
                            <li><a href="#">高端电器</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="box-bd">
                    <ul class="tab-con">
                        <li class="w209">
                            <ul class="tab-con-list">
                                <li><a>节能补贴</a></li>
                                <li><a>折扣满减</a></li>
                                <li><a>极速包邮</a></li>
                                <li><a>精美赠品</a></li>
                                <li><a>团购优选</a></li>
                                <li><a>逛买全球</a></li>
                            </ul>
							<?php 
								if(empty($row['activity_1']))
									echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:187px;height:227px;\"></a>";
								else
									echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_1']."\"><img src=\"".get_img($row['activity_1'])."\" style=\"width:187px;height:227px;\" title=\"点击查看详情\"></a>";
							?>
                        </li>
                        <li class="w329">
							<?php
								if(empty($row['activity_2']))
									echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:329px;height:360px;\"></a>";
								else
									echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_2']."\"><img src=\"".get_img($row['activity_2'])."\" style=\"width:329px;height:360px;\" title=\"点击查看详情\"></a>";
							?>
						</li>
                        <li class="w219">
                            <div class="tab-con-item">
                                <?php
                                	if(empty($row['activity_3']))
                                		echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:219px;height:180px;\"></a>";
                                	else
                                		echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_3']."\"><img src=\"".get_img($row['activity_3'])."\" style=\"width:219px;height:180px;\" title=\"点击查看详情\"></a>";
                                ?>
                            </div>
                            <div class="tab-con-item">
                                <?php
                                	if(empty($row['activity_4']))
                                		echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:219px;height:178px;\"></a>";
                                	else
                                		echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_4']."\"><img src=\"".get_img($row['activity_4'])."\" style=\"width:219px;height:178px;\" title=\"点击查看详情\"></a>";
                                ?>
                            </div>
                        </li>
                        <li class="w220">
                            <div class="tab-con-item">
                                <?php
                                	if(empty($row['activity_5']))
                                		echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:220px;height:359px;\"></a>";
                                	else
                                		echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_5']."\"><img src=\"".get_img($row['activity_5'])."\" style=\"width:220px;height:359px;\" title=\"点击查看详情\"></a>";
                                ?>
                            </div>
                        </li>
                        <li class="w220">
                            <div class="tab-con-item">
                                <?php
                                	if(empty($row['activity_6']))
                                		echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:220px;height:180px;\"></a>";
                                	else
                                		echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_6']."\"><img src=\"".get_img($row['activity_6'])."\" style=\"width:220px;height:180px;\" title=\"点击查看详情\"></a>";
                                ?>
                            </div>
                            <div class="tab-con-item">
                                <?php
                                	if(empty($row['activity_7']))
                                		echo "<a><img src=\"../base_photo/default_goods.png\" style=\"width:219px;height:178px;\"></a>";
                                	else
                                		echo "<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$row['activity_7']."\"><img src=\"".get_img($row['activity_7'])."\" style=\"width:219px;height:178px;\" title=\"点击查看详情\"></a>";
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 盒子五  -->
        <div class="container-5">
            <?php
				$goods=$row['ad_middle'];
            	if(empty($goods)){
            		echo "<img src=\"../base_photo/default_goods.png\" alt=\"\">";
            	}
            	else{
            		echo "<img src=\"".get_img($goods)."\" title=\"点击查看详情\" onclick=\"get_goods('$goods')\">";
            	}
            ?>
        </div>
        <!-- 盒子六  -->
        <div id="bankuai" class="container-6" >
            <div class="box">
                <div class="title">
                    <span>品牌专栏</span>
                    <!-- <span>查看全部</span> -->
                </div>
                <div class="content">
                    <img class="phone-img" src="img/phone-logo.jpg" alt="">
                    <div class="phone-box">
						<?php
							for($i=1;$i<9;$i++){
								$goods=$row['brand_'.$i];
								echo "<div class=\"item\" onclick=\"get_goods('".$goods."')\">";
								if(empty($goods)){
									echo "<img src=\"../base_photo/default_goods.png\" alt=\"\">
										<p class=\"name\">暂无商品信息</p>
										<p class=\"desc\">&nbsp;</p>
										<p class=\"price\">0元</p>
										</div>";
								}
								else{
									echo "<img src=\"".get_img($goods)."\" title=\"点击查看详情\">
										<p class=\"name\">".get_name($goods)."</p>
										<p class=\"desc\">&nbsp;</p>
										<p class=\"price\">".get_price($goods)."元</p>
										</div>";
								}
							}
						?>
                        
                    </div>
                </div>
            </div>
        </div>



        <!-- 盒子七  -->
        <div class="container-7">
			<?php
				$goods=$row['ad_bottom'];
				if(empty($goods)){
					echo "<img src=\"../base_photo/default_goods.png\" alt=\"\">";
				}
				else{
					echo "<img src=\"".get_img($goods)."\" title=\"点击查看详情\" onclick=\"get_goods('$goods')\">";
				}
			?>
        </div>
    </div>
    <?php include '../bottom.php' ?>

</div>

<script src="js/index1.js"></script>
<script>
	function search(){
		var text=document.getElementById('text');
		// alert(text.value);
		location="list.php?key="+text.value;
		
	}
	
</script>
</body>

</html>