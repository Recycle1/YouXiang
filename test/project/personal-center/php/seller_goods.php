<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>个人中心</title>
		<link rel="stylesheet" type="text/css" href="../css/personal-base.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-header.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-content.css" />
		<link rel="stylesheet" type="text/css" href="../css/personal-footer.css" />
		<link rel="stylesheet" type="text/css" href="../css/upload-img.css" />
		<link rel="stylesheet" type="text/css" href="../css/shop-management.css" />
		<style type="text/css">
			li{
				float: left;
			}
			.page a:not(.dotted){
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
				margin-top: 10px;
				text-align: center;
			}
			.profile-detail{
				width: 90%;
				margin: 0px auto;
				text-align: center;
			}
			.profile-content table th{
				width: 70px !important;
				text-align: center;
			}
			#goods_text table td{
				width: 70px !important;
				text-align: center;
			}
			#add{
				margin-top: 7px;
				font-size: 15px;
				color: #FF3D37;
				padding: 5px 5px;
				border: #D3D6DA solid 1px;
				width: 90px;
				display: block;
				float: right;
				text-align: center;
			}
			#add:hover{
				background-color: #ECECEC;
			}
		</style>
		<?php
			$catagory="0";
			if($_GET){
				if(isset($_GET['catagory'])){
					$catagory=$_GET['catagory'];
				}
			}
		?>
		<script type="text/javascript">
			function show(url){
				var xhr=new XMLHttpRequest();
				xhr.onreadystatechange=function(){
					if(xhr.readyState==4){
						document.getElementById("goods_text").innerHTML=xhr.responseText;
						var ps=document.getElementById("page_skip");
						var endPage=Number(ps.innerText.split("共")[1].split("页")[0]);
						var content=document.getElementById("page_num");
						var items=content.getElementsByTagName("a");
						var i,j;
						var length=items.length;
						var pageNum=Number(url.split("pageNum=")[1].split("&")[0]);
						if(endPage<=4){
							for(i=1;i<length-2;i++){
								items[i].className="";
							}
							items[pageNum].className+="current";
						}
						else{
							if(pageNum<3||pageNum>endPage-2){
								for(i=1;i<length-2;i++){
									items[i].className="";
								}
								if(pageNum==endPage-1)items[length-4].className+="current";
								else if(pageNum==endPage)items[length-3].className+="current";
								else items[pageNum].className="current";
							}
							else{
								for(i=1;i<length-2;i++){
									items[i].className="";
								}
								items[2].className+="current";
							}
						}
					}
				}
				xhr.open('GET',url);
				xhr.send(null);
			}
			window.onload=function(){
				change(0);
				var content=document.getElementById("catagory-list-nav");
				var items=content.getElementsByTagName("li");
				<?php echo "var c=".$catagory.";"?>
				items[c].className+="selected_li";
				var i,j;
				var length=items.length;
				for(i=0;i<length;i++){
					items[i].onclick=function(){
						for(j=0;j<length;j++){
							items[j].className="";
						}
						this.className+="selected_li";
					}
				}
				<?php echo "var catagory="."$catagory".";"?>
				show("fenye.php?pageNum=1&catagory="+catagory);
			}
			function change(num){
				var content=document.getElementById("catagory-list-nav");
				var items=content.getElementsByTagName("li");
				for(var i=0;i<items.length;i++){
					items[i].id="";
				}
				items[num].id="list-nav-active";
			}
		</script>
	</head>
	<body>
		<!-- bodybox begin -->
		<div class="content">
				<div class="security-right">
					<div class="security-right-title">
						<img class="security-right-title-img" src="../img/shop.png">
						<span class="security-right-title-text">店铺管理</span>
						<div align="right" id="add"><a href="../../buy_manage/php/manage-goods.php" target="_parent">添加商品</a></div>
					</div>
					
					<div class="profile-detail">
						<div class="catagory-wrapper">
							<div class="catagory-text-container">
								<ul class="catagory-list-nav" id="catagory-list-nav">
									<li class="list-nav" onclick="change(0)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=0')" onclick="change(0)">食品类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(1)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=1')" onclick="change(1)">服装类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(2)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=2') " onclick="change(2)">电子类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(3)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=3')" onclick="change(3)">家居类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(4)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=4')" onclick="change(4)">出行类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(5)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=5')" onclick="change(5)">母婴类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(6)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=6')" onclick="change(6)">图书类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(7)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=7')" onclick="change(7)">美妆类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(8)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=8')" onclick="change(8)">健康类</a>
										</div>
									</li>
									<li class="list-nav" onclick="change(9)">
										<div class="inner-text">
											<a href="javascript:show('fenye.php?pageNum=1&catagory=9')" onclick="change(9)">艺术类</a>
										</div>
									</li>
								</ul>
							</div>
							<!-- catagory-text-container end -->
						</div>
						<div class="profile-content">
							<table>
								<tr>
									<th>商品ID</th>
									<th>商品名称</th>
									<th>价格</th>
									<th>库存</th>
									<th>修改</th>
									<th>删除</th>
								</tr>
							</table>
							<div id="goods_text">
								
							</div>
						</div>
					</div>
					<!-- profile-detail-end -->
				</div>
				<!-- security-right-end -->
		</div>
		<!-- content-end -->
		<!-- bodybox end -->
	</body>
</html>

