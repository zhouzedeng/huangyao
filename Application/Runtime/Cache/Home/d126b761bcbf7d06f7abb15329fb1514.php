<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚古镇</title>
     <link rel="stylesheet" type="text/css" href="/hongsheng/Public/css/public-app.css">       
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">      
     <script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>   
     <script type="text/javascript" src="/hongsheng/Public/js/md5.js"></script> 
     <script type="text/javascript" src="/hongsheng/Public/js/ajaxfileupload.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />    	
<style>
.reg {
	margin-top:60px;	
}
.reg #aname{
	width:90%;
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
	margin-bottom:40px;
}
.a1{
	margin-top:20px;
	text-align:center;
}
.xuzhi{
	border:1px solid #595;
	margin-top:10px;
}
textarea{

	width:90%;
}
img{
	width:300px;
	height:300px;
	overflow:hidden;
}
</style>
</head>
<body>
<div class="head">
	<span class="span1">黄姚古镇云平台</span>	
</div>
<div></div>
<div class="reg" style="width:90%;margin:0 auto;">
    <div class="xuzhi">
	    <span>发布须知：<br>
	             1.黄姚圈，为了方便为黄姚人交流、沟通服务而诞生。<br>  
	             2.您可以发布新闻、情感、个人生活、体育赛事、爱心公益、正能量等等的文章或说说       <br>      
	             3.对于发布暴力、赌博、色情的言论，轻者封号，重者移交司法机关！<br> 
	             4.欢迎大家举报上述行为的账号，一经查出，从重处罚!<br> 
	             5.举报联系方式：微信号(aaa729952708)
	    </span>
    </div>
    <div class="xuzhi">
	    <span>通知：<br>
	             黄姚生活圈上线啦!!
	    </span>
    </div>
    <h2>发表</h2>
	<span>文章标题</span>:<br><input type="text" maxlength="30" id="aname" placeholder="请输入30字以内的标题" ><br>	
	<span>文章正文</span>:<br><textarea rows="30" id="acontent" placeholder="请输入500字以内的正文" maxlength="500"></textarea><br>	
	<span>上传配图(选填)</span>:<br><input type="file" onchange="javascript:return ajaxFileUpload();"  id="fileid" name="files"><br>
	<p id="tishi"></p>
	<img id="img_id" src="" >
    <input type="hidden" id="hidimg">
	
</div>	

<div class="a1">
	<input id="ok" type="button" onclick="javascript:regok();" value="发表" >
</div>	
<div class="foot">
	<span>备案号：粤ICP备17044777号</span>
</div>




<script>
function ajaxFileUpload() {	 
    $.ajaxFileUpload(
        {
            url: "<?php echo U('Index/upload');?>", //用于文件上传的服务器端请求地址
            secureuri : false,    		
    		type: "POST", 
            fileElementId: 'fileid', //文件上传域的ID
            dataType: 'json', //返回值类型 一般设置为json
            success: function (data, status)  //服务器成功响应处理函数
            {
            	
                $("#img_id").prop("src", "http://"+data.imgurl);   
                $("#tishi").html('已成功上传图片！');
                $("#tishi").css('color','blue');
                $("#hidimg").val(data.path);   
            }
        }
    )
   
}


function regok(){
	var aname= $('#aname').val();
	var acontent =$('#acontent').val();
	var peitu =$('#hidimg').val();

	
	if(aname == ''|| acontent== '')
	{
		alert('请填写完信息后再确定!');
		return;
	}
	
	var len = aname.length;
	if(len > 30 )
	{
		return;
	}
	
	$.ajax({
		url:"<?php echo U('Index/saveActicle');?>",
		data:{
			aname:aname,
			acontent:acontent,
			peitu:peitu
		},
		dataType:'json',
		type:'post',
		success:function(data){
			if(data.res == 0)
			{
				alert('发表成功！');
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