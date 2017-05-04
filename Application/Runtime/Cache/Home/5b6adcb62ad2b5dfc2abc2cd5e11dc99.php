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
	<h1>黄姚集市网</h1>
</div>
<div class="pc-login">		
	
<div style="padding: 100px 100px 10px;">
    <form class="bs-example bs-example-form" role="form">
       
        <br>
        <div class="input-group">
            <span class="input-group-addon">账号</span>
            <input type="text" id="name" class="form-control" placeholder="请输入账号">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon">密码</span>
            <input type="password" id="pwd" class="form-control" placeholder="请输入密码">
        </div>
         <br>
         <p class="alert"></p>
          <br>
        <button type="button" class=" btn btn-success go">登录</button>
    </form>
</div>
	
	
</div>
<div class="foot-pc"> 版权所有 沪ICP备1111111111号</div>
<!-- 页面结束 -->
<script type="text/javascript">
$(function(){	
	$('#myCarousel1').carousel({
		interval: 3000
	});
	
	$(".go").click(function(){
		$('.alert').html('');
		var name = $('#name').val();
		var pwd = $('#pwd').val();
		
		if(name== '' || $('#pwd').val() == '')
		{
			$('.alert').html('用户名或密码不能为空');
			return;
		}
		$.ajax({
			url:"<?php echo U('Login/checkUser');?>",
			data:{
				name:name,
				pwd:hex_md5(pwd),
			},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.res == 0)
					{
						window.location.href = data.url;
					}
				else{
					alert("用户名或密码错误");
				}
			},
			error:function(data){
				
					alert("5555");
				
			},
		});
		
		
		
	});
	
 	
	
});
</script>
</body>
</html>