<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>支付页面</title>
		<style type="text/css">
			.zong{
				width: 80%;
				border: 1px solid #ffffff;
				margin: 0px auto;
				margin-top: 30px;
			}
			#top{
				border-bottom: 1px solid #DFDFDF;
			}
			img{
				width: 40px;
				float: left;
			}
			.dizhi{
				border-radius: 5px;
				background: #ffffff;
				margin-bottom: 10px;
			}
			.dizhi img{
				width: 40px;
				float: right;
			}
			#where,#who{
				margin-bottom: 5px;
				width: 500px;
			}
			.shangpin{
				background: #ffffff;
				margin-bottom: 5px;
				border-bottom: 1px solid #666666;
			}
			.zhifu{
				
				background: #ffffff;
			}
			table{
				width: 100%;
				text-align: left;
			}
			.label{
				width: 100px;
			}
			.gai{
				float: left;
			}
			.zhifu img{
				width: 40px;
			}
			.bottom{
				border-radius: 5px;
				background: #ffffff;
				margin-top: 5px;
				float: right;
			}
			.dizhi{
				border-bottom: 1px solid #DFDFDF;
			}
			.daishou{
				border-bottom: 1px solid #DFDFDF;
			}
		</style>
		<?php
			$order = $_GET["order"];
			$number="";
			if(isset($_GET["number"])){
				$number = $_GET["number"];
			}
			
			include 'conn.php';
			$order_arr=explode("o-r-d-e-r",$order);
			$sum=0;
			
			for($i=0;$i<count($order_arr);$i++){
				if($order_arr[$i]){
					if(isset($_GET["action"])){
						if($_GET["action"]=='dd'){
							$sql="select * from order_form where order_id='$order_arr[$i]'";
						}
					}
					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_assoc($result);
					$sql1="select * from goods_information where goods_id='".$row["goods_id"]."'";
					$result1=mysqli_query($conn,$sql1);
					$row1=mysqli_fetch_assoc($result1);
					$sum+=$row["quantity"]*$row1["price"];
				}
			}
			
		?>
	</head>
	<body>
	    <div class="zong">
		   <div id="top">
		      <h1 id="logo">
		      	<a title="">
		      		<img src=".image/dingdan.jpg"/>
		      	</a>
				<p>确认订单</p>
		      </h1>
			<p>确认收货地址</p>  
		   </div>
		   <div class="dizhi"> 
		   <form action="" method="post">
				<table>
					<tr>
						<td><img src="image/dingwei.jpg"/></td>
						<td><input id="address" type="text" placeholder="请输入收货地址" id="where"/></td>
					</tr>
					<tr>
						<td><img src="image/dingwei.jpg"/></td>
						<td><input id="tel" type="text" placeholder="请输入联系方式" id="who"/></td>
					</tr>
				</table>
			</form>
			</div>
			<div class="shangpin">
				<table>
					<tr>
						<td class="label">配送服务</td>
						<td class="gai">快递 免邮 付款后15天内</td>
					</tr>
					<tr>
						<td class="label">运费险</td>
						<td class="gai">退换货可赔付10元</td>
					</tr>
					<tr>
						<td class="label">订单备注</td>
						<td class="gai">无备注</td>
					</tr>
				</table>
			</div>
			<div class="bottom">
				<?php if(!empty($number)){
					echo "<p>共".$number."件商品</p>";
				}?>
				<p>实付款：<?php echo($sum);?>元</p>
				<p><input type="submit" value="提交订单" id="tijiao" onclick="tijiao()" /></p>
			</div>
		</div>
		<script>
			function tijiao(){
				var order="<?php echo $order;?>";
				var webto="fukuan.php?order="+order;
				if(document.getElementById("address").value!=''){
					var address=document.getElementById("address").value;
					webto+="&address="+address;
					if(document.getElementById("tel").value!=''){
						var tel=document.getElementById("tel").value;
						webto+="&tel="+tel;
						location.href=webto;
					}
					else{
						alert("请输入联系方式");
					}
				}
				else{
					alert("请输入地址");
				}
			}
		</script>
	</body>		
	
</html>