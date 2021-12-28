<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style type="text/css">
			body{
				font-size: 12px;
			}
			.shop_null{
				font-size: 20px;
				text-align: center;
				color: #000033;
				margin-top: 50px;
			}
			table{
				box-sizing: border-box;
				border: 0px;
				margin: 0px;
			}
			td{
				padding: 5px 20px;
			}
			button{
				height: 30px;
				min-width: 100px;
				padding: 0px 5px;
				background-color: #FFC002;
				border-radius: 5px;
				border-width: 1px;
				color: #fff;
			}
			button:hover{
				background-color: #FF9900;
			}
			.al{
				position: relative;
				left: 5px;
				font-size: 13px;
				margin: 2px;
				color: #FF3D37;
			}
			.dingdan_top{
				background-color: #f2f4f7;
				border-top-right-radius: 10px;
				border-top-left-radius: 10px;
			}
			.dingdan_bottom{
				background-color: #f2f4f7;
				border-bottom-right-radius: 10px;
				border-bottom-left-radius: 10px;
			}
			.dingdan{
				background-color: #f2f4f7;
			}
			button{
				/* height: 20px;
				width: 50px; */
			}
			a:not(.dotted){
				text-decoration: none;
				color: #000000;
				border: #000000 1px solid;
				padding: 5px 10px;
				margin-left: 5px;
				margin-right: 5px;
			}
			.current{
				border: 0 !important;
			}
			.page{
				text-align: center;
			}
		</style>
		<script>
			function change(identity,status,i,order_id){
				var items=document.getElementsByClassName("btn");
				if(status==0){
					window.top.location.href="../gouwuche/zhifu.php?order="+order_id+"&action=dd";
				}
				else if(status==2){
					location="check.php?order_id="+order_id+"&action=receive";
				}
			}
			window.onload=function(){
				var ps=document.getElementById("page_skip");
				var endPage=Number(ps.innerText.split("共")[1].split("页")[0]);
				var pageNum=<?php if(isset($_GET["page"]))echo $_GET["page"];else echo '1';?>;
				var items=document.getElementsByTagName("a");
				for(var i=0;i<items.length;i++){
					if(!isNaN(items[i].innerText)){
						if(items[i].innerText==pageNum){
							items[i].className='current';
						}
						else{
							items[i].className='';
						}
					}
				}
			}
		</script>
	</head>
	<body>
	<?php
		include '../conn.php';
		session_start();
		$user=$_SESSION['user'];
		$identity=$_SESSION['identity'];
		$get="";
		if(isset($_GET['status'])){
			$get=$_GET['status'];
		}
		$filename = $_SERVER['SCRIPT_NAME'];
		$sql = "select * from order_form where buy_username='$user'";
		if(!empty($get)){
			if($_GET['status']=="5"){
				$sql.=" and status=0";
			}
			else $sql.=" and status=".$get;
		}
		$sql.=" order by time desc";
		$result = mysqli_query($conn,$sql) or die("获取失败".$sql);
		$total = mysqli_num_rows($result);
		$pageSize = 3;
		$pageTotal = ceil($total/$pageSize);
		$page = 1;
		if(isset($_GET["page"])){
			$page = $_GET["page"];
		}
		$start = ($page - 1) * $pageSize;
		$sql .= " limit $start,$pageSize"; 
		$result = mysqli_query($conn,$sql);
		echo <<<ttt
		<style type="text/css">
		table{margin:0 auto;width:100%;}
		</style>
ttt;
		$i=0;
		$flag=0;
		while($rows = mysqli_fetch_assoc($result)){
			$goods_id=$rows['goods_id'];
			$sql1 = "select * from goods_information where goods_id='$goods_id'";
			$result1 = mysqli_query($conn,$sql1);
			$goods=mysqli_fetch_assoc($result1);
			echo "<table cellspacing=\"0\">";
			echo "<tr>";
			printf("<td colspan=\"5\" class=\"dingdan_top\">%s</td>",$goods['goods_from']);
			echo "</tr>";
			echo "<tr class=\"dingdan\">";
			echo "<td><img width=\"70px\" height=\"70px\" src=\"".$goods['photo1']."\"></td>";
			printf("<td>%s</td>",$goods['name']);
			printf("<td>￥%s</td>",$goods['price']);
			printf("<td>× %s</td>",$rows['quantity']);
			echo "<td><button class='btn' onclick=\"change('$identity','".$rows["status"]."','$i','".$rows["order_id"]."')\"" ;
			if($rows['status']=="0"){
				echo ">未付款</button>";
			}
			else if($rows['status']=="1"){
				echo ">已付款，等待发货</button>";
			}
			else if($rows['status']=="2"){
				echo ">已发货</button><br><div class=\"al\">点击确认收货</div>";
			}
			else{
				echo ">已收货</button>";
			}
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			printf("<td colspan=\"5\" class=\"dingdan_bottom\">下单时间：%s</td>",$rows['time']);
			echo "</tr>";
			echo "</table>";
			echo "</br>";
			$i++;
			$flag=1;
		}
		$text="";
		$back=$page==1?1:($page-1);
		$next=$page==$pageTotal?$pageTotal:($page+1);
		$num_1=$page<3?1:($page+1>=$pageTotal?$pageTotal-3:$page-1);
		$num_2=$page<3?2:($page+1>=$pageTotal?$pageTotal-2:$page);
		$num_3=$page<3?3:($page+1>=$pageTotal?$pageTotal-1:$page+1);
		$num_4=$page<3?4:($page+2>=$pageTotal?$pageTotal:$page+2);
		$page_2=$page_3=$page_4=$page_dotted="";
		if($pageTotal>1)$page_2="<a class=\"num\" href=\"$filename?page=$num_2&status=$get\">$num_2</a>";
		if($pageTotal>2)$page_3="<a href=\"$filename?page=$num_3&status=$get\">$num_3</a>";
		if($pageTotal>3)$page_4="<a href=\"$filename?page=$num_4&status=$get\">$num_4</a>";
		if($pageTotal>4)$page_dotted="<a class=\"dotted\">..</a>";
		
		$text.=
			"<div class=\"page\">
			<span class=\"page_num\" id=\"page_num\">
			<a href=\"$filename?page=$back&status=$get\" class=\"pn_prev\">&lt;&lt;上一页</a>
			<a href=\"$filename?page=$num_1&status=$get\">$num_1</a>".
			$page_2.
			$page_3.
			$page_4.
			$page_dotted.
			"&nbsp;<a href=\"$filename?page=$next&status=$get\" class=\"pn_next\">&gt;&gt;下一页</a>
			</span>
				<span class=\"page_skip\" id=\"page_skip\">
					&nbsp;&nbsp;&nbsp;共".$pageTotal."页  
				</span>
			</div>";
			if($flag==1)echo $text;
			else echo "<p class=\"shop_null\">暂无信息</p>";
	?>
	</body>
</html>
