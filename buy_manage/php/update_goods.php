<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>商品编辑界面</title>
		<link rel="stylesheet" href="../css/base.css"/>
		<link rel="stylesheet" href="../css/manage-goods.css"/>
		<link rel="stylesheet" href="../css/upload-img.css"/>
		<!-- 显示选择的图片 -->
		<style type="text/css">
			body{
				margin: 0px auto;
				padding: 0px;
			}
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
						alert("请选择图片文件！");
						fileTag1.value="";
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
						alert("请选择图片文件！");
						fileTag2.value="";
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
						alert("请选择图片文件！");
						fileTag3.value="";
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
					// 显示图片 结束
				
			};
			
		
		</script>
	</head>
	<body>
		<?php
			include "../../conn.php";
			
			function filterIntput($data){
				$data = trim($data);//去掉不必要的字符（如：空格、tab，换行）
				$data = stripslashes($data);//去掉反斜杠
				$data = htmlspecialchars($data);//把一些定义的字符转换为HTML实体
				return $data;
			}
			
			
			
			//获取要更改商品的信息
			$id = $_GET["goods_id"];
			$sql = "select * from goods_information where goods_id = '$id'";
			$result_goods = mysqli_query($conn,$sql) or die("查询失败".$sql);
			$row_goods = mysqli_fetch_assoc($result_goods);
			
				//size和style处理
				$goods_size = $row_goods["size"];
				//echo $goods_size;
				//$goods_size = substr($goods_size,1,-1);
				$size = explode(';s-i-z-e;',$goods_size);
				
				$goods_style = $row_goods["style"];
				//$goods_style = substr($goods_style,1,-1);
				$style = explode(';s-t-y-l-e;',$goods_style);
						
			
		
			//修改
			$catagoryErr = $idErr = $nameErr = $priceErr = 
			$sizeErr = $emailErr = $styleErr =  $inventoryErr =
			$photo1Err = $photo2Err = $photo3Err =$picErr="";
			
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$catagory = $_POST['catagory'];
				$goods_id = $id;
				$name = $_POST['name'];
				$price = $_POST['goods_price'];
				$price = (double)$price;
				$inventory = $_POST['inventory'];
				$inventory = (int)$inventory;
				//size
				$size_num=0;
				$size_str="";
				if(isset($_POST['size_num'])){
					$size_num = (int)$_POST['size_num'];
				    //$size = ";";
					
				for($i=1;$i<=$size_num;$i++){
					if(empty($_POST["size$i"])){
						$sizeErr="尺码类别信息未填";
						break;
					}
					if($i==$size_num){
						
						$size_str .= $_POST["size$i"];
					}
					else{
						$size_str .= $_POST["size$i"].";s-i-z-e;";
					}
				}
				}
				
				
				//style
				$style_num=0;
				$style_str="";
				if(isset($_POST['style_num'])){
					$style_num = (int)$_POST['style_num'];
					//$style = "";
				for($i=1;$i<=$style_num;$i++){
					if(empty($_POST["style$i"])){
						$styleErr="款式类别信息未填";
						break;
					}
					if($i==$style_num){
						$style_str .= $_POST["style$i"];
					}
					else{
						$style_str .= $_POST["style$i"].";s-t-y-l-e;";
					}
				}
				}
				
				if(empty($catagory)){
					$catagoryErr = "商品类别为空";
				}
				if(empty($goods_id)){
					$idErr = "货号为空";
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
					$size_str = "";
				}else if($size_num<0){
					$sizeErr="尺码类别不能小于0";
				}
				if(empty($style_num)||$style_num==0){
					$style_str="";
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
				if((empty($_FILES["file1"]["name"])&& empty($row_goods['photo1']))
				|| (empty($_FILES["file2"]["name"])&& empty($row_goods['photo2']))
				|| (empty($_FILES["file3"]["name"])&& empty($row_goods['photo3']))){
					$picErr="请上传三张图片";
				}
				if($catagoryErr=='' && $idErr=='' && $nameErr=='' && $priceErr==''
				&& $sizeErr=='' && $emailErr=='' && $styleErr==''&& $inventoryErr==''&& $picErr=='')
				{
					// 移动照片
						$photo1 = $photo2 = $photo3 = "";
						if($_FILES["file1"]["name"]&&$_FILES["file1"]["error"]>0){
							$photo1Err="照片上传失败，错误号：".$_FILES["file1"]["error"];
							echo $photo1Err;
						}
						else if($_FILES["file2"]["name"]&&$_FILES["file2"]["error"]>0){
							$photo2Err="照片上传失败，错误号：".$_FILES["file2"]["error"];
							echo $photo2Err;
						}
						else if($_FILES["file3"]["name"]&&$_FILES["file3"]["error"]>0){
							$photo3Err="照片上传失败，错误号：".$_FILES["file3"]["error"];
							echo $photo3Err;
						}
						else{
							if($_FILES["file1"]["name"]){
								if($row_goods['photo1']){
									$r=explode("http://localhost/test/project/tmp_photo/",$row_goods['photo1'])[1];
									unlink("../../tmp_photo/".$r);
								}
								$photo1_name=uniqid("pic_").".png";
								$photo1="http://localhost/test/project/tmp_photo/".$photo1_name;
								move_uploaded_file($_FILES["file1"]["tmp_name"],"../../tmp_photo/".$photo1_name);
							}
							else{
								$photo1=$row_goods['photo1'];
							}
							if($_FILES["file2"]["name"]){
								if($row_goods['photo2']){
									$r=explode("http://localhost/test/project/tmp_photo/",$row_goods['photo2'])[1];
									unlink("../../tmp_photo/".$r);
								}
								$photo2_name=uniqid("pic_").".png";
								$photo2="http://localhost/test/project/tmp_photo/".$photo2_name;
								move_uploaded_file($_FILES["file2"]["tmp_name"],"../../tmp_photo/".$photo2_name);
							}else{
								$photo2=$row_goods['photo2'];
							}
							if($_FILES["file3"]["name"]){
								if($row_goods['photo3']){
									$r=explode("http://localhost/test/project/tmp_photo/",$row_goods['photo3'])[1];
									unlink("../../tmp_photo/".$r);
								}
								$photo3_name=uniqid("pic_").".png";
								$photo3="http://localhost/test/project/tmp_photo/".$photo3_name;
								move_uploaded_file($_FILES["file3"]["tmp_name"],"../../tmp_photo/".$photo3_name);
							}else{
								$photo3=$row_goods['photo3'];
							}
							
							
							
						}
					
					$sql = "update goods_information set 
					name='$name',
					photo1='$photo1',photo2='$photo2',
					photo3='$photo3',price='$price',
					inventory='$inventory',size='$size_str',
					style='$style_str',catagory = '$catagory',
					goods_from = '".$row_goods['goods_from']."'
					where goods_id='$id' ";
					$result2 = mysqli_query($conn,$sql) or die ("插入失败，请检查sql语句".$sql);
					echo "<script>alert('修改成功！');location='../../personal-center/php/user_main.php?pos=3';</script>";
					
					
				}
			}
			
		?>
		
		<!-- top start -->
		<?php
			session_start();
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
							<select name="catagory" >
								<option value="">===请选择===</option>
								<option value="food" <?php if($row_goods['catagory']=="food")echo " selected";?>>食品</option>
								<option value="clothing" <?php if($row_goods['catagory']=="clothing")echo " selected";?>>服装</option>
								<option value="electronic" <?php if($row_goods['catagory']=="electronic")echo " selected";?>>电子产品</option>
								<option value="home" <?php if($row_goods['catagory']=="home")echo " selected";?>>家居</option>
								<option value="trip" <?php if($row_goods['catagory']=="trip")echo " selected";?>>出行</option>
								<option value="mother_baby" <?php if($row_goods['catagory']=="mother_baby")echo " selected";?>>母婴</option>
								<option value="book" <?php if($row_goods['catagory']=="book")echo " selected";?>>图书</option>
								<option value="beauty" <?php if($row_goods['catagory']=="beauty")echo " selected";?>>美妆</option>
								<option value="health" <?php if($row_goods['catagory']=="health")echo " selected";?>>健康</option>
								<option value="art" <?php if($row_goods['catagory']=="art")echo " selected";?>>艺术</option>
							</select>
						</span>
						<span class="err"><?php echo $catagoryErr;?></span>
					</p>
					
					
					
					<p class="title">
						<label>标题:</label>
						<span>
							<input type="text" name="name" id="" value="<?php echo $row_goods['name'] ?>" />
						</span>
						<span class="err"><?php echo $nameErr;?></span>
					</p>
					
					<p class="price">
						<label>价格:</label>
						<span>
							<input type="number" name="goods_price" id="" value="<?php echo $row_goods['price'] ?>" />
						</span>
						<span class="err"><?php echo $priceErr;?></span>
					</p>
					
					<nav class="size" id="size">
						<label>尺码:</label>
						<span>
							<input type="number" id="num1" class="num" name="size_num" value="<?php if($size[0]!='') echo count($size) ?>"/>&nbsp;类&nbsp;<span class="err"><?php echo $sizeErr;?></span>
						</span>
						<div id="tab1">
							<?php
								for($n=1;$n<=count($size)&&$size[0]!='';$n++){
							?>
							<input type="text" id="" name="<?php echo 'size'.$n?>" value="<?php echo $size[$n-1]?>"/>
							<?php
								}
							?>
						</div>
						
					</nav>
					
					<nav class="style" id="style">
						<label>颜色/款式:</label>
						<span>
							<input type="number" id="num2" class="num" name="style_num" value="<?php if($style[0]!='') echo count($style) ?>"/>&nbsp;类&nbsp;<span class="err"><?php echo $styleErr;?></span>
						</span>
						<div id="tab2">
							<?php
								for($m=1;$m<=count($style)&&$style[0]!='';$m++){
							?>
							<input type="text" id="" name="<?php echo 'style'.$m?>" value="<?php echo $style[$m-1]?>"/>
							<?php
								}
							?>
						</div>
						
						
					</nav>
					
					<p>
						<label>库存:</label>
						<span>
							<input type="number" name="inventory" class="num" value="<?php echo $row_goods['inventory'] ?>" />
						</span>
						<span class="err"><?php echo $inventoryErr;?></span>
					</p>
					
					<p class="photo">
						<label>商品图片:</label><span class="err"><?php echo $picErr;?></span>
						<span class="err"><?php echo $picErr?></span>
						<div class="upload">
							<label for="file1" class="upload-img">
								<i></i>
								<span>选择图片</span>
								<img src="<?php if(empty($row_goods['photo1']))echo '../../personal-center/img/upload4.png';else echo $row_goods['photo1']; ?>" id="img1" >
								<input type="file" name="file1" id="file1" value="<?php echo $row_goods['photo1'];?>" accept="" />
							</label>
						</div>
						<div class="upload">
							<label for="file2" class="upload-img">
								<i></i>
								<span>选择图片</span>
								<img src="<?php if(empty($row_goods['photo2']))echo '../../personal-center/img/upload4.png';else echo $row_goods['photo2']; ?>" id="img2" >
								<input type="file" name="file2" id="file2" value="<?php echo $row_goods['photo2'];?>" accept="" />
							</label>
						</div>
						<div class="upload">
							<label for="file3" class="upload-img">
								<i></i>
								<span>选择图片</span>
								<img src="<?php if(empty($row_goods['photo3']))echo '../../personal-center/img/upload4.png';else echo $row_goods['photo3']; ?>" id="img3" >
								<input type="file" name="file3" id="file3" value="<?php echo $row_goods['photo3'];?>" accept=""/>
							</label>
						</div>
					</p>
					
					<p class="btn">
						<input type="submit" name="" class="buy_btn" value="保存" />
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