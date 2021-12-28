<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style type="text/css">
			* {
			    margin: 0;
			    padding: 0
			}
			.main-footer{
			    font: 12px/1.5 'Microsoft YaHei', 'Heiti SC', tahoma, arial, 'Hiragino Sans GB', \\5B8B\4F53, sans-serif;
			    color: #666
			}
			
			.main-footer{
			    background: #f1f1f1;
			}
			.main-footer .container{
			    width: 1226px;
			    margin-right: auto;
			    margin-left: auto;
			}
			.main-footer .container .nav{
			    display: flex;
			    justify-content: space-between;
			    height: 80px;
			    padding: 27px 0;
			    border-bottom: 1px solid #ccc;
			}
			.main-footer .container .nav .item{
			    width: 243px;
			    text-align: center;
			    transition: color .28s;
			}
			.main-footer .container .nav .item:hover{
			    color: #f40;
			    cursor: pointer;
			}
			.main-footer .container .nav .item:not(:last-child){
			    border-right: 1px solid #ccc;
			}
			.main-footer .container .feature-box{
			    display: flex;
			    justify-content: space-between;
			}
			.main-footer .container .feature-box .feature{
			    display: flex;
			    padding: 30px 0;
			}
			.main-footer .container .feature-box .feature .item{
			    width: 180px;
			}
			.main-footer .container .feature-box .feature .item dt{
			    height: 50px;
			    line-height: 50px;
			    font-size: 16px;
			}
			.main-footer .container .feature-box .feature .item dd{
			    line-height: 30px;
			    color: rgba(0,0,0,0.6);
			}
			.main-footer .container .feature-box .service{
			    display: flex;
			    flex-direction: column;
			    align-items: center;
			    justify-content: center;
			    width: 250px;
			    padding: 30px 0;
			}
			.main-footer .container .feature-box .service p:nth-child(1){
			    margin: 0 0 5px;
			    font-size: 22px;
			    line-height: 1;
			    color: #ff6700;
			}
			.main-footer .container .feature-box .service p:nth-child(2){
			    font-size: 12px;
			    margin-top: 5px;
			    margin-bottom: 20px;
			}
			.main-footer .container .feature-box .service p:nth-child(3){
			    border: 1px solid #ff6700;
			    background: #fff;
			    color: #ff6700;
			    width: 118px;
			    height: 28px;
			    font-size: 12px;
			    line-height: 28px;
			    cursor: pointer;
			}
		</style>
<!-- 		<link rel="stylesheet" type="text/css" href="http://localhost/test/project/main/css/base.css"> -->
		<link rel="stylesheet" type="text/css" href="http://localhost/test/project/main/css/index1.css">
	</head>
	<body>
		<!--footer开始-->
		<div class="main-footer" id="dibu">
		    <div class="container">
		        <!-- <div class="nav">
		            <div class="item">预约维修服务</div>
		            <div class="item">7天无理由退货</div>
		            <div class="item">15天免费换货</div>
		            <div class="item">满150元包邮</div>
		            <div class="item" >520余家售后网点</div>
		        </div> -->
		        <div class="feature-box">
		            <div class="feature">
		                <dl class="item">
		                    <dt>帮助中心</dt>
		                    <dd>账户管理</dd>
		                    <dd>客服反馈</dd>
		                    <dd>申诉中心</dd>
		                </dl>
		                <dl class="item">
		                    <dt>支付方式</dt>
		                    <dd>货到付款</dd>
		                    <dd>在线支付</dd>
		                    <dd>分期付款</dd>
		                </dl>
		                <dl class="item">
		                    <dt>售后服务</dt>
		                    <dd>售后政策</dd>
		                    <dd>价格保护</dd>
		                    <dd>退款说明</dd>
		                </dl>
		                <dl class="item">
		                    <dt>配送方式</dt>
		                    <dd>上门自提</dd>
		                    <dd>配送服务</dd>
		                    <dd>海外配送</dd>
		                </dl>
		                <dl class="item" style="border-right: 1px solid #ccc;">
		                    <dt>购物指南</dt>
		                    <dd>浏览推荐</dd>
		                    <dd>流程介绍</dd>
		                    <dd>特色服务</dd>
		                </dl>
		            </div>
		            <div class="service">
		                <p class="center"></p>
		                <p class="center"><br/></p>
		                <p class="center"></p>
		            </div>
		        </div>
		    </div>
		</div>
		<!--footer结束-->
	</body>
</html>
