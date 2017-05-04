<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller 
{
    
    
    /**
     * 主页
     */
    public function index()
    {
         
            $this->display();
        
    }

    /**
     * 检查用户名和密码
     * checkUser
     */
    protected  function check()
    {
        $name = I('name','');
        $pwd = I('pwd','');
        $res = M('user')->where(array('username'=>$name,'passwd'=>$pwd,'level'=>2))->find();
        if($res)
        {
            session('uid',$res['id']);
            session('name',$res['username']);
            return true;
        }
        return false;
    }
    
    /**
     * check user pwd and username
     */
    public function checkUser(){
        $res = $this->check();
        if($res)
        {
            $this->ajaxReturn(array('res'=>0,'url'=>U('Admin/index')));
        }
        $this->ajaxReturn(array('res'=>1));
    }
    
    
    /**
     * register
     */
    public function reg(){
         $this->display();
    }
    
    
    /**
     * login  app
     */
    public function applogin(){        
        $this->display();
    }
    /**
     * logindata
     */
    public function logindata(){
        if(IS_AJAX){
            $username = I('username','');
            $pwd = I('pwd','');
            $query = array();
            $query['username'] = array('eq',$username);
            $query['passwd'] = array('eq',$pwd);
            $res = M('user')->where($query)->find();
             if($res)
            {
                if($res['status'] == 0){
                    $this->ajaxReturn(array('res'=>2,'msg'=>'您的账号已被禁用!'));
                }else{
                    session('u_uid',$res['id']);
                    session('u_username',$res['username']);
                    session('u_addr',$res['addr']);
                    session('u_realname',$res['real_name']);
                    session('u_level',$res['level']);
                    $this->ajaxReturn(array('res'=>0));
                }
               
            }
            else
            {
                $this->ajaxReturn(array('res'=>2,'msg'=>'账号或密码错误!'));
            }
       
        }
        
        
        
    }
    
    
    /**
     * save
     */
    public function save(){
        $username = I('username','');
        $pwd = I('pwd','');
        $addr= I('addr','');
        $realname = I('realname','');
        $query = array();
        $query['username'] = array('eq',$username);
        $res = M('user')->where($query)->find();
        if(!$res)
        {
            $data = array(
                'username' => $username,
                'passwd'=>$pwd,
                'addr'=>$addr,
                'real_name'=>$realname,
                'status'=>1,
                'stime'=>date('Y-m-d H:i:s')
            );   
            $id = M('user')->add($data);
            if($id > 0){
                $this->ajaxReturn(array('res'=>0));
            }   else{
                $this->ajaxReturn(array('res'=>2,'msg'=>'添加用户失败!'));
            }      
        }
        else
        {
            $this->ajaxReturn(array('res'=>2,'msg'=>'该用户账户已被使用，请更换账户!'));
        }
   
        $this->display();
    }
    
    public function out(){
        session(null);
        redirect(U('Index/life'));
    }
    
    
    
   
}