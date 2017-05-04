<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚古镇圈子,我在这里</title>
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/life-pc.css">    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/style.css">	
     <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    	
</head>
<body>
<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>
	<div class="sky" style="height:500px;">
		<div class="clouds_one"></div>
		<div class="clouds_two"></div>
		<div class="clouds_three"></div>
	</div>

	<div class="write">
	
	<?php if($haslogin == 0): ?><a href="<?php echo U('Login/reg');?>"><input type="button"  value="注册"></a>
	<a href="<?php echo U('Login/applogin');?>"><input type="button"  value="登录"></a><?php endif; ?>
	
	<?php if($haslogin == 1): ?>你好,<?php echo ($realname); ?>
		  <input type="button" value="退出" onclick="javascript:out();"><?php endif; ?>
	<input type="button" onclick="javascript:fabiao(<?php echo ($haslogin); ?>);" value="发表">
	<?php if(($level == 2)): ?><a href="<?php echo U('Index/manage');?>"><input type="button" value="管理"> </a><?php endif; ?>
   
	</div>
	<div class="content-head">
		<span>黄姚圈动态</span>
	</div>
<?php if(is_array($arcs)): $i = 0; $__LIST__ = $arcs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="comment">
	   <?php if($vo["level"] == 2): ?><div class="com-date" style="background-color:red">
				<span><?php echo ($vo["real_name"]); ?>|<?php echo ($vo["addr"]); ?>|<?php echo ($vo["realse_time"]); ?></span><br>			
			</div><?php endif; ?>
		<?php if($vo["level"] == 1): ?><div class="com-date">
				<span><?php echo ($vo["real_name"]); ?>|<?php echo ($vo["addr"]); ?>|<?php echo ($vo["realse_time"]); ?></span><br>			
			</div><?php endif; ?>
		<div class="com-main">
		    <p class="des"><?php echo ($vo["a_name"]); ?></p>
		    <div class="">
				<?php echo ($vo["a_content"]); ?>						
		<br></div>	
		<?php if($vo["a_img"] != ''): ?><div class="myimg">
				<img src="<?php echo ($vo["a_img"]); ?>" style="width:100%;height:250px;" >
			</div><?php endif; ?>
		<div class="com-operate">
		<?php if($level == 2 or $vo['id'] == $uid): ?><input type="button" onclick="javascript:delarc(<?php echo ($vo['a_id']); ?>);" value="删除文章"><?php endif; ?>
	   <?php if(($level == 2)): ?><a href="<?php echo U('Index/forbid');?>?id=<?php echo ($vo['id']); ?>"><input type="button" value="禁掉用户"> </a><?php endif; ?>
	   <?php if(($vo['zan_flag'] == 1)): ?><input type="button" value="已赞过">
	   <?php else: ?>
	   	   <input class="zan_click" type="button" onclick="javascript:well(this,<?php echo ($vo['a_id']); ?>,<?php echo ($vo['zan_num']); ?>);" value="点赞"><?php endif; ?>
	   <br>
	     
		</div>
		已有<span class="zan_num" style="color:red;"><?php echo ($vo["zan_num"]); ?></span>人赞过
	  </div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
	
	
<div style="width:90%;margin:0 auto;text-align:right;">	
	<?php echo ($page); ?>
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
function fabiao($in){
	if($in == 1){
		window.location.href = "<?php echo U('Index/fabiao');?>";
	}
	else{
		alert('您需要登录才能在圈子发表哦');
	}
}

function out(){
	    
		window.location.href = "<?php echo U('Login/out');?>";	
}

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