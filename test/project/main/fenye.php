<?php
	include "../conn.php";
	$filename=$_SERVER["SCRIPT_NAME"];
	$catagory=0;
	$pageNum=1;
	$pageSize=8;
	$endPage=1;
	$text="";
	$pageNum=empty($_GET['pageNum'])?1:$_GET['pageNum'];
	if($_GET){
		include "../conn.php";
		$catagory=0;
		$key_c='';
		if($_GET){
			
			if(isset($_GET["key"])){
				$key=$_GET["key"];
				$sql="select * from goods_information where (name like '%$key%') or (catagory like '%$key%')";
			}
			else if(isset($_GET["catagory"])){
				$catagory=(int)$_GET["catagory"];
				switch($catagory){
				case 0:$key_c='food';break;
				case 1:$key_c='clothing';break;
				case 2:$key_c='electronic';break;
				case 3:$key_c='home';break;
				case 4:$key_c='trip';break;
				case 5:$key_c='mother_baby';break;
				case 6:$key_c='book';break;
				case 7:$key_c='beauty';break;
				case 8:$key_c='health';break;
				case 9:$key_c='art';break;
				}
				$sql="select * from goods_information where catagory='$key_c'";
			}
			
			
			$result=mysqli_query($conn,$sql);
			$goods=array();
			$newFilePath=array();
			if(mysqli_num_rows($result)>0){
				$num=mysqli_num_rows($result);
				$endPage=ceil($num/$pageSize);
				$sql.=" limit ".($pageNum-1)*$pageSize.",".$pageSize;
				$result=mysqli_query($conn,$sql);
				// $i=0;
				while($row=mysqli_fetch_assoc($result)){
					$goods[]=$row;
					// $img_name="pic_";
					// $data = $row["photo1"];//得到post过来的二进制原始数据
					// if(empty($data)){ 
					//   $newFilePath[$i]="";
					// }
					// else{
					// 	$newFilePath[0]="../tmp_photo/".uniqid($img_name).".png";
					// 	$newFile = fopen($newFilePath[$i],"w");//打开文件准备写入
					// 	fwrite($newFile,$data);//写入二进制流到文件
					// 	fclose($newFile);//关闭文件
						
					// }
					// $i++;
				}
				// $newFilePath='../tmp_photo/'+$img_name+".png";
				// $data = $goods[0]["photo1"];//得到post过来的二进制原始数据
				// if(empty($data)){ 
				//   $data=file_get_contents("php://input");
				// }
				// $newFile = fopen($newFilePath,"w");//打开文件准备写入
				// fwrite($newFile,$data);//写入二进制流到文件
				// fclose($newFile);//关闭文件
			}
		}
		$text.="<div class=\"sk_bd clearfix\">
            <ul>";
		for($i=0;$i<count($goods);$i++){
			$text.="<li class=\"sk_goods fl\">
					<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$goods[$i]['goods_id']."\">
					<img src=\"".$goods[$i]['photo1']."\" style='width: 287px;height: 309px;'>
					<h5 class=\"sk_goods_title\">".$goods[$i]['name']."</h5>
					<p class=\"sk_goods_price\"><em>￥".$goods[$i]['price']."</em>
						
					</p>
		
					<a href=\"../buy_manage/php/buy-goods.php?goods_id=".$goods[$i]['goods_id']."\" class=\"sk_goods_buy\">立即购买</a>
					</a>
					</li>";
		}
		
		$text.="</ul>
        </div>";
		
		$back=$pageNum==1?1:($pageNum-1);
		$next=$pageNum==$endPage?$endPage:($pageNum+1);
		$num_1=$pageNum<3?1:($pageNum+1>=$endPage?$endPage-3:$pageNum-1);
		$num_2=$pageNum<3?2:($pageNum+1>=$endPage?$endPage-2:$pageNum);
		$num_3=$pageNum<3?3:($pageNum+1>=$endPage?$endPage-1:$pageNum+1);
		$num_4=$pageNum<3?4:($pageNum+2>=$endPage?$endPage:$pageNum+2);
		$page_2=$page_3=$page_4=$page_dotted="";
		if($endPage>1)$page_2="<a href=\"javascript:show('$filename?pageNum=$num_2&catagory=$catagory')\">$num_2</a>";
		if($endPage>2)$page_3="<a href=\"javascript:show('$filename?pageNum=$num_3&catagory=$catagory')\">$num_3</a>";
		if($endPage>3)$page_4="<a href=\"javascript:show('$filename?pageNum=$num_4&catagory=$catagory')\">$num_4</a>";
		if($endPage>4)$page_dotted="<a class=\"dotted\">..</a>";
		
		$text.=
		"<div class=\"page\">
		<span class=\"page_num\" id=\"page_num\">
			<a href=\"javascript:show('$filename?pageNum=$back&catagory=$catagory')\" class=\"pn_prev\">&lt;&lt;上一页</a>
			<a href=\"javascript:show('$filename?pageNum=$num_1&catagory=$catagory')\">$num_1</a>".
			$page_2.
			$page_3.
			$page_4.
			$page_dotted.
			"&nbsp;<a href=\"javascript:show('$filename?pageNum=$next&catagory=$catagory')\" class=\"pn_next\">&gt;&gt;下一页</a>
		</span>
		    <span class=\"page_skip\" id=\"page_skip\">
				&nbsp;&nbsp;&nbsp;共".$endPage."页  
		</span>
		</div>";
		// $text.= "<script>
		// 	<?php echo \"var pageNum=\".$pageNum.\";\"
		
		// 	var content=document.getElementById(\"page_num\");
		// 	var items=content.getElementsByTagName(\"a\");
		// 	items[1].className=\"current\";
		// 	var i,j,k;
		// 	var length=items.length;
		// 	if(endPage<=4){
		// 		for(i=1;i<length-1;i++){
		// 			items[i].onclick=function(){
		// 				for(j=1;j<length-1;j++){
		// 					items[j].className=\"\";
		// 				}
		// 				this.className+=\"current\";
		// 			}
		// 		}
		// 	}
		// 	else{
		// 		if(pageNum<3){
		// 			for(i=1;i<3;i++){
		// 				items[i].onclick=function(){
		// 					for(j=1;j<length-1;j++){
		// 						items[j].className=\"\";
		// 					}
		// 					this.className+=\"current\";
		// 				}
		// 			}
		// 		}
		// 	}
		// </script>";
	}
	echo $text;
?>