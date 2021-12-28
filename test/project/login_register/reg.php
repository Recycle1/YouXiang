<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册界面</title>
		<link href="css/upload-img.css" rel="stylesheet">
		<style type="text/css">
		body{
			background:url(back.jpg) no-repeat;
			background-size: 100% 100%;
			background-attachment: fixed;
		}
		#register{
			height: 550px;
			width:  350px;
			border-radius: 40px;
			padding-top: 20px;
			padding-left: 40px;
			line-height: 15px;
			font-size: 10px;
			background-color:antiquewhite;
			margin: 15px auto;
		}
		#div1{
			margin-top: 10px; 
			margin-left: 120px;
		}
		#div2{
			margin-top: 10px;
			margin-left: 30px;
		}
		#div3{
			margin-top: 10px;
			margin-left: 42px;
		}
		#div4{
			margin-top: 10px;
			margin-left: 95px;
		}
		h1{
			padding-top: 20px;
			font-size: 40px;
			
		}
		h2{
			font-size: 10px;
			color: #8C9299;
		}
		span{
			color: #F00;
			font-size: 6px;
		}
		.button{
			width: 245px;
			height: 35px;
			text-align: center;
			margin: 25px 0px;
			font-size: 14px;
			font-weight: 500;
			color: #FFFFFF;
			background-color: #f24349;
			border: 0px;
		}
		.button:hover{
			background-color: #FF6700;
		}
		</style>
		
		<script type="text/javascript">
		    window.onload = function () {
		        var fileTag = document.getElementById('file_input');
		        fileTag.onchange = function () {
		            var file = fileTag.files[0];
					if(!/image\/\w+/.test(file.type)){
						fileTag.value="";
						alert("请选择图片文件！");
						return false;
					}
		            var fileReader = new FileReader();
		            fileReader.onloadend = function () {
		                if (fileReader.readyState == fileReader.DONE) {
		                    document.getElementById('img').setAttribute('src', fileReader.result);
		                }
		            };
		            fileReader.readAsDataURL(file);
				};
		    };
		
		</script>
	</head>
	<body>
		<?php
			include "../conn.php";
			//过滤字符函数
			function filterInput($data){
				$data = trim($data);//不必要的字符
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			$nameErr="";
			$passErr="";
			$genderErr="";
			$telErr="";
			$questionErr="";
			$identityErr="";
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$user_name=$_POST["user_name"];
				$user_pass=$_POST["user_pass"];
				$user_gender=$_POST["sex"];
				$user_tel=$_POST["user_tel"];
				$user_question=$_POST["user_question"];
				$identity=$_POST["cust"];
		
				//过滤字符 
				$user_name=filterInput($user_name);
				$user_pass=filterInput($user_pass);
				$user_tel=filterInput($user_tel);
				$user_question=filterInput($user_question);
				if(empty($user_name)){
					$nameErr="用户名为空";
				}
				if(empty($user_pass)){
					$passErr="密码为空";
				}
				if(empty($user_tel)){
					$telErr="电话号码为空";
				}
				if(empty($user_question)){
					$questionErr="密保为空";
				}
		
				if($nameErr=='' and $passErr=='' and $telErr=='' and $questionErr==''){
					//$conn=mysqli_connect("localhost","root","","student") or die("数据库连接失败");
					$sql="select * from user where username='$user_name' ";
		
					$result=mysqli_query($conn,$sql) or die("查询失败，请检查sql语法".$sql);
					if (mysqli_num_rows($result)>0){
						echo "<script language='JavaScript' type='text/javascript'>";
						echo "alert('用户已经注册，请设置其他用户名');";
						echo "location.href='reg.php';";
						echo "</script>";
					}
					else
					{
						if(isset($_FILES['file']['name'])){
							$photo_name=uniqid("user_").".png";
							$photo="http://localhost/test/project/user_photo/".$photo_name;
							move_uploaded_file($_FILES["file"]["tmp_name"],"../user_photo/".$photo_name);
						}
			
						$sql="insert into user(username,password,gender,tel,answer,photo,identity) values('$user_name','$user_pass','$user_gender','$user_tel','$user_question','$photo','$identity')";
						$result=mysqli_query($conn,$sql) or die("插入失败，语法错误".$sql);
						echo "<script language='JavaScript' type='text/javascript'>";
						echo "alert('用户注册成功');";
						echo "location.href='login.php';";
						echo "</script>";
					}
				}
			}
		?>
		<div id="register">
			<form name="reg" method="post" action="<?php $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
			<h1>欢迎注册</h1>
			<h2>已有账号？<a href="login.php">登录</a></h2>
			<div>
				<div id="upload-img">
					<label for="file_input" class="upload-img">
						<i></i>
						<span>选择图片</span>
						<img src="../base_photo/default_user.png" id="img" >
						<input type="file" name="file" id="file_input" value="" accept="" />
					</label>
				</div>
			</div>
			
			<div id="div2">
				用户名：<input type="text" name="user_name" /><span><?php echo $nameErr; ?></span>
			</div>
			
			<div id="div3">				
				密码：</td><td><input type="password" name="user_pass" /><span><?php echo $passErr; ?></span>
			</div>
			
			<div id="div4">
				<input type="radio" name="sex" value="男" checked>男 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="sex" value="女">女
			</div>	
			
			<div id="div3">
				电话：<input type="text" name="user_tel" /><span><?php echo $telErr; ?></span>
			</div>
				
			<div id="div3">
				密保：请输入你最喜欢的动漫人物
			</div>
				
			<div id="div3">
				答案：<input type="text" name="user_question" /><span><?php echo $questionErr; ?></span>
			</div>
				
			<div id="div4">
				<input type="radio" name="cust" value="1" checked>买家 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="cust" value="2">卖家
			</div>
				
			<div id="div3">
				<input type="submit" name="" class="button" value="注册" />
			</div>
			
			</form>
		</div>
	</body>
</html>
