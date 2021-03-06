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
 	<script type="text/javascript" src="/hongsheng/Public/js/ajaxfileupload.js"></script> 
</head>




<body>
<!-- 页面开始 -->
<div class="head">
	<h1>后台管理中心</h1>
</div>
<div class="add-admin-body">
<h3 class="h3">添加商品</h3>	
<div style="padding:20px 100px 10px;">
    <form class="bs-example bs-example-form" role="form">
                   <h4>1 卖家信息</h4>
        <br>
        <div class="input-group">
            <span class="input-group-addon">商家称呼</span>
            <input type="text" id="in-name" class="form-control" placeholder="">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon">联系电话</span>
            <input type="text" id="in-phone" class="form-control" placeholder="">
        </div>
        <br>
       
       
        <h4>2 商品详情</h4>
        <br>
        <div class="input-group">
            <span class="input-group-addon">商品名称</span>
            <input type="text" id="goodsname" class="form-control" placeholder="">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon">商品介绍</span>
            <input type="text" id="s-detail" class="form-control" placeholder="">
        </div>
        <br>
        <div class="input-group">     
            <span class="input-group-addon">商品价格</span>
            <input type="text" id="s-price" class="form-control" placeholder="">
        </div>
        <br>
        
    </form>
     <br>
	<form class="form-inline" role="form">	  
	  <div class="form-group">
	     <h4>请上传商品图片(仅限jpg图片)</h4>
	    <input type="file" name="mfile" id="file1" onchange="javascript:ajaxFileUpload();">
	  </div>	  	 
	</form>   
</div>
<div class="goods-img">
   <img id="img_id" src="" >
   <input type="hidden" id="hidimg">
</div>	
<br>
<div class="add-submit">
   <button type="button" id="msubmit" class=" btn btn-success">提交信息</button>
   <button type="button" onclick="javascript:history.back();" class=" btn btn-success">返回</button>
</div>	
</div>





<div class="foot-pc"> 版权所有 沪ICP备1111111111号</div>
<!-- 页面结束 -->
<script type="text/javascript">
$(function(){	
	$('#myCarousel1').carousel({
		interval: 3000
	});
	
	$(".add").click(function(){
		window.location.href="<?php echo U('Index/add');?>";				
	});
	$("#msubmit").click(function(){
		var username = $("#in-name").val();	
		var phone = $("#in-phone").val();	
		var goodsname = $("#goodsname").val();	
		var detail = $("#s-detail").val();	
		var price = $("#s-price").val();	
		var imgurl = $("#hidimg").val();	
		if(username == '' || phone==''||goodsname==""||detail==""||price==""||imgurl=="")
		{
			alert("请填写完整信息后再提交");
			return;
		}
		$.ajax({
			url:"<?php echo U('Index/addGoods');?>",
			data:{
				username:username,
				phone:phone,
				goodsname:goodsname,
				detail:detail,
				price:price,
				imgurl:imgurl,
			},
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.res > 0)
					{
						window.location.href = data.url;
					}
				else{
					alert("add error");
				}
			},
			error:function(data){
				
					alert("ajax error");
				
			},
		});
		
	});
	
	
	
	 
	
 	
	
});
function ajaxFileUpload() {	 
    $.ajaxFileUpload(
        {
            url: "<?php echo U('Index/upload');?>", //用于文件上传的服务器端请求地址
            secureuri : false,
    		
    		type: "POST", 

            fileElementId: 'file1', //文件上传域的ID
            dataType: 'json', //返回值类型 一般设置为json
            success: function (data, status)  //服务器成功响应处理函数
            {
            	
                $("#img_id").prop("src", "http://"+data.imgurl);   
                $("#hidimg").val(data.path);   
            }
        }
    )
   
}
</script>
</body>
</html>