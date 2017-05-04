<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
    
    public function _initialize() 
    {
              
        $uid = session('uid');
        if(empty($uid))
        {
            redirect(U('Login/index'));
        }
        
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
    
    
  
   
    
}
