<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/personal-base.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-content.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-footer.css" />
		<link rel="stylesheet" type="text/css" href="../css/manage.css" />
		<!-- <script src="../js/navlist.js" charset="utf-8"></script> -->
		<style type="text/css">
			form {
				position: absolute;
				margin-top: 75px;
			}

			form label {
				clear: left;
				float: left;
				margin: 12px;
			}

			form span {
				display: block;
				float: left;
				margin: 12px;
				position: relative;
				left: 10px;
			}

			form .submit {
				clear: left;
				display: block;
				background-color: #F43838;
				height: 25px;
				width: 85px;
				color: #fff;
				margin-top: 140px;
				margin-left: 280px;
				border: 0;
				border-radius: 10px;
			}

			form .submit:hover {
				background-color: #ff3d37;
				cursor: pointer;
			}

			.security-left-nav li:first-child {
				background-color: #ff4e37;
			}

			.security-left-nav li:first-child a {
				color: #fff;
				opacity: 0.9;
			}
			.icon img{
				width: 150px;
			}
		</style>
        <script src="../js/jquery-1.3.1.js"></script>
        <script>

            function hid(num){
                var s = "#div"+num;
                // $("body").style.display="none";
                // $(s).show()//显示 <li>元素对应的<div>元素
                // $(s).siblings().hide();//隐藏其他几个同辈的<div>元素

                $(s).show();
                $(s).siblings().hide();
                    // $("#div2").show();

            }
			
			function change(pos){
				var content=document.getElementsByClassName("catagory-list-nav");
				var items=content[0].getElementsByTagName("li");
				for(var i=0;i<items.length;i++){
					items[i].className="list-nav";
				}
				items[pos].className+=" list-nav-active";
			}
        </script>
	</head>
	<?php
		include "../../conn.php";
		$sql = "select * from recommend";
		$result1 = mysqli_query($conn,$sql)or die("查询推荐表失败".$sql);
		$rows = mysqli_fetch_assoc($result1);
		$hot1 = $rows['top_6_1'];
		$hot2 = $rows['top_6_2'];
		$hot3 = $rows['top_6_3'];
		$hot4 = $rows['top_6_4'];
		$hot5 = $rows['top_6_5'];
		$hot6 = $rows['top_6_6'];
		$ad_screen1 = $rows['ad_screen_1'];
		$ad_screen2 = $rows['ad_screen_2'];
		$ad_screen3 = $rows['ad_screen_3'];
		$ad_screen4 = $rows['ad_screen_4'];
		$ad_screen5 = $rows['ad_screen_5'];
		$new1 = $rows['new_3_1'];
		$new2 = $rows['new_3_2'];
		$new3 = $rows['new_3_3'];
		$bargain1 = $rows['bargain_1'];
		$bargain2 = $rows['bargain_2'];
		$bargain3 = $rows['bargain_3'];
		$bargain4 = $rows['bargain_4'];
		$bargain5 = $rows['bargain_5'];
		$activity1 = $rows['activity_1'];
		$activity2 = $rows['activity_2'];
		$activity3 = $rows['activity_3'];
		$activity4 = $rows['activity_4'];
		$activity5 = $rows['activity_5'];
		$activity6 = $rows['activity_6'];
		$activity7 = $rows['activity_7'];
		$brand1 = $rows['brand_1'];
		$brand2 = $rows['brand_2'];
		$brand3 = $rows['brand_3'];
		$brand4 = $rows['brand_4'];
		$brand5 = $rows['brand_5'];
		$brand6 = $rows['brand_6'];
		$brand7 = $rows['brand_7'];
		$brand8 = $rows['brand_8'];
		$adm = $rows['ad_middle'];
		$adb = $rows['ad_bottom'];

		if($_SERVER["REQUEST_METHOD"]=="POST"){
			if(isset($_POST['submit1'])){
				$hot1 = $_POST["first-hot"];
				$hot2 = $_POST["second-hot"];
				$hot3 = $_POST["third-hot"];
				$hot4 = $_POST["fourth-hot"];
				$hot5 = $_POST["fifth-hot"];
				$hot6 = $_POST["sixth-hot"];
				$sql = "update recommend set top_6_1='$hot1',top_6_2='$hot2',top_6_3='$hot3',top_6_4='$hot4',top_6_5='$hot5',top_6_6='$hot6'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
			if(isset($_POST['submit2'])){
				$ad_screen1 = $_POST["ad_screen1"];
				$ad_screen2 = $_POST["ad_screen2"];
				$ad_screen3 = $_POST["ad_screen3"];
				$ad_screen4 = $_POST["ad_screen4"];
				$ad_screen5 = $_POST["ad_screen5"];
				$sql = "update recommend set ad_screen_1='$ad_screen1',ad_screen_2='$ad_screen2',ad_screen_3='$ad_screen3',ad_screen_4='$ad_screen4',ad_screen_5='$ad_screen5'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
			if(isset($_POST['submit3'])){
				$new1 = $_POST["new1"];
				$new2 = $_POST["new2"];
				$new3 = $_POST["new3"];
				$sql = "update recommend set new_3_1='$new1',new_3_2='$new2',new_3_3='$new3'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
			if(isset($_POST['submit4'])){
				$bargain1 = $_POST['bargain1'];
				$bargain2 = $_POST['bargain2'];
				$bargain3 = $_POST['bargain3'];
				$bargain4 = $_POST['bargain4'];
				$bargain5 = $_POST['bargain5'];
				$sql = "update recommend set bargain_1='$bargain1',bargain_2='$bargain2',bargain_3='$bargain3',bargain_4='$bargain4',bargain_5='$bargain5'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
			if(isset($_POST['submit5'])){
				$activity1 = $_POST['activity1'];
				$activity2 = $_POST['activity2'];
				$activity3 = $_POST['activity3'];
				$activity4 = $_POST['activity4'];
				$activity5 = $_POST['activity5'];
				$activity6 = $_POST['activity6'];
				$activity7 = $_POST['activity7'];
				$sql = "update recommend set activity_1='$activity1',activity_2='$activity2',activity_3='$activity3',activity_4='$activity4',activity_5='$activity5',activity_6='$activity6',activity_7='$activity7'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
			if(isset($_POST['submit6'])){
				$brand1 = $_POST['brand1'];
				$brand2 = $_POST['brand2'];
				$brand3 = $_POST['brand3'];
				$brand4 = $_POST['brand4'];
				$brand5 = $_POST['brand5'];
				$brand6 = $_POST['brand6'];
				$brand7 = $_POST['brand7'];
				$brand8 = $_POST['brand8'];
				$sql = "update recommend set brand_1='$brand1',brand_2='$brand2',brand_3='$brand3',brand_4='$brand4',brand_5='$brand5',brand_6='$brand6',brand_7='$brand7',brand_8='$brand8'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
			if(isset($_POST['submit7'])){
				$adm = $_POST['ad_middle'];
				$adb = $_POST['ad_bottom'];
				$sql = "update recommend set ad_middle='$adm',ad_bottom='$adb'";
				$result = mysqli_query($conn,$sql)or die("修改失败".$sql);
				echo "<script> alert(\"修改成功!\"); </script>";
			}
		}
	?>
	<body>
		<div class="content">
			<div class="icon">
				<img src="../../base_photo/logo_name.png">
			</div>
			<div class="personal-container">
				<div class="security-left">
					<span class="security-left-title">管理员界面</span>
					<ul class="security-left-nav">
						<li><a>商品推荐</a></li>
					</ul>
				</div>
				<div class="security-right">
					<div class="security-right-title">
						<img class="security-right-title-img" src="../img/shop.png">
						<span class="security-right-title-text">商品推荐</span>
					</div>
					<div class="profile-detail">
						<div class="tips-detail">
							<img class="tips-detail-img" src="../img/message3.png">
							<p class="tips-detail-text">
								亲爱的
								<b>管理员</b>
								，请设置相关商品推荐。
							</p>
						</div>
						<div class="catagory-wrapper">
							<div class="catagory-text-container">
								<ul class="catagory-list-nav">
									<li class="list-nav list-nav-active">
										<div class="inner-text">
											<a href="javascript:hid(1);"  onclick="change(0)">热卖榜</a>
										</div>
									</li>
									<li class="list-nav">
										<div class="inner-text">
											<a href="javascript:hid(2);" onclick="change(1)">广告大屏设置</a>
										</div>
									</li>
									<li class="list-nav">
										<div class="inner-text">
											<a href="javascript:hid(3);" onclick="change(2)">新品</a>
										</div>
									</li>
									<li class="list-nav">
										<div class="inner-text">
											<a href="javascript:hid(4);" onclick="change(3)">特价商品</a>
										</div>
									</li>
									<li class="list-nav">
										<div class="inner-text">
											<a href="javascript:hid(5);" onclick="change(4)">活动促销</a>
										</div>
									</li>
									<li class="list-nav">
										<div class="inner-text">
											<a href="javascript:hid(6);" onclick="change(5)">品牌榜</a>
										</div>
									</li>
									<li class="list-nav">
										<div class="inner-text">
											<a href="javascript:hid(7);" onclick="change(6)">广告设置</a>
										</div>
									</li>
								</ul>
							</div>
							<!-- catagory-text-container end -->
							<div  class="nav_box">
								<div  id="div1">
									<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="Hot">
										<p><label>热卖第一名：</label><span><input type="text" name="first-hot" id="first-hot"
													value="<?php echo "$hot1"; ?>" placeholder="热卖第一名" /></span></p>
										<p><label>热卖第二名：</label><span><input type="text" name="second-hot" id=""
													value="<?php echo "$hot2"; ?>" placeholder="热卖第二名" /></span></p>
										<p><label>热卖第三名：</label><span><input type="text" name="third-hot" id=""
													value="<?php echo "$hot3"; ?>" placeholder="热卖第三名" /></span></p>
										<p><label>热卖第四名：</label><span><input type="text" name="fourth-hot" id=""
													value="<?php echo "$hot4"; ?>" placeholder="热卖第四名" /></span></p>
										<p><label>热卖第五名：</label><span><input type="text" name="fifth-hot" id=""
													value="<?php echo "$hot5"; ?>" placeholder="热卖第五名" /></span></p>
										<p><label>热卖第六名：</label><span><input type="text" name="sixth-hot" id=""
													value="<?php echo "$hot6"; ?>" placeholder="热卖第六名" /></span></p>
										<!-- 热卖前六名 -->
										<input class="submit" name="submit1" type="submit" value="修改" />
									</form>
								</div>
								<div class="hide" id="div2">
									<form action="" method="post" id="ads">
										<p><label>广告&nbsp;&nbsp;大屏1：</label><span><input type="text" name="ad_screen1"
													id="" value="<?php echo "$ad_screen1"; ?>" placeholder="广告大屏1" /></span></p>
										<p><label>广告&nbsp;&nbsp;大屏2：</label><span><input type="text" name="ad_screen2"
													id="" value="<?php echo "$ad_screen2"; ?>" placeholder="广告大屏2" /></span></p>
										<p><label>广告&nbsp;&nbsp;大屏3：</label><span><input type="text" name="ad_screen3"
													id="" value="<?php echo "$ad_screen3"; ?>" placeholder="广告大屏3" /></span></p>
										<p><label>广告&nbsp;&nbsp;大屏4：</label><span><input type="text" name="ad_screen4"
													id="" value="<?php echo "$ad_screen4"; ?>" placeholder="广告大屏4" /></span></p>
										<p><label>广告&nbsp;&nbsp;大屏5：</label><span><input type="text" name="ad_screen5"
													id="" value="<?php echo "$ad_screen5"; ?>" placeholder="广告大屏5" /></span></p>
										<!-- 广告大屏 -->
										<input class="submit" name="submit2" type="submit" value="修改" />
									</form>

								</div>
								<div class="hide" id="div3">
									<form action="" method="post">
										<p><label>新&nbsp;&nbsp;&nbsp;品&nbsp;&nbsp;&nbsp; 1&nbsp;：</label><span><input
													type="text" name="new1" id="" value="<?php echo "$new1"; ?>"
													placeholder="新品1" /></span></p>
										<p><label>新&nbsp;&nbsp;&nbsp;品&nbsp;&nbsp;&nbsp; 2&nbsp;：</label><span><input
													type="text" name="new2" id="" value="<?php echo "$new2"; ?>"
													placeholder="新品2" /></span></p>
										<p><label>新&nbsp;&nbsp;&nbsp;品&nbsp;&nbsp;&nbsp; 3&nbsp;：</label><span><input
													type="text" name="new3" id="" value="<?php echo "$new3"; ?>"
													placeholder="新品3" /></span></p>
										<!-- 新品 -->
										<input class="submit" name="submit3" type="submit" value="修改" />
									</form>

								</div>
								<div class="hide" id="div4">
									<form action="" method="post">
										<p><label>特价&nbsp;&nbsp;商品1：</label><span><input type="text" name="bargain1"
													id="" value="<?php echo "$bargain1"; ?>" placeholder="特价商品1" /></span></p>
										<p><label>特价&nbsp;&nbsp;商品2：</label><span><input type="text" name="bargain2"
													id="" value="<?php echo "$bargain2"; ?>" placeholder="特价商品2" /></span></p>
										<p><label>特价&nbsp;&nbsp;商品3：</label><span><input type="text" name="bargain3"
													id="" value="<?php echo "$bargain3"; ?>" placeholder="特价商品3" /></span></p>
										<p><label>特价&nbsp;&nbsp;商品4：</label><span><input type="text" name="bargain4"
													id="" value="<?php echo "$bargain4"; ?>" placeholder="特价商品4" /></span></p>
										<p><label>特价&nbsp;&nbsp;商品5：</label><span><input type="text" name="bargain5"
													id="" value="<?php echo "$bargain5"; ?>" placeholder="特价商品5" /></span></p>
										<!-- 特价商品 -->
										<input class="submit" name="submit4" type="submit" value="修改" />
									</form>

								</div>
								<div class="hide" id="div5">
									<form action="" method="post">
										<p><label>活动&nbsp;&nbsp;促销1：</label><span><input type="text" name="activity1"
													id="" value="<?php echo "$activity1"; ?>" placeholder="活动促销1" /></span></p>
										<p><label>活动&nbsp;&nbsp;促销2：</label><span><input type="text" name="activity2"
													id="" value="<?php echo "$activity2"; ?>" placeholder="活动促销2" /></span></p>
										<p><label>活动&nbsp;&nbsp;促销3：</label><span><input type="text" name="activity3"
													id="" value="<?php echo "$activity3"; ?>" placeholder="活动促销3" /></span></p>
										<p><label>活动&nbsp;&nbsp;促销4：</label><span><input type="text" name="activity4"
													id="" value="<?php echo "$activity4"; ?>" placeholder="活动促销4" /></span></p>
										<p><label>活动&nbsp;&nbsp;促销5：</label><span><input type="text" name="activity5"
													id="" value="<?php echo "$activity5"; ?>" placeholder="活动促销5" /></span></p>
										<p><label>活动&nbsp;&nbsp;促销6：</label><span><input type="text" name="activity6"
													id="" value="<?php echo "$activity6"; ?>" placeholder="活动促销6" /></span></p>
										<p><label>活动&nbsp;&nbsp;促销7：</label><span><input type="text" name="activity7"
													id="" value="<?php echo "$activity7"; ?>" placeholder="活动促销7" /></span></p>
										<!-- 活动促销 -->
										<input class="submit" name="submit5" type="submit" value="修改" />
									</form>

								</div>
								<div class="hide" id="div6">
									<form action="" method="post">
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌1：</label><span><input
													type="text" name="brand1" id="" value="<?php echo "$brand1"; ?>"
													placeholder="品牌1" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌2：</label><span><input
													type="text" name="brand2" id="" value="<?php echo "$brand2"; ?>"
													placeholder="品牌2" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌3：</label><span><input
													type="text" name="brand3" id="" value="<?php echo "$brand3"; ?>"
													placeholder="品牌3" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌4：</label><span><input
													type="text" name="brand4" id="" value="<?php echo "$brand4"; ?>"
													placeholder="品牌4" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌5：</label><span><input
													type="text" name="brand5" id="" value="<?php echo "$brand5"; ?>"
													placeholder="品牌5" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌6：</label><span><input
													type="text" name="brand6" id="" value="<?php echo "$brand6"; ?>"
													placeholder="品牌6" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌7：</label><span><input
													type="text" name="brand7" id="" value="<?php echo "$brand7"; ?>"
													placeholder="品牌7" /></span></p>
										<p><label>品&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;牌8：</label><span><input
													type="text" name="brand8" id="" value="<?php echo "$brand8"; ?>"
													placeholder="品牌8" /></span></p>
										<!-- 品牌 -->
										<input class="submit" name="submit6" type="submit" value="修改" />
									</form>
								</div>
								<div class="hide" id="div7">
									<form action="" method="post">
										<p><label>广告&nbsp;&nbsp; 中部：</label><span><input type="text" name="ad_middle"
													id="" value="<?php echo "$adm"; ?>" placeholder="广告中部" /></span></p>
										<!-- 广告中部 -->
										<p><label>广告&nbsp;&nbsp; 底部：</label><span><input type="text" name="ad_bottom"
													id="" value="<?php echo "$adb"; ?>" placeholder="广告底部" /></span></p>
										<!-- 广告底部 -->
										<input class="submit" name="submit7" type="submit" value="修改" />
									</form>
								</div>
								<!-- </form> -->
							</div>
						</div>
						<!-- profile-detail-end -->
					</div>
					<!-- security-right-end -->
				</div>
				<!-- profile-container-end -->
			</div>
	</body>
</html>
