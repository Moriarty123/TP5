<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index');
        // return view();
        
    }

    public function login()
    {
        return $this->fetch('login');
        // return view();
        
    }

    public function doLogin() 
    {
        
    }
}
