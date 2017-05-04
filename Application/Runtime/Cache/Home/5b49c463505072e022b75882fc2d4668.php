<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚古镇圈子,我在这里</title>
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">           
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/bootstrap/css/bootstrap.css">   
    <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>  
    <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/bootstrap.js"></script>    		
</head>
<body>
<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>
<p>注册总人数  :  <?php echo ($users); ?>人</p>
<p  style= text-indent:2em;>  管理人员 :  <?php echo ($users1); ?>人</p>
<p  style= text-indent:2em;>  普通会员  :  <?php echo ($users2); ?>人</p>
<div style="width:99%;border:1px solid;"></div>
<p>文章总数  :  <?php echo ($arcs); ?>篇</p>
<p  style= text-indent:2em;>  系统文章  :  <?php echo ($arcs1); ?>篇</p>
<p  style= text-indent:2em;>  会员文章  :  <?php echo ($arcs2); ?>篇</p>
<div style="width:99%;border:1px solid;"></div>
<p>浏览人数  :  <?php echo ($visit_num); ?>人</p>
<p>访问次数  :  <?php echo ($visit_all['n']); ?>人</p>
<div style="width:99%;border:1px solid;"></div>
<h2>会员管理</h2>
<div class="user">
	<table class="table table-bordered table-striped">	
			  
		  <thead>
		    <tr>
		      <th style="width:20%;">编号</th>
		      <th style="width:20%;">用户昵称</th>
		      <th style="width:20%;">地址</th>
		      <th style="width:20%;">账号状态</th>		       
		      <th style="width:20%;">操作</th>

		    </tr>
		  </thead>
		  <tbody>
		  <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
		      <td><?php echo ($vo["id"]); ?></td>
		      <td><?php echo ($vo["real_name"]); ?></td>
		      <td><?php echo ($vo["addr"]); ?></td>
		      <?php if($vo["status"] == 1): ?><td>正常</td>
		      	<td><button onclick="javascript:forbid('<?php echo ($vo["id"]); ?>')">禁用</button></td>	
		      <?php else: ?>
		        <td>已禁用</td>
		        <td><button onclick="javascript:qiyong('<?php echo ($vo["id"]); ?>')">启用</button></td><?php endif; ?>
		      
		          		      		     
		    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		  </tbody>
		</table>
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
function forbid(id){
	
	$.ajax({
		url:"<?php echo U('Index/forbid');?>",
		data:{
			id:id,
		},
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.res == 0)
			{
				
				window.location.reload();
			}
			else{
				alert(data.msg);
			}
		}
		
	});
};
function qiyong(id){
	
	$.ajax({
		url:"<?php echo U('Index/qiyong');?>",
		data:{
			id:id,
		},
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.res == 0)
			{
				
				window.location.reload();
			}
			else{
				alert(data.msg);
			}
		}
		
	});
};


</script>
</body>
</html>