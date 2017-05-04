<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚集市平台</title>
    <meta name="keyword" content="<?php echo ($keyword); ?>" />
    <meta name="description" content="<?php echo ($description); ?>" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/pc.css">  
	<script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>	
</head>
<style>
	.content{height:800px;}
.text{
	width:500px;	
	margin:0 auto;
	color:#888;
}
</style>
<body>
<div class="head">
	<div class="head2">
		<span class="span1">黄姚古镇线上集市平台</span>
		<span class="span2">让你购物省时省力更省心</span>
	</div>
</div>

<div class="content">
    <div class="notice">
       <a href="<?php echo U('Index/index');?>">
			<div class="nosub2 nosub">
				<span>首页</span>
			</div>
	    <a>
	    <a href="<?php echo U('Index/goodslist');?>?hot=1">
			<div class="nosub menu2">
				<span>热推商品</span>
			</div>
	    <a>
	    <a href="<?php echo U('Index/goodslist');?>?hot=0">
			<div class="nosub nosub2 menu3">
				<span>大众商品</span>
			</div>
		</a>
		
		<a href="<?php echo U('Index/text');?>" >
			<div class="nosub" style="background:blue;">
				<span>平台规则</span>
			</div>
		</a>
		
		<a href="<?php echo U('Index/notice');?>">
			<div class="nosub nosub2">
				<span>平台通知</span>
			</div>
		</a>
	</div>
	<div class="text">
	<br><br><br><br>
		<h3>1. 加盟平台时，需卖家提供图片一张、产品名称、产品介绍、产品价格、卖家姓名、卖家联系电话。</h3>		
		<h3>2. 产品价格不能太离谱，必须和产品相吻合，不然平台自动下架该产品。</h3>
		<h3>3. 平台只提供商品详细信息，具体交易流程由卖家与买家电话商议完成。</h3>	
		<h3>4. 平台内商品的有效期为30天，30天后自动到期。联系管理员可续期，续期也为30天</h3>	
		<h3>5. 图片大小最好是300*300像素。</h3>
		<h3>6. 产品介绍不超过100字。</h3>
		<h3>7. 招商微信号：aaa729952708</h3>
		<h3>8. 热推商品总数为20个，名额满之后需等其他卖家到期后方可设置热推，类似排队</h3>	
		<h3>9. 重要！产品先发布再收费，先收费的都是骗子哦</h3>					
	</div>
	
	
	
</div>	
<script type="text/javascript">
$(function(){	
	var menu = <?php echo ($menu); ?>;
	if(menu == 4){
		$('.menu4').css('background-color','blue');
	}
	else{
		$('.menu5').css('background-color','blue');
	}
	
 	
	
});
</script>
</body>
<div class="foot">
	<span>备案号：粤ICP备17044777号</span>
</div>
</html>