<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚人的生活圈</title>      
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/phone.css">  
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">   
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/bootstrap/css/bootstrap.css">   
    <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>  
    <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/bootstrap.js"></script>    		
</head>
<body>	

<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>

<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>   
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="/hongsheng/Public/image/l4.jpg">
            <div class="carousel-caption"></div>
        </div>
        <div class="item">
            <img src="/hongsheng/Public/image/l1.jpg">
            <div class="carousel-caption"></div>
        </div>
        <div class="item">
            <img src="/hongsheng/Public/image/l3.jpg">
            <div class="carousel-caption"></div>
        </div>
        <div class="item">
            <img src="/hongsheng/Public/image/l2.jpg">
            <div class="carousel-caption"></div>
        </div>
    </div>
</div>
<div class="inter">
<a style="text-decoration:none;" href="<?php echo U('Index/life');?>">
    <div class="radius r1">
    <br> <br>  
    	<span class="hot rspan">黄姚圈子 </span><br>
    	<span class="sub">谈天论地</span>
    	&nbsp;&nbsp;<span class="sub">当地动态</span><br>
    	<span class="sub">我要吐槽</span>
    	&nbsp;&nbsp;<span class="sub">我有话叫</span>
    
    </div>
    </a>        
   <a style="text-decoration:none;" href="<?php echo U('Index/mgoods');?>">
    <div class="radius r2">
    <br> <br>
    	<span class="goods rspan">黄姚商品 </span><br>
    	<span class="sub">黄姚特产</span>
    	&nbsp;&nbsp;<span class="sub">农家瓜果</span><br>
    	<span class="sub">品质家电</span>
    	&nbsp;&nbsp;<span class="sub">日常百货</span>
    </div>
    </a>
    
    
    <a style="text-decoration:none;" href="<?php echo U('Index/mservice');?>">
    <div class="radius r3">
    <br> <br>
    	<span class="sevice rspan">本地服务 </span><br>
    	<span class="sub">安装宽带</span>
    	&nbsp;&nbsp;<span class="sub">水电装修</span><br>
    	<span class="sub">更换煤气</span>
    	&nbsp;&nbsp;<span class="sub">电视盒子</span>
    </div>
    </a>
</div>	

<div class="foot">
	<span>备案号：粤ICP备17044777号</span>
</div>
<div class="menus">
	<div class="menu_sub sub1">
		<a href="<?php echo U('Index/index');?>"><span>首页</span></a>
	</div>
	<div class="menu_sub sub2">
		<a href="<?php echo U('Index/mgoods');?>"><span>商品</span></a>
	</div>
	<div class="menu_sub sub3">
		<a href="<?php echo U('Index/mservice');?>"><span>服务</span></a>
	</div>
	<div class="menu_sub sub4">
		<a href="<?php echo U('Index/life');?>"><span>黄姚圈</span></a>
	</div>	
</div>

<script>

$('#myCarousel').carousel({
	interval: 2000
});

$('.sub'+<?php echo ($menu); ?>).css('background-color','#595');

</script>

</body>
</html>