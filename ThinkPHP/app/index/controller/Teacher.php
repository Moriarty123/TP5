<?php
namespace app\index\controller;

use think\Controller;

class Teacher extends Controller
{
    public function index()
    {
        return $this->fetch('teacher_index');
        // return $this->fetch('login');
    }

    
    

}
