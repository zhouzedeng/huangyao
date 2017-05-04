<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>黄姚人自己的网上集市</title>
    <meta name="keyword" content="<?php echo ($keyword); ?>" />
    <meta name="description" content="<?php echo ($description); ?>" />        
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/hongsheng/Public/bootstrap/css/bootstrap.css">       	
	<script type="text/javascript" src="/hongsheng/Public/bootstrap/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="/hongsheng/Public/bootstrap/js/bootstrap.js"></script>
 <style>
body
{
	background-color:#fff;	
	width:100%;		
}
body::-webkit-scrollbar{
width:0;
height:0;
}
body::scrollbar{
width:0;
height:0;
}
a {text-decoration: none}
.btn{
	background-color:#66CDAA;
}

.head {
	
	margin:0;
	padding:0;
	width:100%;	
	height:100px;	
	background-color:#66CDAA;
	
}


.head h1{
	font-size:65px;
	color:#fff;
	line-height:100px;
	margin:0;
	padding:0;	
}
.hs-contain{
	width:100%;	
	margin:0;
	padding:0;	
}
.all-goods{
	margin-top:50px;
	font-size:60px;
	color:#66CDAA;
	
}

.my-line{
	border:12px solid #66CDAA;    
	width:100%;
	z-index:999;
	margin-top:30px;
	margin-bottom:30px;
}
.my-line2{
	border:3px solid #6CA6CD;    
	width:20%;
	z-index:999;
}
.row{
	
	margin-top:10px;
	width:100%;
	
}

.phone,.price,.name{
	font-size:35px;
	
	
}
.descrip{
	font-size:40px;
	
}
.myrow{
	
}

.main-de{
	font-size:50px;
	color:red;
}
.btn-lg{
	font-size:60px;
	height:100px;
}

.aa{
	
	margin-top:3px;
	font-size:40px;
	background-color:#fff;
	color:#000;
	
}

.page-mo a{
	text-decoration: none;
	margin-top:20px;
	margin-left:10px;
}
.page-mo{
	width:80%;
	margin:0 auto;
	
	text-align:center;
}

.notice{
	border:1px solid #000 ;
	width:100%;
	height:300px;
	background-color:#eee;
}

.data{
	border:1px solid #000 ;
	width:100%;
	height:8 0px;
	background-color:#eee;
}

.myrow{
	border:2px solid ;
}




#myCarousel1{
	width:100%;	
	margin:0;
	padding:0;	
}

#myCarousel1 .carousel-inner .item img{	
	height:600px;
	width:100%;	
	
}
#myCarousel1 .carousel-inner .item{
	clear:both;
}
.thumbnail img{
	width:100%;	
	height:400px;	
}
.foot{
	height:100px;
	width:102%;	
	background-color:#000;
	color:#fff;
	margin-top:20px;
	text-align:center;
	line-height:100px;
	font-size:30px;
}
.foot-pc{
	height:40px;
	width:100%;	
	background-color:#66CDAA;
	color:#fff;
	margin-top:20px;
	text-align:center;
	line-height:40px;
	font-size:20px;
	position:fixed;
	bottom:0px;
	
}

</style>
</head>
<body >
<!-- 页面开始 -->
<div class="head">
	<h1>黄姚集市网</h1>
</div>
<div class="hs-web">		
	<!-- 内容开始 -->
	<div class="hs-contain">
		<!-- 轮播图开始 -->
		<div class="hu">
		    <div class="lunbo">		  	
				<div id="myCarousel1" class="carousel slide">
				   
				    <ol class="carousel-indicators">
				        <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
				        <li data-target="#myCarousel1" data-slide-to="1"></li>
				       
				    </ol>   
				  
				    <div class="carousel-inner">
				    	
				        <div class="item active">
				        <a >
				            <img src="/hongsheng/Public/image/l1.jpg" alt="First slide">
				            
				          </a>
				        </div>
				       
				        <div class="item">
				        <a >
				            <img src="/hongsheng/Public/image/l2.jpg" alt="Second slide">
				            
				            
				            </a>
				        </div>
				       
				    </div>
				   
				</div>	
				<div class="clearfloat"></div> 	  	
		  </div> 
		</div><!-- 轮播图结束 -->
	<h1 class="all-goods">平台通知</h1>
	<div class="notice">
		
		
		<h1 style="color:#f00"><?php echo ($notice["content"]); ?></h1>
		<h1 style="color:red">百姓赶集总次数：<?php echo ($user["look_num"]); ?>次</h1>		
		<h1 style="color:red">通知日期 ： <?php echo ($notice["notice_time"]); ?>  
		
		
		
		
	</div>		
	<!-- <div class="data">
		<h1 style="color:#f00">平台浏览总数：<?php echo ($user["look_num"]); ?>次</h1>
	</div> -->
	
	
	<h1 class="all-goods">平台商品</h1>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class=" row">
    		<div class="col-xs-12 col-sm-12 col-md-12">
    		 <volist name="list" id="vo">
			   
			    <div class="myrow thumbnail">
            		<img src="<?php echo ($vo["img"]); ?>" alt="通用的占位符缩略图">
            		<div class="caption ">
                		<h3 class="main-de"><?php echo ($vo["good_name"]); ?></h3>
                		
                		
                		
                		<p>
                    		<span class="aa  phone" role="button">
                        		联系电话：<?php echo ($vo["phone"]); ?>
                    		</span>  <br>  
                    		<span class=" aa  name" role="button">
                        		卖家昵称：<?php echo ($vo["username"]); ?>
                    		</span>  <br>
                    		<span class="aa  price" role="button">
                        		商品价格：<?php echo ($vo["price"]); ?>
                    		</span>  <br>
                    		<span class="aa  price" role="button">
                        		售卖时间：剩余<?php echo ($vo["day"]); ?>天
                    		</span>  <br>
                    		<span class="aa  price" role="button">
                        		商品描述：<?php echo ($vo["good_detail"]); ?>
                    		</span>  
                    		               		
                		</p>
           		    </div>
            </div>
		  
        		
        </div>          
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
		
</div>
	<div class="page-mo">
	     
		<?php if($cur != 1): ?><a  href="<?php echo U('Index/index');?>?p=1"><button type="button" class="btn-lg  btn btn-success">首页</button></a>
			<a  href="<?php echo U('Index/index');?>?p=<?php echo ($prev); ?>"><button type="button" class="btn-lg  btn btn-success">上页</button></a><?php endif; ?>
		<a ><button type="button" class="btn-lg  btn btn-success">第<?php echo ($cur); ?>页</button></a>
		<?php if($flag == 1): ?><a  href="<?php echo U('Index/index');?>?p=<?php echo ($next); ?>"><button type="button" class="btn-lg  btn btn-success">下页</button></a><?php endif; ?>
	</div>
</div>
<div class="foot"> 版权所有 </div>
<!-- 页面结束 -->
<script type="text/javascript">
$(function(){	
	$('#myCarousel1').carousel({
		interval: 5000
	})	;
	
 	
	
});
</script>
</body>
</html>