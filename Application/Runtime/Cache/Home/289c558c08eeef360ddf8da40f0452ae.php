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
			<div class="nosub2 nosub " style="background:blue;">
				<span>首页</span>
			</div>
	    <a>
	    <a href="<?php echo U('Index/goodslist');?>?hot=1">
			<div class="nosub ">
				<span>热推商品</span>
			</div>
	    <a>
	    <a href="<?php echo U('Index/goodslist');?>?hot=0">
			<div class="nosub nosub2">
				<span>大众商品</span>
			</div>
		</a>
		
		<a href="<?php echo U('Index/text');?>">
			<div class="nosub">
				<span>平台规则</span>
			</div>
		</a>
		
		<a href="<?php echo U('Index/notice');?>">
			<div class="nosub nosub2">
				<span>平台通知</span>
			</div>
		</a>
	</div>
	<div class="hot">
		<a href="<?php echo U('Index/goodslist');?>?hot=1" target="_blank"><span>平台推荐 >></span></a>
	</div>
	<div>
		<?php if(is_array($hotlist)): $i = 0; $__LIST__ = $hotlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods">
				<div class="img">
					<img src="<?php echo ($vo["img"]); ?>">
				</div>
				<div class="text">
					<p class="name"><?php echo ($vo["good_name"]); ?></p>
					
					
					<span >价格: <?php echo ($vo["price"]); ?></span>
					<br>
					<span> 卖家: <?php echo ($vo["username"]); ?></span>
					<br>
					<span >电话: <?php echo ($vo["phone"]); ?></span>
					
					<br>
					
					<br>					
					<span><?php echo ($vo["good_detail"]); ?></span>
				</div>			
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	
	<a href="<?php echo U('Index/goodslist');?>?hot=0" target="_blank">
	<div class="hot">
		<span>本地商品 >> </span>
	</div>
	</a>
	<div>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods">
				<div class="img">
					<img src="<?php echo ($vo["img"]); ?>">
				</div>
				<div class="text">
					<p class="name"><?php echo ($vo["good_name"]); ?></p>
					
					
					<span >价格: <?php echo ($vo["price"]); ?></span>
					<br>
					<span> 卖家: <?php echo ($vo["username"]); ?></span>
					<br>
					<span >电话: <?php echo ($vo["phone"]); ?></span>
					
					<br>
					
					
					<br>					
					<span><?php echo ($vo["good_detail"]); ?></span>
					
				</div>			
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		
	</div>
	
	
	<div class="hot">
		<span>本地服务 </span>
	</div>
	<div>
		<?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods">
				<div class="img">
					<img src="<?php echo ($vo["img"]); ?>">
				</div>
				<div class="text">
					<p class="name"><?php echo ($vo["good_name"]); ?></p>
					
					
					<span >价格: <?php echo ($vo["price"]); ?></span>
					<br>
					<span> 卖家: <?php echo ($vo["username"]); ?></span>
					<br>
					<span >电话: <?php echo ($vo["phone"]); ?></span>
					
					<br>
					
					<br>					
					<span><?php echo ($vo["good_detail"]); ?></span>
					
				</div>			
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	
	
	
</div>
<div class="foot">
	<span>备案号：粤ICP备17044777号</span>
</div>
</body>
</html>