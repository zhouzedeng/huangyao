<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚古镇</title>
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">       
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">      
     <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>   
     <script type="text/javascript" src="/hongsheng/Public/js/md5.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />    	
<style>
.reg {
	margin-top:60px;
	
}
.reg input{
	width:70%;
	height:30px;
	margin-top:5px;
}
.reg span{
	font-size:18px;
	color:#595;
}
.foot{
	margin-bottom:0px;
	position:fixed;
	bottom:0;
}
#ok{
	width:35%;
	font-size:18px;
	
}
.a1{
	margin-top:20px;
	text-align:center;
}
</style>
</head>
<body>
<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>
<div></div>
<div class="reg" style="width:90%;margin:0 auto;">
    <h2>登录</h2>
	<span>账号</span>:<input type="text" maxlength="10" id="username" placeholder="请输入账号" ><br>
	<span>密码</span>:<input type="password" id="pwd1" placeholder="请输入密码"><br>	
</div>	
<div class="a1">
	<input id="ok" type="button" onclick="javascript:regok();" value="登录" >
</div>	
<div class="foot">
	<span>备案号：粤ICP备17044777号</span>
</div>




<script>
function regok(){
	var username = $('#username').val();
	var pwd1 =$('#pwd1').val();


	
	if(username == ''|| pwd1== '')
	{
		alert('请填写完信息后再确定!');
		return;
	}
	
	var len = pwd1.length;
	if(len > 10 || len < 6)
	{
		alert('密码长度为6-10位数！');
		return;
	}
	
	$.ajax({
		url:"<?php echo U('Login/logindata');?>",
		data:{
			username:username,
			pwd:hex_md5(pwd1),
		},
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.res == 0)
			{
				
				window.location.href="<?php echo U('Index/life');?>";
			}
			else{
				alert(data.msg);
			}
		}
		
	});
		
}


$(function(){
	
});


</script>

















</body>
</html>