<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style type="text/css">
			.zong{
 				background: #ffffff;
				margin: 0px auto;
			}
			tr{
				border:  1px solid #000000;
			}
			#text{
				width: 100%;
			}
			#jiesuan_bottom{
				border-top: 1px solid #DFDFDF;
				margin-top: 100px;
				margin-bottom: 100px;
			}
			a{
				text-decoration: none;
			}
			a:link{
				color: #666666;
			}
			a:visited{
				color: #666666;
			}
			#jiesuan{
				margin: 10px;
			}
			h1{
				margin:10px;
				
			}
			.header{
				width: 100%;
				margin: 0px auto;
				margin-top: 0px;
				
				border-bottom: 1px solid #DFDFDF;
			}
			.top{
				background: #F1F1F1;
			}
			.logoimg,.home{
				width: 150px;
				margin-top: 10px;
			}
			.imggoods{
				height: 90px;
			}
			#search{
				float: right;
			}
			tr{
				text-align: center;
			}
			table{
				width: 100%;
				margin: 0px auto;
				border-spacing: 0px;
			}
			#jiesuan{
				float: right;
				margin-right: 5%;
				width: 150px;
				height: 30px;
				color: #ffffff;
				font-size: 15px;
				background-color: #F24349;
				border: 1px solid #ffffff;
				border-radius: 10px;
			}
			#jiesuan:hover{
				background-color: #FF9966;
			}
			#xuan{
				width: 110px;
				text-align: center;
			}
			.home{
				width: 20px;
			}
			.gai{
				background-color: #F1F1F1;
			}
			.security-right-title {
				height: 50px;
				padding-left: 30px;
				border-bottom: 1px solid #ddd;
				margin-bottom: 20px;
				box-sizing: border-box;
			}
			
			.security-right-title-img {
				float: left;
				width: 20px;
				height: 16px;
				margin-top: 16px;
			}
			.security-right-title-text {
				float: left;
				margin: 15px 0 0 5px;
				color: #ff4e37;
				font-size: 12px;
				letter-spacing: 1px;
				cursor: default;
			}
			#fir td{
				padding-bottom: 11px;
				border-bottom: #C4DAE1 solid 1px;
			}
		</style>
	</head>
	<body>
	<div class="zong">
		<div class="header">
			<div class="security-right-title">
				<img class="security-right-title-img" src="../personal-center/img/shopping_cart.png">
				<span class="security-right-title-text">我的购物车</span>
			</div>
			<?php
				include 'conn.php';
				session_start();
				$key=$_SESSION['user'];
				$sql = "select * from gouwuche where username='$key'";
			?>	
			<?php
				$result = mysqli_query($conn,$sql);
				echo "<table>";
				echo "<tr id=\"fir\">";
				echo "<td id=\"xuan\">";
			?>
			<input type="button" name="quanxuan" id="checkall" value="全选"/>
			<input type="button" name="bu" id="checkno" value="全不选"/>
			<?php
				echo "</td>";
				echo "<td>";
				echo "商品信息";
				echo "</td>";
				echo "<td>";
				echo "名称";
				echo "</td>";
				echo "<td>";
				echo "数量";
				echo "</td>";
				echo "<td>";
				echo "单价";
				echo "</td>";
				echo "<td>";
				echo "增加";
				echo "</td>";
				echo "<td>";
				echo "减少";
				echo "</td>";
				echo "<td>";
				echo "删除";
				echo "</td>";
				echo "</tr>";
				$xuanzhongtotal=0;
				$money=0;
				$shop_row=array();
				$goods_row=array();
				$i=0;
				while($myrow=mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>";
			?>
				<img src="image/home.jpg" class="home"/>
			<?php
					$shop_row[$i]=$myrow;
					$sql1="select * from goods_information where goods_id='".$myrow['goods_id']."'";
					$result1=mysqli_query($conn,$sql1);
					$goods_row[$i]=mysqli_fetch_assoc($result1);
					echo $goods_row[$i]["goods_from"];
					echo "</td >";
					echo "</tr>";
					echo "<tr class='gai'>";
					echo "<td>";
			?>
			<input type="checkbox" name="box" id="check" value="<?php echo $myrow["shop_cart_id"];  ?>"/>
				
			<?php
					echo "</td>";
					echo "<td>";
					echo "<img class=\"imggoods\" src=\"".$goods_row[$i]["photo1"]."\"/>";
					echo "</td>";
					echo "<td>";
					echo $goods_row[$i]["name"];
					echo "</td>";
					echo "<td>";
					echo $myrow["quantity"];
					$m=$myrow["username"];
					$shop_id=$myrow["shop_cart_id"];
					$inventory=$goods_row[$i]["inventory"];
					$number=$myrow["quantity"];
					echo "</td>";
					echo "<td>";
					echo "￥".$goods_row[$i]["price"];
					echo "</td>";
					echo "<td>";
					echo "<a href='action.php?name=$m&id=$shop_id&number=$number&inventory=$inventory&action=1'>+</a>";
					echo "</td>";
					echo "<td>";
					echo "<a href='action.php?name=$m&id=$shop_id&number=$number&action=2'>-</a>";
					echo "</td>";
					echo "<td>";
					echo "<a href='action.php?name=$m&id=$shop_id&action=3'>删除</a>";
					echo "</td>";
					echo "</tr>";
					$i++;
				}
				echo "</table>";
				$checked=array(count($shop_row));
				for($i=0;$i<count($checked);$i++){
					$checked[$i]=0;
				}
				$c=0;
			?>
		<div id="jiesuan_bottom">
			<input type="button" value="结算" onclick="checkbox()" id="jiesuan" />
		</div>
		
	</div>
	<script>
		document.getElementById("checkall").onclick=function(){
			var checkElements=document.getElementsByName('box');								
			for(var i=0;i<checkElements.length;i++){
				var checkElement=checkElements[i];
				checkElement.checked="checked";
			}
		}
		document.getElementById("checkno").onclick=function(){
			var checkElements=document.getElementsByName('box');								
			for(var i=0;i<checkElements.length;i++){
				var checkElement=checkElements[i];
				checkElement.checked=null;
			}
		}
		if(document.getElementById("check")){
			document.getElementById("check").onclick=function(){
				var checkElements=document.getElementsByName('boxx');
				var check=document.getElementsByName('box');
				for(var i=0;i<checkElements.length;i++){
					var checkElement=checkElements[i];
					if(checkElement.checked="checked"){
						check[1].checked=null;
						break;
					}
				}
			}
		}
		function checkbox(){
			var str=document.getElementsByName("box");
			var i=0;
			var objarray=str.length;
			var chestr="";
			var m=0;
			for (i=0;i<objarray;i++){
				if(str[i].checked == true){
					chestr+=str[i].value+"o-r-d-e-r";
					m++;
				}
			}
			if(chestr == ""){
				alert("请先选择商品！");
			}
			else{
				if(confirm("确认购买？")){
					window.parent.location="../buy_manage/php/create.php?order="+chestr+"&action=gwc_dd";
				}
			}
		}
	</script>
	
	</body>
</html>