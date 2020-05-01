<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class AjaxController extends Controller {
	
	public function index(){
		// $letters = $this->request->getVar('letters');
		$letters = $_POST('letters');
		echo "I got ".$letters;
	}

	public function test(){
		echo "This is test";
	}

}
