<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="css/index1.css">
    <link rel="stylesheet" href="css/basis.css">
    <!--引入css初始化\公共\首页的css文件-->
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/list.css">
	<style type="text/css">
		#sk_con_ul li{
			font-size: 14px;
			margin: 0px 45px;
		}
	</style>
	<?php
		$catagory=0;
		if($_GET){
			if(isset($_GET["catagory"]))
			$catagory=(int)$_GET["catagory"];
			if(isset($_GET["key"]))
			$key=$_GET["key"];
		}
	?>
</head>

<body>
<div id="app">
    <?php include '../top.php'; ?>
    <div class="main-body">
        <!-- 盒子一  -->
        <div class="container-1">
            <img src="../base_photo/logo_name.png">
            <div class="nav-list">
                <!-- <a class="item" target="_self" href="#">### </a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a>
                <a class="item" target="_self" href="#">###</a> -->
            </div>
            <div class="search">
                <input type="text" class="text" id="text" value="">
                <button id="btn_search" class="btn" onclick="search()">搜索</button>
            </div>

        </div>
    </div>
    <div class="nav">
        <div class="w">
            <!-- <div class="sk_list fl">
                <ul>
                    <li><a href="#">评优秒杀</a></li>
                    <li><a href="#">即将售罄</a></li>
                    <li><a href="#">超值低价</a></li>
                </ul>
            </div> -->
            <div class="sk_con fl">
                <ul id="sk_con_ul">
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=0',0)">食品</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=1',1)">服装</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=2',2)">电子</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=3',3)">家居</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=4',4)">出行</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=5',5)">母婴</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=6',6)">图书</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=7',7)">美妆</a></li>
                    <li><a href="javascript:show('fenye.php?pageNum=1&catagory=8',8)">健康</a></li>
					<li><a href="javascript:show('fenye.php?pageNum=1&catagory=9',9)">艺术</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="sk_container w">
        <div class="sk_hd">
            <img src="upload/bg_03.png">
        </div>
		<div id="goods_text">
			
		</div>
    </div>
	<?php include '../bottom.php'; ?>
</div>
<!--导航-->

<!-- <script src="js/index1.js"></script> -->
<script src="js/jquery-1.3.1.js"></script>
<script>
	function search(){
		var text=document.getElementById('text');
		location="list.php?key="+text.value;
	}
	function show(url,c){
		var fl="c";
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
		var content=document.getElementById("sk_con_ul")
		var items=content.getElementsByTagName("a");
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
		<?php
			
			if(isset($_GET["catagory"])){
				echo "var catagory='$catagory';";
				echo "show(\"fenye.php?pageNum=1&catagory=\"+catagory);";
			}
			else if(isset($_GET["key"])){
				echo "var key='$key';";
				echo "show(\"fenye.php?pageNum=1&key=\"+key);";
			}
		?>
	}
</script>
</body>

</html>