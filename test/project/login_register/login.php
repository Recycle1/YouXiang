<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>登录系统</title>
		<script src="../main/js/jquery-1.3.1.js"></script>
		<script type="text/javascript">
			function an(){
				var user_name=document.getElementById('user_name');
				var user_pass=document.getElementById('user_pass');
				var authcode=document.getElementById('authcode');
				if(user_name.value==''){
					alert("请输入用户名");
					return false;
				}
				else if(user_pass.value==''){
					alert("请输入密码");
					return false;
				}
				else if(authcode.value==''){
					alert("请输入验证码");
					return false;
				}
			}
			function refresh(){
				var img=document.getElementById("img_yzm");
				img.src="./yzm.php?r=<?php echo rand();?>";
			}
		</script>
		<style type="text/css">
			body{
				width: 100%;
				min-width: 1280px;
				height: 680px;
			}
			video{
				position: fixed;
				right:0;
				bottom: 0;
				min-width: 100%;
				min-height: 100%;
				width: auto;
				height: auto;
				z-index: -9999;
			}
			h1{
				width: 140px;
				margin: 20px auto;
				color: #FFFFFF;
				background-color: #F24349;
				border-radius: 20px;
			}
			.header1 {
				margin-top: 3px;
				text-align: center;
				font-family: "宋体";
				font-size: 20px;
			}
		
			/* 左侧栏 */
			.leftcolumn {
				float: left;
				width: 100px;
				padding-top: 50px;
			}
		 
			/* 右侧栏 */
			.rightcolumn {
				background-color:	#F5FFFA;
				float: right;
				margin-top: 50px;
				margin-right: 100px;
				padding: 35px 15px 12px 25px;
				opacity: 0.8;
				border-radius: 20px;
				background-position: left bottom;
				height: 230px;
				width: 350px;
			}
			a:link{
				text-decoration: none;
			}
			.label{
				text-align: center;
			}
			.text{
				height: 22px;
				width: 155px;
			}
			img{
				border: 0px;
				margin: 0px;
				box-sizing: border-box;
				height: 28px;
				width: 90px;
				float: left;
			}
			table{
				margin: 20px auto;
				padding: 0px;
			}
			.input{
				line-height: 30px;
			}
			.button{
				width: 245px;
				height: 35px;
				text-align: center;
				margin: 25px 0px 2px 30px;
				font-size: 14px;
				font-weight: 500;
				color: #FFFFFF;
				background-color: #f24349;
				border: 0px;
			}
			.button:hover{
				background-color: #FF6700;
			}
			.register{
				margin-right: 50px;
				font-size: 14px;
			}
		</style>
	</head>
	<body>
        <div class="header1">
			<h1>悠享购</h1>
		</div>
		<video id="v1" autoplay  loop muted style="width: 100%">
		    <source  src="./video/back.mp4">
		</video>
		<div class="leftcolumn"></div>
		<div class="rightcolumn">
			<form name="login" method="post" action="check.php" onsubmit="return an()">
				<table>
				<tr class="input"><td class="label">用户名：</td><td><input class="text" type="text" name="user_name" id="user_name"/></td></tr>
				<tr class="input"><td class="label">密码：</td><td><input class="text" type="password" name="user_pass" id="user_pass"/></td></tr>
				
				
				<tr class="input"><td class="label">验证码：</td><td><input class="text" type="text" name="authcode" value="" id="authcode"/></td>
				<td><img id="img_yzm" src="./yzm.php?r=<?php echo rand();?>" onclick="refresh()"></td></tr>
				
				<tr><td colspan="3"><input class="button" type="submit" name="" id="submit" value="登 录"/></td></tr>
				<tr><td align="left"><a style="margin-left: 15px; font-size: 14px;" href="find.php">找回密码</a></td><td align="right" colspan="3"><a class="register" href="reg.php">立即注册</a></td></tr>
				
				</table>
			</form>
		</div>
	</body>
</html>
