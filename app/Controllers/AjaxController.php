<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class AjaxController extends Controller {
	private $letters;
	private $lettersDim;
	private $squareDim;
	private $combinations;
	private $lettersArr;

	public function index($letters = ""){
		if (!$letters) {
			$letters = $this->request->getVar('letters');
			// $letters = $_POST['letters'];
		}
		$this->letters = json_decode($letters, 1);
		// print_r($this->letters);die;
		$this->lettersDim = sizeof($this->letters);
		$this->squareDim = sqrt($this->lettersDim);
		$this->combinations = array();


		$this->lettersArr = $this->get2DMatrix($this->letters);

		for ($x=0; $x < $this->squareDim; $x++) { 
			for ($y=0; $y < $this->squareDim; $y++) {
				// echo $x.$y."</br>"; 
				$solutionSet = $this->generateCombinations($x, $y);
				break 2;
			}
		}
	}

	private function generateCombinations($x = 0, $y = 0, $visited = array(), $try = 0){
		echo "<br>$try. Called generateCombinations with x,y :".$x.", ".$y."<br>";
		$visited[] = $x.$y;
		// $currentLetter = $this->lettersArr[$x][$y];
		// $this->combinations[] = $currentLetter;
		var_dump($visited);
		echo "</br>";
		echo "SQUAREDIM: ".$this->squareDim."<br>";
		if ($try <= 16) {
			$try++;
		} else {
			die;
		}
		for ($i = ($x-1); $i <= ($x+1) && $i < $this->squareDim; $i++) { 
			for ($j = ($y-1); $j <= ($y+1) && $j < $this->squareDim; $j++) { 
				$key = $i.$j;
				if (($i >= 0 && $j >= 0) /*&& ($i < $this->squareDim && $j < $this->squareDim)*/) {
					if (!in_array($key, $visited)) {
						echo $i.$j."</br>";					
						$this->generateCombinations($i, $j, $visited, $try);
					}
				} else {
					echo "Rejected item: ".$i.$j."</br>";
					// return 1;
					// continue;
				}
			}	
		}
	}

	private function get2DMatrix($letters){
		// $letters = json_decode($letters, 1);
		$index1 = -1;
		foreach ($letters as $key => $letter) {
			if (($key) % $this->squareDim == 0) {
				$index1++;
			}

			$lettersArr[$index1][] = $letter;  
		}
		return $lettersArr;
	}

	public function test(){
		$letters = '["i", "y", "b", "i", "w", "s", "d", "e", "t", "t", "h", "h", "y", "j", "j", "r"]';
		// $letters = '["i", "y", "b", "i", "w", "s", "d", "e", "k"]';

		// $this->index($letters);
		$this->validateWord();
		// echo "This is test";
	}

	public function validateWord(){

		// $this->boardLetters = json_decode(strtoupper($this->request->getVar('letters')), 1);
		$this->boardLetters = json_decode(strtoupper('[
			"b", "i", "b", "l", 
			"w", "s", "d", "e", 
			"v", "t", "h", "h", 
			"y", "j", "j", "r"]'), 1);
		$this->lettersDim = sizeof($this->boardLetters);
		// echo "Letters Dimension: ".$this->lettersDim;
		$this->squareDim = sqrt($this->lettersDim);
		// echo "Square Dimension: ".$this->squareDim;
		// die;
		$this->board = $this->get2DMatrix($this->boardLetters);
		// var_dump($this->board);
		$word = strtoupper($this->request->getVar('word'));

		$word = "BELIEVER";
		$word = "HELD";
		$word = "HIDE";
		// $word = "DID";
		// $word = "DEED";


		$isInDictionary = $this->checkInDictionary($word);
		$isInBoard = 0;
		if ($isInDictionary) {
			echo "<br>Is in dictionary: ".$isInDictionary; 
			$isInBoard = $this->checkInBoard($word, $this->boardLetters);
		}
		print_r($isInBoard);
		die;

	}

	private function checkInDictionary($word){
		$dictionary = file_get_contents("assets/dictionary.txt");
		$dictionary = explode("\n", $dictionary);
		return in_array($word, $dictionary);
	}

	private function checkInBoard($word, $letters){
		$wordArr = str_split($word);
		$intersection = implode("", array_intersect($wordArr, $letters));
		if ($word == $intersection) {
			$startingIndex = $this->getIndices($wordArr[0]);
			var_dump($startingIndex);//die;
			foreach ($startingIndex as $index) {
				$inBoard = $this->checkNeighbours($index, $wordArr, $wordArr[0]);
				if ($inBoard == "YES") {
					echo "<br><b>Is in board: $inBoard</b><br>";
					return 1;
				} else {
					echo "<br><b>Is in board: $inBoard</b><br>";
					continue;
				}
			}
		} else {
			return 0;
		}
	}

	private function getIndices($word){
		// echo "<br>Word: $word";
		$indices = array();
		foreach ($this->board as $i => $value) {
			foreach ($value as $j => $letter) {
				// echo "<br>".$i.", ".$j.": $letter";
				if ($word == $letter) {
					$indices[] = $i.",".$j;
				}
			}
		}
		return $indices;
		// var_dump($indices);die;
	}

	private function checkNeighbours($index, $word, $formedWord, $visited = array(), $boardLettersIndex = 0, $try=1){
		echo "Parameter  word:".implode("", $word)."<br>";
		echo "<br>$try. Called checkNeighbours function with index $index<br>";
		$boardLettersIndex++;
		var_dump($index);
		$index = explode(",", $index);
		$x = $index[0];
		$y = $index[1];
		$visited[] = $x.",".$y;
		// var_dump($visited);
		if ($try <= 16) {
			$try++;
		} else {
			die;
		}

		if ($boardLettersIndex < sizeof($word)) {
			echo "<br>BoardIndex: ".$boardLettersIndex.PHP_EOL;
			echo "<br>Next word: ".$word[$boardLettersIndex];
			for ($i = ($x-1); $i <= ($x+1) && $i < $this->squareDim; $i++) { 
				for ($j = ($y-1); $j <= ($y+1) && $j < $this->squareDim; $j++) { 
					$key = $i.",".$j;
					if (($i >= 0 && $j >= 0)) {
						if (!in_array($key, $visited)) {
							echo "<br>".$i.$j.":";
							echo $this->board[$i][$j];
							if ($word[$boardLettersIndex] == $this->board[$i][$j]) {
								$formedWord .= $this->board[$i][$j];
								echo "<br>Aceepted letter. Checking next neighbour.";
								echo "<br><b>Formed Word: $formedWord ::: Received Word: ".implode("", $word)." </b><br><br>";
								if ($formedWord == implode("", $word) && $boardLettersIndex == (sizeof($word)-1)) {
									echo "<br>*********************";
									return 1;
								} else {
									$res = $this->checkNeighbours($key, $word,$formedWord, $visited, $boardLettersIndex, $try);
									if ($res) {
										return 1;
									}
								}	
							} else{
								echo "<br>Rejected item: ".$i.$j."(".$this->board[$i][$j].")</br>";							
								continue;
							}
						}
					} else {
						// echo "<br>Here...";
						echo "<br>Item out of board: ".$i.$j."</br>";
					}
				}	
			}
		}

		echo "<br>Formed Word: $formedWord";
		if ($formedWord == implode("", $word)) {
			return 1;
		} else {
			return 0;
		}
	}
}
