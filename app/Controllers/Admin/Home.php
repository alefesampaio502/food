<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		//
		$data = [
		'titulo' => 'Home da área restrita',
	];
		//echo view('header', $data);
		echo view('Admin/Home/index',$data);
		//echo view('footer');
	}
}
