<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?php echo ($arcs['a_name']); ?> | <?php echo ($arcs['real_name']); ?> | 黄姚生活圈</title>
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/life-app.css">    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/style.css">	
     <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    	
</head>
<body>
<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>
	<div class="sky">
		<div class="clouds_one"></div>
		<div class="clouds_two"></div>
		<div class="clouds_three"></div>
	</div>

	<div class="write">	
	    <a href="<?php echo U('Index/life');?>"><input type="button" value="返回黄姚圈"> </a> 
	</div>
	
	<div style="text-align:center;">
		<h2><?php echo ($arcs['a_name']); ?></h2>
		<span><?php echo ($arcs['real_name']); ?>|<?php echo ($arcs['addr']); ?>|<?php echo ($arcs['realse_time']); ?></span>
		<div style="border:1px solid #595;width:100%"></div>	
		<p><?php echo ($arcs['a_content']); ?></p>	
		<div class="myimg">
				<img src="<?php echo ($arcs["a_img"]); ?>" style="width:100%;height:250px;" >
			</div>
			<div style="border:1px solid #595;width:100%;margin-top:20px;"></div>
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



function delarc(id){
	$.ajax({
		url:"<?php echo U('Index/delarc');?>",
		data:{
			id:id,
		},
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.res == 0)
			{
				alert('已删除！');
				window.location.href="<?php echo U('Index/life');?>";
			}
			else{
				alert(data.msg);
			}
		}
		
	});
}


function well(self,id,num){
    var obj = $(self);
	var num = num+1;
	$.ajax({
		url:"<?php echo U('Index/zan');?>",
		data:{
			id:id,
		},
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.res == 0)
			{		
				
				obj.parent('div').next('span').html(num);				
				obj.val('已赞过');
				obj.removeAttr('onclick');
			}
			else{
				alert(data.msg);
			}

		}
		
	});
	
}




$('.sub'+<?php echo ($menu); ?>).css('background-color','#595');
</script>
</body>
</html>