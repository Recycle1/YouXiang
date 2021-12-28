<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>付款页面</title>
		<style type="text/css">
			body{
				background-color: #DFDFDF;
			}
			.zong{
				width: 25%;
				background-color: #ffffff;
				padding: 20px 50px;
				margin: 0px auto;
				margin-top: 80px;
			}
			.zong img{
				width: 20px;
				margin-right: 5px;
				float: left;
			}
			table{
				height:300px;
				padding-left: 25px;
			}
			.big{
				width:100px ;
			}
			.fangshi{
				text-align: center !important;
			}
			#button{
				width: 90px;
				height: 40px;
				background-color: #00CCFF;
				border: #CCCCCC solid 2px;
				color: #000033;
				font-weight: bold;
				margin-left: 110px;
			}
			#button:hover{
				background-color: #00A0E9;
			}
		</style>
	</head>
	<body>	
			
		<div class="zong">
			<p>请选择支付方式：</p>
			<div class="fangshi">
				<form action="" method="">
					<table>
						<tr>
						<td><input type="radio" name="fang"/></td>
						<td><img src="image/yue.jpg" class="gai"/>账户余额</td>
					</tr>
					<tr>
						<td><input type="radio" name="fang"/></td>
						<td>
							<img src="image/zhifubao.jpg"/>支付宝</td>
					</tr>
					<tr>
						<td><input type="radio" name="fang"/></td>
						<td><img src="image/weixin.png" class="gai"/>微信支付</td>
					</tr>
					<tr>
						<td><input type="radio" name="fang"/></td>
						<td><img src="image/gongshang.jpg" class="gai"/>中国工商银行</td>
					</tr>
					
					
				</table>
				</form>
			</div>
			输入登录密码：
			<?php
				// session_start();
				include 'conn.php';
				if($_GET){
				
					// if(isset($_GET["click"])){
					// 	if($_GET["click"]=='yes'){
						
					// 		$str = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
					// 		echo"<script>alert('支付成功!'+'您的订单号为:'+$str);</script>";
					// 		// $money = $_SESSION["money"];
					// 		// $photo = 
					// 		// $sql = "insert into order_form(order_id,name,photo,price,quantity,buy_username,sell_username,time) values ('$str','$name','$photo','$price','$quantity','$buy_username','$sell_username','$time')";
					// 	}
					// }
					// else{
						session_start();
						$order = $_GET["order"];
						$address=$_GET["address"];
						$tel=$_GET["tel"];
						$order_arr=explode("o-r-d-e-r",$order);
					// }
				
				}
			?>
		<input type="text" id="password" />
		<p><input type="submit" value="确认付款" id="button" onclick="pay()"/></p>
		
			<!-- <form action="fukuan.php?click=yes" method="post"> 
				<input type="text" />
			    <input type="submit" value="确认付款" id="button"/>
			</form> -->
		</div>
		<script>
			function pay(){
				var items=document.getElementsByName("fang")
				var flag=0;
				for(var i=0;i<items.length;i++){
					if(items[i].checked==true){
						flag=1;
						break;
					}
				}
				if(flag==0){
					alert("请选择支付方式");
				}
				else{
					var password=document.getElementById("password").value;
					if(password==""){
						alert("请输入密码");
					}
					else if(<?php echo "password=='".$_SESSION['password']."'";?>){
						<?php
							for($i=0;$i<count($order_arr);$i++){
								$sql="update order_form set status=1,address='$address',tel='$tel' where order_id='$order_arr[$i]'";
								mysqli_query($conn,$sql);
							}
						?>
						alert("支付成功");
						history.go(-2);
					}
					else{
						alert("密码错误");
					}
				}
			}
		</script>
	</body>
</html>