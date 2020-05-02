<?php namespace App\Controllers;

class HomeController extends BaseController
{
	public function index()
	{
		return view('index');
	}

	public function test(){
		echo "This is fine";
	}
}
