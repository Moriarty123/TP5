<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Cookie;

class Login extends Controller
{
    public function index()
    {
		$loginMessage = 'null';
		// cookie初始化
		Cookie::init(['prefix'=>'think_','expire'=>3600,'path'=>'/']);

        $param = input('post.');
    	if(empty($param['userName'])){
			$loginMessage = '用户名不能为空';
			Cookie::set('loginMessage', $loginMessage);
			$this->redirect(url('index/index/login'));
    		// $this->error('用户名不能为空');
    	}
    	
    	if(empty($param['password'])){
			$loginMessage = '密码不能为空';
			Cookie::set('loginMessage', $loginMessage);
			$this->redirect(url('index/index/login'));
    		// $this->error('密码不能为空');
    	}
    	
    	// 验证用户名
		$has = Db::table('user')->where('userName', $param['userName'])->find();
		// dump($has);

    	if(empty($has)){
			$loginMessage = '用户名或密码错误';
			Cookie::set('loginMessage', $loginMessage);
			$this->redirect(url('index/index/login'));
    		// $this->error('用户名或密码错误');
    	}
    	
    	// 验证密码
    	if($has['password'] != md5($param['password'])){
			$loginMessage = '用户名或密码错误';
			Cookie::set('loginMessage', $loginMessage);
			$this->redirect(url('index/index/login'));
    		// $this->error('用户名或密码错误');
		}
		

		// 记录用户登录信息
		
    	Cookie::set('userNo', $has['userNo']);  // 一个小时有效期
    	Cookie::set('userName', $has['userName']);
		

		$strlen = strlen($has['userName']);
		// dump($has['userName']);
		// dump($strlen);

		$this->redirect(url('index/administrator/index'));
		if($strlen == 7) {
			$loginMessage = '教师账号登录成功';
			Cookie::set('loginMessage', $loginMessage);

			$this->redirect(url('index/teacher/index'));
			
		}
		else if($strlen == 12) {
			$loginMessage = '学生账号登录成功';
			Cookie::set('loginMessage', $loginMessage);

			$this->redirect(url('index/student/index'));
			
		}
		else {
			$loginMessage = '登录出错，请重新登录';
			Cookie::set('loginMessage', $loginMessage);

			$this->redirect(url('index/index/login'));
		
		}
    }

    
}
