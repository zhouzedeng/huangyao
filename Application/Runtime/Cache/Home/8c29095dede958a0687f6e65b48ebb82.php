<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚人自己的网上集市</title>
    <meta name="keyword" content="<?php echo ($keyword); ?>" />
    <meta name="description" content="<?php echo ($description); ?>" />     
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Cache" content="no-cache">   
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/bootstrap/css/bootstrap.css">   
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/mo-common.css">    	
	<script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="/hongsheng/Public/bootstrap/js/bootstrap.js"></script>
 	<script type="text/javascript" src="/hongsheng/Public/js/md5.js"></script> 
</head>






<body>
<!-- 页面开始 -->
<div class="head">
	<h1>后台管理中心</h1>
</div>
<div class="admin-menu">
<a href="<?php echo U('Index/admin');?>?type=1"><button type="button" class="menu1 btn btn-success">全部上架商品</button></a><br>
<a href="<?php echo U('Index/admin');?>?type=2"><button type="button" class="menu2 btn btn-success">全部下架商品</button></a><br>
<a href="<?php echo U('Index/admin');?>?type=3"><button type="button" class="menu3 btn btn-success">全部到期商品</button></a>

</div>
<div class="admin-body">
	<div class="bodyhead">
	    <button type="button" class="add btn btn-success">+添加商品</button> 
		<input type="text" class="find">
		<button type="button" class="search btn btn-success">搜索</button>			           
	</div>

	<div>				
		<table class="table table-bordered table-striped">	
			  
		  <thead>
		    <tr>
		      <th style="width:30px;">编号</th>
		      <th style="width:130px;">商品名称</th>
		      <th style="width:130px;">卖家姓名</th>
		      <th style="width:130px;">联系电话</th>		       
		      <th style="width:130px;">价格</th>
		      <th style="width:100px;">续费次数</th>
		      
		      <th style="width:200px;">展示时间</th>	
		      <th style="width:200px;">剩余展示天数</th>
		      <th style="width:200px;">图片</th>			       
		      <th >操作</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		      <td><?php echo ($vo["id"]); ?></td>
		      <td><?php echo ($vo["good_name"]); ?></td>
		      <td><?php echo ($vo["username"]); ?></td>
		      <td><?php echo ($vo["phone"]); ?></td>
		      <td><?php echo ($vo["price"]); ?></td>
		      <td><?php echo ($vo["pay_num"]); ?>次</td>
		     
		      <td><?php echo ($vo["ctime"]); ?><br>至<br><?php echo ($vo["etime"]); ?></td>
		      <td><?php echo ($vo["day"]); ?>天</td>
		       <td><img src="<?php echo ($vo["img"]); ?>" alt="通用的占位符缩略图"></td>
		      <td>
		      <a href="<?php echo U('Index/del');?>?id=<?php echo ($vo["id"]); ?>&type=<?php echo ($type); ?>" class="del">删除</a>
		      <br>
		      <a href="<?php echo U('Index/down');?>?id=<?php echo ($vo["id"]); ?>" class="down">下架</a>
		      <br>
		      <a href="<?php echo U('Index/up');?>?id=<?php echo ($vo["id"]); ?>" class="up">上架</a>
		      <br>
		      <a href="<?php echo U('Index/addtime');?>?id=<?php echo ($vo["id"]); ?>" class="addtime">续费</a></td>
		    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		  </tbody>
		</table>
		<?php echo ($page); ?>		
	</div>
	
		
	
</div>





<div class="foot-pc"> 版权所有 沪ICP备1111111111号</div>
<!-- 页面结束 -->
<script type="text/javascript">
$(function(){	
	var type = <?php echo ($type); ?>;
	if(type == 1)
	{
		$('.menu1').css('background','blue');
		$('.del').hide();
		$('.up').hide();
		$('.addtime').hide();
	}
	if(type == 2)
	{
		$('.menu2').css('background','blue');
		$('.add').hide();
		
		$('.down').hide();
		$('.addtime').hide();
	}
	if(type == 3)
	{
		$('.menu3').css('background','blue');
		$('.add').hide();
       	
		$('.down').hide();
		$('.up').hide();
		
	}
	$('#myCarousel1').carousel({
		interval: 3000
	});
	
	$(".add").click(function(){
		window.location.href="<?php echo U('Index/add');?>";				
	});
	
 	
	
});
</script>
</body>
</html>