<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>发布界面</title>
		<link rel="stylesheet" href="../css/base.css"/>
		<link rel="stylesheet" href="../css/manage-goods.css"/>
		<link rel="stylesheet" href="../css/upload-img.css"/>
		<style type="text/css">
			.upload{
				display: block;
				float: left;
			}
			.err{
				color: #FF0000 !important;
				font-size: 13px !important;
				font-style: italic !important;
			}
		</style>
		<!-- 显示选择的图片 -->
		
		<script type="text/javascript">
			// 显示图片
			window.onload = function() {
				//size部分
				var size = document.getElementById("num1");
				size.onchange = function(){
					var size_num = size.value;
					document.getElementById('tab1').innerHTML="";
					for(var i=1;i<=size_num;i++){
						document.getElementById('tab1').innerHTML+="   <input type ='text' name ='size"+i+"' />";
					};
				};
				
				//style部分
				var style= document.getElementById("num2");
				style.onchange = function(){
					var style_num = style.value;
					document.getElementById('tab2').innerHTML="";
					for(var i=1;i<=style_num;i++){
						document.getElementById('tab2').innerHTML+="   <input type ='text' name ='style"+i+"' />";
					};
				};
				
				var fileTag1 = document.getElementById('file1');
				fileTag1.onchange = function(){
					var file = fileTag1.files[0];//获得用户选择的文件
					if(!/image\/\w+/.test(file.type)){
						fileTag1.value="";
						alert("请选择图片文件！");
						return false;
					}
					var fileReader = new FileReader();
					fileReader.onloadend = function(){
						if (fileReader.readyState == fileReader.DONE){
							document.getElementById('img1').setAttribute('src',fileReader.result);
						}
					};
					fileReader.readAsDataURL(file);
				};
				
				var fileTag2 = document.getElementById('file2');
				fileTag2.onchange = function(){
					var file = fileTag2.files[0];//获得用户选择的文件
					if(!/image\/\w+/.test(file.type)){
						fileTag2.value="";
						alert("请选择图片文件！");
						return false;
					}
					var fileReader = new FileReader();
					fileReader.onloadend = function(){
						if (fileReader.readyState == fileReader.DONE){
							document.getElementById('img2').setAttribute('src',fileReader.result);
						}
					};
					fileReader.readAsDataURL(file);
				};
				var fileTag3 = document.getElementById('file3');
				fileTag3.onchange = function(){
					var file = fileTag3.files[0];//获得用户选择的文件
					if(!/image\/\w+/.test(file.type)){
						fileTag3.value="";
						alert("请选择图片文件！");
						return false;
					}
					var fileReader = new FileReader();
					fileReader.onloadend = function(){
						if (fileReader.readyState == fileReader.DONE){
							document.getElementById('img3').setAttribute('src',fileReader.result);
						}
					};
					fileReader.readAsDataURL(file);
				};
				//显示图片 结束
				
				
			}
		
		</script>
	</head>
	<body>
		<?php
			include "../../conn.php";
			
			// 获取店铺名称
			session_start();
			$goods_from=$_SESSION['user'];
			// $goods_from = $_GET["goods_from"];
			
			$catagoryErr = $idErr = $nameErr = $priceErr = 
			$sizeErr = $emailErr = $styleErr =  $inventoryErr =
			$photo1Err = $photo2Err = $photo3Err =$picErr="";
			
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				
				$catagory = $_POST['catagory'];
				$goods_id = $_POST['goods_id'];
				$name = $_POST['name'];
				$price = $_POST['goods_price'];
				$price = (double)$price;
				$inventory = $_POST['inventory'];
				$inventory = (int)$inventory;
				
				//size
				$size_num = $_POST['size_num'];
				$size = "";
				for($i=1;$i<=$size_num;$i++){
					if(empty($_POST["size$i"])){
						$sizeErr="尺码类别信息未填";
						break;
					}
					if($i==$size_num){
						$size =$size.$_POST["size$i"];
					}
					else{
						$size =$size.$_POST["size$i"].";s-i-z-e;";
						
					}
				}

				//style
				$style_num = $_POST['style_num'];
				$style = "";
				for($i=1;$i<=$style_num;$i++){
					if(empty($_POST["style$i"])){
						$styleErr="款式类别信息未填";
						break;
					}
					if($i==$style_num){
						$style =$style.$_POST["style$i"];
					}
					else{
						$style =$style.$_POST["style$i"].";s-t-y-l-e;";
					}
				}
				
				if(empty($catagory)){
					$catagoryErr = "商品类别为空";
				}
				if(empty($name)){
					$nameErr = "标题为空";
				}
				if(empty($price)){
					$priceErr = "价格为空";
				}else{
					if($price<0){
						$priceErr="价格不能小于0";
					}
				}
				if(empty($size_num)||$size_num==0){
					$size = "";
				}else if($size_num<0){
					$sizeErr="尺码类别不能小于0";
				}
				if(empty($style_num)||$style_num==0){
					$style="";
				}else if($style_num<0){
					$styleErr="款式类别不能小于0";
				}
				if(empty($inventory)){
					$inventoryErr="库存为空";
				}else{
					if($inventory<0){
						$inventoryErr="库存不能小于0";
					}
				}
				if(empty($_FILES["file1"]["name"])
				|| empty($_FILES["file2"]["name"]) 
				|| empty($_FILES["file3"]["name"])){
					$picErr="请上传三张图片";
				}
				if($catagoryErr=='' && $nameErr=='' && $priceErr==''
				&& $sizeErr=='' && $emailErr=='' && $styleErr==''&& $inventoryErr=='' && $picErr=='')
				{
					// 移动照片
					$photo1 = $photo2 = $photo3 = "";
					if(!empty($_FILES["file1"]) 
					&& !empty($_FILES["file2"]) 
					&& !empty($_FILES["file3"]))
					{
						if($_FILES["file1"]["error"]>0){
							$photoErr="照片上传失败，错误号：".$_FILES["file1"]["error"];
							echo $photo1Err;
						}
						if($_FILES["file2"]["error"]>0){
							$photoErr="照片上传失败，错误号：".$_FILES["file2"]["error"];
							echo $photo2Err;
						}
						if($_FILES["file3"]["error"]>0){
							$photoErr="照片上传失败，错误号：".$_FILES["file3"]["error"];
							echo $photo3Err;
						}
						else{
							$photo1_name=uniqid("pic_").".png";
							$photo1="http://localhost/test/project/tmp_photo/".$photo1_name;
							move_uploaded_file($_FILES["file1"]["tmp_name"],"../../tmp_photo/".$photo1_name);
							
							$photo2_name=uniqid("pic_").".png";
							$photo2="http://localhost/test/project/tmp_photo/".$photo2_name;
							move_uploaded_file($_FILES["file2"]["tmp_name"],"../../tmp_photo/".$photo2_name);
							
							$photo3_name=uniqid("pic_").".png";
							$photo3="http://localhost/test/project/tmp_photo/".$photo3_name;
							move_uploaded_file($_FILES["file3"]["tmp_name"],"../../tmp_photo/".$photo3_name);
							
							//echo $photo3;
						}
					}
					
					$sql = "insert into goods_information(goods_id,name,photo1,photo2,photo3,price,inventory,size,style,catagory,goods_from)
					 values('$goods_id','$name','$photo1','$photo2','$photo3','$price','$inventory','$size','$style','$catagory','$goods_from')";
					$result = mysqli_query($conn,$sql) or die ("插入失败，请检查sql语句".$sql);
					echo "<script>";
					echo "alert('发布成功！');";
					echo "location='../../personal-center/php/user_main.php?pos=3'";
					echo "</script>";
				}
			}
			
		?>
		
		<!-- top start -->
		<?php
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
		</div>
		<!-- head end -->
		
		
		<!-- body start -->
		<div class="body_head">
			<h2>编辑商品信息</h2>
		</div>
		<div class="body">
			<!--  -->
			<div class="left">
				<div class="pic">
					<img src="" >
				</div>
			</div>
			
			<!--  -->
			<div class="center">
				<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
					
					<p class="catagory">
						<label>分类:</label>
						<span>
							<select name="catagory">
								<option value="">===请选择===</option>
								<option value="food">食品</option>
								<option value="clothing">服装</option>
								<option value="electronic">电子产品</option>
								<option value="home">家居</option>
								<option value="trip">出行</option>
								<option value="mother_baby">母婴</option>
								<option value="book">图书</option>
								<option value="beauty">美妆</option>
								<option value="health">健康</option>
								<option value="art">艺术</option>
							</select>
						</span>
						<span class="err"><?php echo $catagoryErr?></span>
						
					</p>
					
					<input type="hidden" name="goods_id" id="" value="<?php echo uniqid("id_");?>" />
					
					<p class="title">
						<label>标题:</label>
						<span>
							<input type="text" name="name" id="" placeholder="建议您使用通俗的产品名称,突出商品特性,请勿使用违规词汇" />
						</span>
						<span class="err"><?php echo $nameErr?></span>
						
					</p>
					
					<p class="price">
						<label>价格:</label>
						<span>
							<input type="number" name="goods_price" id="" value="" />
						</span>
						<span class="err"><?php echo $priceErr?></span>
						
					</p>
					
					<nav class="size" id="size">
						<label>尺码:</label>
						<span>
							<input type="number" id="num1" class="num" name="size_num" pattern="^[1-9]\d*|0$"/>&nbsp;类&nbsp;
						</span>
						<span class="err"><?php echo $sizeErr?></span>
						<div id="tab1">
							<!-- <input type="text" id="" name="" /> -->
						</div>
						
						
					</nav>
					
					<nav class="style">
						<label>颜色/款式:</label>
						<span>
							<input type="number" id="num2" class="num" name="style_num" pattern="^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$"/>&nbsp;类&nbsp;
						</span>
						<span class="err"><?php echo $styleErr?></span>
						<div id="tab2">
						
						</div>
						
						
					</nav>
					
					<p>
						<label>库存:</label>
						<span>
							<input type="number" name="inventory" class="num" value=""/>&nbsp;件&nbsp;
						</span>
						<span class="err"><?php echo $inventoryErr?></span>
						
					</p>
					
					<p class="photo" style="display: block;">
						<label>商品图片:</label>
						<span class="err"><?php echo $picErr?></span>
						<div class="upload">
							<label for="file1" class="upload-img">
								<i></i>
								<span>选择图片</span>
								<img src="../../personal-center/img/upload4.png" id="img1" >
								<input type="file" name="file1" id="file1" value="" accept="" />
							</label>
						</div>
						<div class="upload">
							<label for="file2" class="upload-img">
								<i></i>
								<span>选择图片</span>
								<img src="../../personal-center/img/upload4.png" id="img2" >
								<input type="file" name="file2" id="file2" value="" accept="" />
							</label>
						</div>
						<div class="upload">
							<label for="file3" class="upload-img">
								<i></i>
								<span>选择图片</span>
								<img src="../../personal-center/img/upload4.png" id="img3" >
								<input type="file" name="file3" id="file3" value="" accept=""/>
							</label>
						</div>
						
						
						<!-- <span><input type="file" name="file1" id="file1" value="" /></span>
						<span><input type="file" name="file2" id="file2" value="" /></span>
						<span><input type="file" name="file3" id="file3" value="" /></span> -->
						<!-- <ul>
							<li><img id="img1" src="" >+</li>
							<li><img id="img2" src="" >+</li>
							<li><img id="img3" src="" >+</li>
						</ul> -->
					</p>
					
					<p class="btn">
						<input type="submit" name="" class="buy_btn" value="发布" />
						<!-- <a href="#" class="add_cart">预览</a> -->
					</p>
				</form>
				
			</div>
			
		</div>
		<!-- body end -->
		
		<!-- bottom start -->
		<?php
			include "../../bottom.php";
		?>
		<!-- bottom end -->
	</body>
</html>