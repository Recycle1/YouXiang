<?php
	include "../../conn.php";
	$filename=$_SERVER["SCRIPT_NAME"];
	$catagory=0;
	$pageNum=1;
	$pageSize=8;
	$endPage=1;
	$text="";
	$pageNum=empty($_GET['pageNum'])?1:$_GET['pageNum'];
	if($_GET){
		$catagory=0;
		$key_c='';
		if($_GET){
			if(isset($_GET["catagory"])){
				$catagory=(int)$_GET["catagory"];
			}
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
			session_start();
			$seller=$_SESSION['user'];
			$sql="select * from goods_information where catagory='$key_c' and goods_from='$seller'";
			$result=mysqli_query($conn,$sql) or die("获取失败".$sql);
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
				}
			}
		}
		$text.="<div class=\"sk_bd clearfix\">
            <table>";
		for($i=0;$i<count($goods);$i++){
			$text.="<tr>
					<td>".$goods[$i]['goods_id']."</td>
					<td class=\"sk_goods_title\">".$goods[$i]['name']."</td>
					<td class=\"sk_goods_price\"><em>￥".$goods[$i]['price']."</td>
					<td>".$goods[$i]['inventory']."</td>
					<td><a href='../../buy_manage/php/update_goods.php?goods_id=".$goods[$i]['goods_id']."' target='_parent'>修改</a></td>
					<td><a href=\"javascript:if(confirm('确定要删除吗？'))location='../../buy_manage/php/delete.php?goods_id=".$goods[$i]['goods_id']."'\">删除</a></td>
					</tr>";
		}
		$text.="</table>
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
	}
	echo $text;
?>