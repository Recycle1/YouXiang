<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css">
			/*清除元素默认的内外边距  */
			*{
			    margin: 0;
			    padding: 0
			}
			
			/*去掉列表前面的小点*/
			.shortcut li {
			    list-style: none;
			}
			/*取消链接的下划线*/
			.shortcut a {
			    color: #666;
			    text-decoration: none;
			}
			
			.shortcut a:hover {
			    color: #e33333;
			}
			
			.shortcut{
			    font: 12px/1.5 'Microsoft YaHei', 'Heiti SC', tahoma, arial, 'Hiragino Sans GB', \\5B8B\4F53, sans-serif;
			    color: #666;
			}
			
			/*公共样式*/
			.fl{
				float: left;
			}
			.fl li{
				display:inline;
			}
			.fr{
				float: right;
			}
			 .w{
			 	width: 1200px;
			 	margin: 0 auto;
			 }
			 .shortcut{
			 	height: 31px;
			 	background-color: #f1f1f1;
			 	line-height: 31px;
			 
			 }
			 .shortcut li{
			 	float: left;
			 }
			 .spacer{
			 	width: 1px;
			 	height: 12px;
			 	background-color: #666;
			 	margin: 9px 12px 0;
			 }
			
			
			
		</style>
<!-- 		<link rel="stylesheet" type="text/css" href="http://localhost/test/project/main/css/base.css"> -->
		<!-- <link rel="stylesheet" type="text/css" href="http://localhost/test/project/main/css/common.css"> -->
	</head>
	<body>
		<div class="shortcut">
		    <div class="w">
		        <div class="fl">
		            <ul>
		                <li><?php 
						if(session_status() !==PHP_SESSION_ACTIVE){
							session_start();
						}
						if(isset($_SESSION['user']))echo $_SESSION['user'];?>&nbsp;欢迎您！</li>
		                <li>
							<?php
								if(empty($_SESSION["user"]))
								echo "<a href=\"http://localhost/test/project/login_register/login.php\">请登录</a>
										<a href=\"http://localhost/test/project/login_register/reg.php\" class=\"style-red\">立即注册</a>";
							?>
		                </li>
		            </ul>
		        </div>
		        <div class="fr">
		            <ul>
						<?php
							if(!empty($_SESSION["user"])){
								echo "<li>
										<a href=\"http://localhost/test/project/main/allindex.php\">首页</a>
									</li>
									<li class=\"spacer\"></li>
									<li>
										<a href=\"http://localhost/test/project/personal-center/php/user_main.php?pos=2\">我的购物车</a>
									</li>
									<li class=\"spacer\"></li>
									<li>
										<a href=\"http://localhost/test/project/personal-center/php/user_main.php\">个人中心</a>
									</li>
									<li class=\"spacer\"></li>
									<li>
										<a href=\"http://localhost/test/project/login_register/exit.php\" target=\"_top\">退出登录</a>
									</li>";
							}
						?>
		            </ul>
		        </div>
		    </div>
		</div>
	</body>
</html>
