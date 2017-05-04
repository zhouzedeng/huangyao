<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚古镇</title>
       <style>
		.head{
			
			width:100%;
			height:60px;
			background-color:#9F79EE;
		}
		.span1,.span2{
			line-height:60px;
		}
		.span1{
			font-size:28px;
			color:#ddd;
		}
		.span2{
			color:#bbb;
		}
		
		.foot{
			background-color:#000;
			width:100%;
			height:30px;
			color:#aaa;
			text-align:center;
			line-height:30px;
		}
		
		body{
			padding:0;
			margin:0;
		}
		.list{
			width:100%;
			height:650px;
			background-color:#ddd;
		}
		.pic{
			
			width:100%;
			height:300px;
		}
		.pic img{
			width:100%;
			height:300px;
		}
		.info{
			
		}
		</style>     
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  
      		
</head>
<body>	
<div class="head">
	<span class="span1">黄姚古镇集市平台</span>
	<span class="span2">省时省力更省心</span>
</div>
    
	<div class="list">	
	   <div class="pic">
	   	<img src="<?php echo ($list["img"]); ?>">
	   </div>
	   <div class="info">
	        <h4>商品名称 : <?php echo ($list["good_name"]); ?></h4>
	        <h4>商品价格 : <?php echo ($list["price"]); ?></h4>
	        <h4>商家昵称 : <?php echo ($list["username"]); ?></h4>
	        <h4>联系电话 : <?php echo ($list["phone"]); ?></h4>
	        <h4>商品简介 : <?php echo ($list["good_detail"]); ?></h4>	       
	   </div>
		
	</div>
	


<div class="foot">
	<span>备案号:13456789</span>
</div>



</body>
</html>