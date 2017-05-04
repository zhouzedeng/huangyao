<?php
namespace Home\Controller;
use Home\Controller\BaseController;

class AdminController extends BaseController 
{
    /**
     * admin index
     */
    public function index(){
    
        $query = array();
        $type = I('type',1);
        if($type == 0)
        {
            $query['etime'] = array('gt',date('Y-m-d',time()));
            $query['status'] = array('eq',1);
            $query['is_hot'] = array('eq',0);
            $query['type'] = array('eq',2);
        }
        else if($type == 1)
        {
            $query['etime'] = array('gt',date('Y-m-d',time()));
            $query['status'] = array('eq',1);
            $query['is_hot'] = array('eq',0);
            $query['type'] = array('eq',1);
        }
        else if($type == 2)
        {
            $query['etime'] = array('gt',date('Y-m-d',time()));
            $query['status'] = array('eq',0);
        }
        else if($type == 3)
        {
            $query['etime'] = array('lt',date('Y-m-d',time()));
        }else{
           $query['etime'] = array('gt',date('Y-m-d',time()));
           $query['status'] = array('eq',1);
           $query['is_hot'] = array('eq',1);
        }
    
    
        $totalRows = M('goods')->where($query)->count();
        $page = new Page($totalRows,5);
    
        $list = M('goods')->where($query)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
        
        foreach ($list as $k=>$v)
        {
            $list[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1);
            $list[$k]['day'] = intval($this->diffBetweenTwoDays(date('Y-m-d',time()), $v['etime']));
        }
    
    
    
        $show = $page->show();
     
        $this->assign('list',$list);
        $this->assign('type',$type);
        $this->assign('page',$show);
    
        $this->display();
    }
    
    /**
     * add goods
     */
    
    public function add(){
        $this->display();
    }
    
    /**
     * file upload
     */
    public function upload(){
        $files = $_FILES['mfile'];
        if($files['error'] == 0)
        {
            $path = "./Public/image/";
            $nimg = uniqid().".jpg";
            $res = move_uploaded_file($files['tmp_name'],$path.$nimg);
            $img = new Image();
            $img->open($path.$nimg);
            $img->thumb(50, 50);
            $img->save("./Public/image/tumb_".$nimg); 
            
        }
        
       
        
    
    
        echo json_encode(array('path'=>$path.$nimg,'imgurl'=>$_SERVER['SERVER_NAME'].__ROOT__."/Public/image/".$nimg));
    }
     
    
    /**
     * 添加商品
     */
    public function addGoods()
    {
    
        $username = I('username','');
        $phone = I('phone','');
        $goodsname = I('goodsname','');
        $detail = I('detail','');
        $price = I('price','');
        $imgurl = I('imgurl','');
        $tt = I('tt','');
    
        $res = M('goods')->add(array(
            'good_name'=> $goodsname,
            'phone'=> $phone,
            'username'=>$username,
            'good_detail'=>$detail,
            'price'=>$price,
            'img'=>$imgurl,
            'ctime'=>date('Y-m-d H:i:s',time()) ,
            'etime'=>date('Y-m-d H:i:s',strtotime("+30days")) ,
            'type'=>$tt
        ));
    
        echo json_encode(array('res'=>$res,'url'=>U('Admin/index')));
    }
    /**
     * del
     *
     */
    public function del()
    {
    
        $id = I('id','');
        $type = I('type','');
        $goods = M('goods')->where("id=".$id)->find();
        unlink($goods['img']);
        $res = M('goods')->where("id=".$id)->delete();
        redirect(U('Admin/index')."?type=".$type);
    
    }
    
    /**
     * 下架
     *
     */
    public function down()
    {
    
        $id = I('id','');
        $type = I('type','');
        $res = M('goods')->where("id=".$id)->save(array('status'=>0));
        redirect(U('Admin/index')."?type=".$type);
    
    }
    
    /**
     * 上架
     *
     */
    public function up()
    {    
        $id = I('id','');
        $res = M('goods')->where("id=".$id)->save(array('status'=>1));
        redirect(U('Admin/index')."?type=2");    
    }
    
    /**
     * 续费
     *
     */
    public function addtime()
    {
    
        $id = I('id','');
        $res = M('goods')->where("id=".$id)->save(array(
            'ctime'=>date('Y-m-d H:i:s',time()) ,
            'etime'=>date('Y-m-d H:i:s',strtotime("+30days")) ,
    
        ));
        $res = M('goods')->where("id=".$id)->setInc('pay_num');
        redirect(U('Admin/index')."?type=3");
    
    }
    
    public function sethot()
    {
    
        $id = I('id','');
        $type = I('type','');
        $res = M('goods')->where("id=".$id)->save(array(
            'is_hot'=>1                 
        ));
       
        redirect(U('Admin/index')."?type=".$type);
    
    }
    public function unhot()
    {
    
        $id = I('id','');
        $res = M('goods')->where("id=".$id)->save(array(
            'is_hot'=>0
        ));
         
        redirect(U('Admin/index')."?type=4");
    
    }
    
   
    
    
        
   
    
}
