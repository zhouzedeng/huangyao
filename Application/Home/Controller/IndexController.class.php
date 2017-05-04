<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
use Think\Image;

class IndexController extends Controller 
{
    function __construct()
    {
        parent::__construct();
        $ip = $_SERVER['REMOTE_ADDR'];
        $Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
        $addr = iconv('gbk','utf-8',$area['country'].$area['area']);       
        $res = M('user_visit_log')->where(array('ip'=>$ip))->find();
        
        if(empty($res)){            
            M('user_visit_log')->add(array('ip'=>$ip,'addr'=>$addr));
        }else{
            M('user_visit_log')->where(array('ip'=>$ip))->setInc('num');
        }
              
    }
    
    /**
     *
     * @return boolean
     */
    public function isMobile(){
        $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    
        $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
        $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160��160','176��220','240��240','240��320','320��240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');
    
        $found_mobile=$this->CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
        $this->CheckSubstrs($mobile_token_list,$useragent);
    
        if ($found_mobile){
            return true;
        }else{
            return false;
        }
    }
    
    public function CheckSubstrs($substrs,$text){
        foreach($substrs as $substr)
            if(false!==strpos($text,$substr)){
            return true;
        }
        return false;
    }
    /**
     * web index
     */
    public function index()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') || $this->isMobile()) 
        {
           $this->assign('menu',1);
            $this->mobile();                     
        }
        else
        {      
            
            $this->pc();
        }
    }
    
    /**
     * 检查是否登录
     */
    public function logined()
    {
        $act = I('t');
        if($act == 'login')
        {
            $uid = session('uid');
            if(empty($uid))
            {
                redirect(U('Login/index'));
            }
            else
            {
                redirect(U('Admin/index'));
            }
        }
    }
    
    /**
     * 商品列表
     */
    public function goodslist()
    {
        $ishot = I('hot',0);
        if($ishot == 1)
        {
            $query['is_hot'] = array('eq',1);
        }
        else{
            $query['is_hot'] = array('eq',0);
        }
        $query['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
        $query['status'] = array('eq',1);   //必须是上架状态
                
        $totalRows = M('goods')->where($query)->count();
        $page = new Page($totalRows,8);
        
        $list = M('goods')->where($query)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
         
        foreach ($list as $k=>$v)
        {
            $list[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1);
            $list[$k]['day'] = intval($this->diffBetweenTwoDays($v['ctime'], $v['etime']));
        }                       
        $show = $page->show();             
        $this->assign('list',$list);
        $this->assign('hot',$ishot);
        $this->assign('page',$show);
        $this->assign('menu',2);
        $this->display();
    }
    
    /**
     * 规则
     */
    public function text()
    {
        
        $this->display();
    }
    /**
     * 通知
     */
    public function notice()
    {
    
        $notice = M('notice')->order('id desc')->find();
        $this->assign('notice',$notice);
        $this->display();
    }
    
    
    /**
     * 电脑端
     */
    public function pc()
    {
       $this->logined();
       $query['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
       $query['status'] = array('eq',1);   //必须是上架状态
       //获取热推商品最新4个       
       $query['is_hot'] = array('eq',1);
       $hotlist = M('goods')->where($query)->limit(4)->order('id desc')->select();
       foreach ($hotlist as $k=>$v)
       {
           $hotlist[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1);
           $hotlist[$k]['day'] = intval($this->diffBetweenTwoDays($v['ctime'], $v['etime']));
       }
       
       //获取大众商品最新4个
       $query2['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
       $query2['status'] = array('eq',1);   //必须是上架状态
       $query2['is_hot'] = array('eq',0);
       $query2['type'] = array('eq',1);
       $list = M('goods')->where($query2)->limit(4)->order('id desc')->select();
       
       foreach ($list as $k2=>$v2)
       {
           $list[$k2]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v2['img'],1);
           $list[$k2]['day'] = intval($this->diffBetweenTwoDays($v2['ctime'], $v2['etime']));
       }
       
       //获取人气最高的商品4个
       $query3['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
       $query3['status'] = array('eq',1);   //必须是上架状态
       $query3['is_hot'] = array('eq',0);
       $query3['type'] = array('eq',2);
       $list2 = M('goods')->where($query3)->limit(4)->order('good_click desc')->select();
       foreach ($list2 as $k3=>$v3)
       {
           $list2[$k3]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v3['img'],1);
           $list2[$k3]['day'] = intval($this->diffBetweenTwoDays($v3['ctime'], $v3['etime']));
       }
       
       
      
       $this->assign('hotlist',$hotlist);
       $this->assign('list',$list);
       $this->assign('list2',$list2);
       
       
       $this->display('pc');
    }
    
    /**
     * 手机端
     */
    public function mobile()
    {
        $next_flag = 1;
        $page = I('p',1);
        $rows = I('c',5);
        $query = array();
        $query['etime'] = array('gt',date('Y-m-d',time()));
        $query['status'] = array('eq',1);
        
        $count = M('goods')->where($query)->count();
        $e = ceil($count/$rows);
        if($page >= $e){
            $next_flag = 0;
        }
        
        $list = M('goods')->where($query)->limit(($page-1)*$rows,$rows)->order('id desc')->select();
        
        foreach ($list as $k=>$v)
        {
            $list[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1,14)."tumb_".substr($v['img'],15);
            $list[$k]['day'] = intval($this->diffBetweenTwoDays($v['ctime'], $v['etime']));
        }
        
        $this->assign('list',$list);
        if($page == 1){
            $prev = 1;
        }else{
            $prev = $page -1;
        }
        
        //通知
        $notice = M('notice')->order('id desc')->find();
        $this->assign('notice',$notice);
        
        //浏览次数
        M('user_visit')->where('id=1')->setInc('look_num');
        $user = M('user_visit')->where('id=1')->find();
        $this->assign('user',$user);
        
        $this->assign('next',$page+1);
        $this->assign('flag',$next_flag);
        $this->assign('prev',$prev);
        $this->assign('cur',$page);
        $this->assign('menu',1);
        $this->display('phone');
    }
    /**
     * 两个日期之差
     * @param unknown $day1
     * @param unknown $day2
     */
    public function diffBetweenTwoDays ($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);
    
        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }else {
            return 0;
        }
        return ($second1 - $second2) / 86400;
    }
    
    
    
    public function hot()
    {
                

        $query['is_hot'] = array('eq',1);               
        $query['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
        $query['status'] = array('eq',1);   //必须是上架状态
        
        $con = I('con','');
        if(!empty($con))
            $query['good_name'] = array('like',"%".$con."%");   
                        
        $totalRows = M('goods')->where($query)->count();
        $page = new Page($totalRows,9);
        
        $list = M('goods')->where($query)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
         
        foreach ($list as $k=>$v)
        {
             $list[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1);
            $list[$k]['day'] = intval($this->diffBetweenTwoDays($v['ctime'], $v['etime']));
        }                       
        $show = $page->show();             
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('con',$con);
        $this->assign('menu',3);
        $this->display();
    }
    
    public function mgoods()
    {
    
    
        $query['is_hot'] = array('eq',0);
        $query['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
        $query['status'] = array('eq',1);   //必须是上架状态
        $query['type'] = array('eq',1);   //1 商品  2 服务
    
        $con = I('con','');
        if(!empty($con))
            $query['good_name'] = array('like',"%".$con."%");
    
        $totalRows = M('goods')->where($query)->count();
        $page = new Page($totalRows,9);
    
        $list = M('goods')->where($query)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
         
        foreach ($list as $k=>$v)
        {
            $list[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1);
            $list[$k]['day'] = intval($this->diffBetweenTwoDays($v['ctime'], $v['etime']));
        }
        $show = $page->show();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('con',$con);
        $this->assign('menu',2);
        $this->display();
    }
    
    public function mservice()
    {
    
    
        $query['is_hot'] = array('eq',0);
        $query['etime'] = array('gt',date('Y-m-d',time()));   //必须是有效期
        $query['status'] = array('eq',1);   //必须是上架状态
        $query['type'] = array('eq',2);   //1 商品  2 服务
        $con = I('con','');
        if(!empty($con))
            $query['good_name'] = array('like',"%".$con."%");
    
        $totalRows = M('goods')->where($query)->count();
        $page = new Page($totalRows,9);
    
        $list = M('goods')->where($query)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
         
        foreach ($list as $k=>$v)
        {
         $list[$k]['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($v['img'],1);
            $list[$k]['day'] = intval($this->diffBetweenTwoDays($v['ctime'], $v['etime']));
        }
        $show = $page->show();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('con',$con);
        $this->assign('menu',3);
        $this->display();
    }
    public function mdetail()
    {
       
        
        $id = I('id','');
       
        $list = M('goods')->where('id='.$id)->find();                
        $list['img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.substr($list['img'],1);
        $list['day'] = intval($this->diffBetweenTwoDays($list['ctime'], $list['etime']));
       
     
        $this->assign('list',$list);         
        $this->display();
    }
    public function life()
    {
        $uid = session('u_uid');
        $l = session('u_level');
        if(empty($uid)){
            $haslogin = 0;
        }else{
            $haslogin = 1;
        }
        
        $totalRows = M('arcticles')
                    ->join('user on user.id = arcticles.a_uid')
                    ->where(array('a_status'=>1,'status'=>1))
                    ->count();
        $page = new Page($totalRows,10);
        
        $arcs = M('arcticles')->field('a_id,id,a_name,a_content,a_img,realse_time,real_name,addr,level')
                ->join('user on user.id = arcticles.a_uid')
                ->where(array('a_status'=>1,'status'=>1))
                ->limit($page->firstRow.','.$page->listRows)
                ->order('a_id desc')
                ->select();
        foreach ($arcs as $k=>$v){
            if(!empty($v['a_img'])){
                $arcs[$k]['a_img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.$v['a_img'] ;
            }
            //求点赞数
            $arcs[$k]['zan_num'] = M('well')->where(array('arc_id'=>$v['a_id']))->count();   

            //已赞过的文章
            $remote = $_SERVER['REMOTE_ADDR'];
            $find = M('well')->where(array('arc_id'=>$v['a_id'],'remote_ip'=>$remote))->find();
            $arcs[$k]['zan_flag'] = 0;
            if($find)
            {
                $arcs[$k]['zan_flag'] = 1;
            }
            
        }
        
        $show = $page->show();
        $this->assign('arcs',$arcs);
        
        $this->assign('menu',4);
        $this->assign('level',$l);
        $this->assign('uid',$uid);
        $this->assign('realname',session('u_realname'));
        $this->assign('haslogin',$haslogin);
        $this->assign('page',$show);
      
        if (strpos($user_agent, 'MicroMessenger') || $this->isMobile())
        {            
            $this->display();
        }
        else
            $this->display('life_pc');
    }
    
    /**
     * visit
     */
    public function getvisit(){
        $num = M('user_visit_log')->count();
        return ($num);
    }

    /**
     * allvisit
     */
    public function getvisitall(){
        $num = M('user_visit_log')->field("sum(num) as n")->find();
        
        return ($num);
    }
    
    /**
     * 发表文章
     */
    public function fabiao()
    {
        if($this->checkuser()){
            $this->display();
        }
        else{
            echo "forbidden!";
        }
    
        
    }
    
    
    /**
     * checkuser
     */
    public function checkuser()
    {
        $uid = session('u_uid');
        if(empty($uid)){
            $haslogin = 0;
        }else{
            $haslogin = 1;
        }
        return $haslogin;
        
    }
   
    
    /**
     * 保存文章数据，需堤防xss攻击。
     */
    public function saveActicle()
    {
        $aname = I('aname','');
        $acontent = I('acontent','');
        
        //xss
        
        $aname = $this->remove_xss($aname);
        $acontent = $this->remove_xss($acontent);
        $peitu = I('peitu','');
        $data = array(
            'a_name'=>$aname,
            'a_content'=>$acontent,
            'a_img'=>$peitu,
            'realse_time'=>date('Y-m-d H:i:s',time()),
            'a_status'=>1,
            'a_uid'=>session('u_uid')                        
        );
        $res = M('arcticles')->add($data);
        if($res > 0)
        {
            echo json_encode(array('res'=>0));
        }
        else{
            echo json_encode(array('res'=>1,'发表失败，请重试!'));
        }
    }
    
    /**
     * file upload
     */
    public function upload(){
     
        $files = $_FILES['files'];
        if($files['error'] == 0)
        {
           $path = "./Public/image/";
            $nimg = uniqid().".jpg";
            //$res = move_uploaded_file($files['tmp_name'],$path.$nimg);
            $img = new Image();
            $img->open($files['tmp_name']);
            $img->thumb(300,300);
            $img->save($path.$nimg);  
            echo json_encode(array('path'=>"/Public/image/".$nimg,'imgurl'=>$_SERVER['SERVER_NAME'].__ROOT__."/Public/image/".$nimg));
        }
        
     
    }
    
    
    
    
    function remove_xss($val) {
        // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
        // this prevents some character re-spacing such as <java\0script>
        // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
        $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
    
        // straight replacements, the user should never need these since they're normal characters
        // this prevents like <IMG SRC=@avascript:alert('XSS')>
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            // ;? matches the ;, which is optional
            // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
    
            // @ @ search for the hex values
            $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
            // @ @ 0{0,7} matches '0' zero to seven times
            $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
        }
    
        // now the only remaining whitespace attacks are \t, \n, and \r
        $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
        $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);
    
        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                        $pattern .= '|';
                        $pattern .= '|(&#0{0,8}([9|10|13]);)';
                        $pattern .= ')*';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
                    // no replacements were made, so exit the loop
                    $found = false;
                }
            }
        }
        return $val;
    }
     
    /**
     * 删除文章
     */
    
    public function delarc()
    {
        if(IS_AJAX){   
            $id = I('id','');
            $a = M('arcticles')->where("a_id=".$id)->find();
            if(!empty($a['a_img'])){
                unlink('.'.$a['a_img']);
            }
            $res = M('arcticles')->where("a_id=".$id)->delete();
            M('well')->where(array('arc_id'=>$id))->delete();                       
            $this->ajaxReturn(array('res'=>0));
        } 
    }
    
    /**
     * 禁用户
     */
    
    public function forbid()
    {
        $uid = session('u_uid');
        $l = session('u_level');
        if($l != 2)
        {
            exit; 
        }
        $id = I('id','');
        $res = M('user')->where("id=".$id)->save(array('status'=>0));
        if(IS_AJAX){
            $this->ajaxReturn(array('res'=>0));
        }else{
            redirect(U('Index/life'));
        }                
    }
    /**
     * 禁用户
     */
    
    public function qiyong()
    {
        $uid = session('u_uid');
        $l = session('u_level');
        if($l != 2)
        {
            exit;
        }
        $id = I('id','');
        $res = M('user')->where("id=".$id)->save(array('status'=>1));
        if(IS_AJAX){
            $this->ajaxReturn(array('res'=>0));
        }else{
            redirect(U('Index/life'));
        }
    }
    
 /**
  * 点赞
  */
    public function zan()
    {
        if(IS_AJAX)
        {
             $aid = I('id','');
             if($aid > 0)
             {
                 $remote_ip = $_SERVER['REMOTE_ADDR'];
                 $res = M('well')->where(array('arc_id'=>$aid,'remote_ip'=>$remote_ip))->find();
                 if(empty($res))
                 {
                     //还没有点赞过
                     $r = M('well')->add(array(
                        'remote_ip'=>$remote_ip,
                        'arc_id'=>$aid
                     ));
                     
                     
                     $this->ajaxReturn(array('res'=>0,'zan_num'=>'已点赞'));
                     
                 }
                 else{
                     $this->ajaxReturn(array('res'=>1,'msg'=>'已点赞'));
                 }
             }
             else
             {
                 
             }
        }
        else
        {
            exit('401 forbid!');
        }
    }
    
    
    
    
    /**
     * 数据统计与管理
     */
    
    public function manage()
    {
        $uid = session('u_uid');
        $l = session('u_level');
        if($l != 2)
        {
            exit;
        }
       $user_num = M('user')->count();
       $user_num1 = M('user')->where('level=2')->count();
       $user_num2 = M('user')->where('level=1')->count();
       $arc_num  = M('arcticles')->count();
       $arc_num1  = M('arcticles')->join('user on user.id=arcticles.a_uid')->where('level=2')->count();
       $arc_num2  = M('arcticles')->join('user on user.id=arcticles.a_uid')->where('level=1')->count();
       $user = M('user')->field('id,status,real_name,addr')->order('id desc')->select();
       $this->assign('visit_num',$this->getvisit());
       $this->assign('visit_all',$this->getvisitall());
       $this->assign(array(
           'users'=>$user_num,
           'users1'=>$user_num1,
           'users2'=>$user_num2,
           'arcs'=>$arc_num,
           'arcs1'=>$arc_num1,
           'arcs2'=>$arc_num2,
           'userlist'=>$user
       ));           
        $this->display();
    
    }
    
    public function arc_detail()
    {
        $uid = session('u_uid');
        $l = session('u_level');
        if(empty($uid)){
            $haslogin = 0;
        }else{
            $haslogin = 1;
        }
    
        $id = I('id','');
    
        $arcs = M('arcticles')->field('a_id,id,a_name,a_content,a_img,realse_time,real_name,addr,level')
        ->join('user on user.id = arcticles.a_uid')
        ->where(array('a_id'=>$id))
        ->find();
        if(empty($arcs))
        {
            exit;
        }
            
        if(!empty($arcs['a_img'])){
            $arcs['a_img'] = "http://".$_SERVER['SERVER_NAME'].__ROOT__.$arcs['a_img'] ;
        }
        //求点赞数
        $arcs['zan_num'] = M('well')->where(array('arc_id'=>$arcs['a_id']))->count();

        //已赞过的文章
        $remote = $_SERVER['REMOTE_ADDR'];
        $find = M('well')->where(array('arc_id'=>$arcs['a_id'],'remote_ip'=>$remote))->find();
        $arcs['zan_flag'] = 0;
        if($find)
        {
            $arcs['zan_flag'] = 1;
        }
    
        
           
        $this->assign('arcs',$arcs);    
        $this->assign('menu',4);
        $this->assign('level',$l);
        $this->assign('uid',$uid);
        $this->assign('realname',session('u_realname'));
        $this->assign('haslogin',$haslogin);    
        $this->display();
    }
        
    
}