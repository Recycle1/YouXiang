<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="../css/personal-base.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-header.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-content.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-footer.css" />
		<style type="text/css">
			.profile-detail{
				padding: 0px 25px;
			}
		</style>
		<script src="../js/upload-img.js" type="text/javascript" charset="utf-8"></script>
		
	</head>
	<body>
		<?php
			include "conn.php";
			//$username为待修改的用户名
			//$username2为修改好的用户名
			session_start();
			$username = $_SESSION['user'];
			$sql = "select * from user where username='$username'";
			$result = mysqli_query($conn,$sql)or die("数据查询失败".$sql);
			$row = mysqli_fetch_assoc($result);
		
			//定义错误提示变量
			$nameErr = $pwdErr = $telErr = $photoErr = "";
			function filterInput($data){
				$data = trim($data);//不必要的字符（如：空格、tab、换行）
				$data = stripslashes($data);//去除反斜杠
				$data = htmlspecialchars($data);//把一些预定义的字符转换为HTML实体
				return $data;
			}
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				//获得各表单项的值
				$username2 = $_POST["username"];
				$password = $_POST["password"];
				$tel = $_POST["tel"];
				$answer = $_POST["passanswer"];
				$gender = $_POST["usergender"];
				//设置必填项
				if(empty($username2)){
					$nameErr="用户名为空";
				}
				if(empty($password)){
					$pwdErr="密码为空";
				}
				filterInput($username2);
				if(!(empty($telephone))){
					if(!(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$telephone))){
						$telephoneErr="电话号码不规范";
					}
				}
				if(($nameErr=='')&&($pwdErr=='')&&($telErr=='')){
					//判断用户名是否重复
					$sql = "select * from user where username='$username2' and username<>'$username'";
					$result1 = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result1)>0){
						$nameErr="用户名重复";
					}
					else{
						//移动文件到指定位置
						$photo="";//照片路径及文件名设置为空串
						if(!(empty($_FILES["file"]["name"])))
						{
							if($_FILES["file"]["error"]>0){
								$photoErr="照片上传失败，错误号：".$_FILES["file"]["error"];
							}
							else{
								if(!empty($row["photo"])){
									$r=explode("http://localhost/test/project/user_photo/",$row['photo'])[1];
									echo $r;
									unlink("../../user_photo/".$r);
								}
								$photo_name=uniqid("user_").".png";
								$photo="http://localhost/test/project/user_photo/".$photo_name;
								move_uploaded_file($_FILES["file"]["tmp_name"],"../../user_photo/".$photo_name);
							}
						}
						else if(empty($_FILES["file"]["name"])){
							$photo=$row['photo'];
						}
						$sql2="select username from user";
						$result2=mysqli_query($conn,$sql2);
						$flag=0;
						while($row2=mysqli_fetch_assoc($result2)){
							if($row2['username']==$username2 && $row2['username']!=$username){
								echo "<script>alert('用户名已被注册');</script>";
								$flag=1;
								break;
							}
						}
						if($flag==0){
							$sql = "update user set username='$username2',password='$password',tel='$tel',gender='$gender',photo='$photo',answer='$answer' where username='$username'";
							$result2 = mysqli_query($conn,$sql)or die("修改失败".$sql);
							$_SESSION['user']=$username2;
							$_SESSION['password']=$password;
							echo "<script>";
							echo "alert('修改成功');location='user_main.php';";
							echo "</script>";
						}
						
					}
				}
			}
		?>
		<div class="security-right-title">
				<img class="security-right-title-img" src="../img/message2.png">
				<span class="security-right-title-text">我的信息</span>
			</div>
			<div class="profile-detail">
				<div class="tips-detail">
					<img class="tips-detail-img" src="../img/message3.png">
					<p class="tips-detail-text">
						亲爱的
						<b><?php echo "$username"; ?></b>
						填写真实的资料，有助于好友找到你哦。
					</p>
				</div>
				<form id="baseInfo" name="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
					<p>
						<label>当前头像:</label>
						<span class="pic-box">
							<a class="pic">
								<img id="img" src="<?php if(empty($row["photo"])) echo "../img/head-icon.png"; else echo $row["photo"]; ?>" />
							</a>
							<input type="file" name="file" id="file_input" value="" accept="" />
						</span>
					</p>
					<p>
						<label>用户名:
							<em>*</em>
						</label>
						<input id="user-name" class="u-text" type="text" name="username" value="<?php echo $row["username"] ?>" />
						<!-- 显示 -->
						<span class="error"><?php echo $nameErr; ?></span>
					</p>
					<p>
						<label>密码:
							<em>*</em>
						</label>
						<input id="password" class="u-text" type="password" name="password" value="<?php echo $row["password"] ?>" />
						<!-- 显示 -->
						<span class="error"><?php echo $pwdErr; ?></span>
					</p>
					<p>
						<label>电话:</label>
						<input id="tel" class="u-text" type="tel" name="tel" value="<?php echo $row["tel"] ?>" />
						<!-- 显示 -->
						<span class="error"><?php echo $telErr; ?></span>
					</p>
					<p>
						<label>密保答案:</label>
						<input id="pass-answer" class="u-text" type="text" name="passanswer" value="<?php echo $row["answer"] ?>" />
						<!-- 显示 -->
					</p>
					<p>
						<label>性别:
							<!-- <em>*</em> -->
						</label>
						<label for="gender1" class="except">
							<input id="usergender" type="radio" name="usergender" value="男" <?php
			if($row['gender']=='男') echo "checked";
		?> />
							男
						</label>
						<label for="gender2" class="except">
							<input id="usergender" type="radio" name="usergender" value="女" <?php
			if($row['gender']=='女') echo "checked";
		?> />
							女
						</label>
					</p>
					<input id="submit" type="submit" value="保存" />
				</form>
				<!-- 表单结束 -->
			</div>
	</body>
</html>
