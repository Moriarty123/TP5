<?php
namespace app\index\controller;

use think\Controller;

class Administrator extends Controller
{
    public function index()
    {
        return $this->fetch('admin_index');
        // return $this->fetch('login');
    }

    
    

}
