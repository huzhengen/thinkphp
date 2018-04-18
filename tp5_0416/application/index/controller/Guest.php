<?php
namespace app\index\controller;
use think\Controller;

class Guest extends Controller
{
    public function index()
    {
		return $this->fetch();
    }
}
