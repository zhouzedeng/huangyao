<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚人的生活圈</title>
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/goods-app.css">    
  <!--   <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/style.css">   -->      
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
      <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />         		
</head>
<body>	
<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>
<!-- 代码部分begin -->
<!-- <div class="sky">
	<div class="clouds_one"></div>
	<div class="clouds_two"></div>
	<div class="clouds_three"></div>
</div> -->
<!-- 代码部分end -->
	<div class="list">	
	    <div class="search">
	    	<input type="text"  id="con" value="<?php echo ($con); ?>"><button onclick="javascript:search()" id="s-btn">搜索</button>
	    </div>
	    <div class="eight">
	    
			<div class="block">							
    		 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="sub">
			    <a href="<?php echo U('Index/mdetail');?>?id=<?php echo ($vo["id"]); ?>">
					<div class="pic">
						<img src="<?php echo ($vo["img"]); ?>">
					</div>
					<div class="span"><?php echo ($vo["good_name"]); ?></div>
					</a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?> 
												
			</div>
			<div class="page">
	    	 <?php echo ($page); ?>
			</div>
		</div>
		
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



<script type="text/javascript">
$('.sub'+<?php echo ($menu); ?>).css('background-color','#595');


function search()
{
	 var condition = document.getElementById("con").value;
		
	window.location.href="<?php echo U('Index/mgoods');?>?con="+condition; 
	 
}	
</script>

</body>
</html>