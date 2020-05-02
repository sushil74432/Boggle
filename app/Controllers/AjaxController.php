<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class AjaxController extends Controller {
	
	public function index(){
		$letters = $this->request->getVar('letters');
		// echo "This looks good";
		// $letters = $_POST['letters'];
		$letters = json_decode($letters, 1);
		$lettersDim = sizeof($letters);
		$squareDim = sqrt($lettersDim);

		$lettersArr = $this->get2DMatrix($letters);

		for ($x=0; $x < $squareDim; $x++) { 
			for ($y=0; $y < $squareDim; $y++) { 
				$solutionSet = $this->generateCombinations($lettersArr, $x, $y);
			}
		}
	}

	public function test(){
		$letters = '["i", "y", "b", "i", "w", "s", "d", "e", "t", "t", "h", "h", "y", "j", "j", "r"]';
		$letters = json_decode($letters, 1);
		$lettersDim = sizeof($letters);
		$squareDim = sqrt($lettersDim);

		$lettersArr = $this->get2DMatrix($letters);

		for ($x=0; $x < $squareDim; $x++) { 
			for ($y=0; $y < $squareDim; $y++) { 
				# code...
			}
		}
		$solutionSet = $this->generateCombinations($lettersArr);

		echo "This is test";
	}

	private function generateCombinations($lettersArr, $xIndex = 0, $yIndex = 0){
		$this->traversedCell[] = $xIndex.$yIndex;
		if ($xIndex == 5) {
			print_r($this->traversedCell);die;
		}
		if ($xIndex < 5) {
			$xIndex++;
			$yIndex++;
			$this->generateCombinations($lettersArr, $xIndex, $yIndex);			
		}
	}

	private function get2DMatrix($letters){
		// $letters = json_decode($letters, 1);
		$index1 = -1;
		foreach ($letters as $key => $letter) {
			if (($key) % 4 == 0) {
				$index1++;
			}

			$lettersArr[$index1][] = $letter;  
		}
		return $lettersArr;
	}

}
