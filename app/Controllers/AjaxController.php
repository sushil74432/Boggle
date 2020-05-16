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
						$res=$this->generateCombinations($i, $j, $visited, $try);

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
		// echo "<br><b></b>";
		echo "<img src = 'assets/image/SAMPLE-BOARD.png' style = 'float:right'>";
		echo "<br><br><b>
						<ul>
							<li>Test is performed against shown example board.</li>
							<li>Please pass an word and expected output as get parameters.</li>
							<li> Example : https://assurance-boggle.herokuapp.com/test?word=held&test=pass</li>
							<li>Optionally, the board letters can also be passed as a URL parameter 'board'</li>
							<li> Example : https://assurance-boggle.herokuapp.com/test?word=held&test=pass&board=[\"b\", \"i\", \"b\", \"l\",\"w\", \"s\", \"d\", \"e\",\"v\", \"t\", \"h\", \"h\",\"y\", \"j\", \"j\", \"r\"]</li>
							<li>Multiple test inputs can also be entered as shown below</li>
							<li> Example : https://assurance-boggle.herokuapp.com/test?word=held,hold,bible&test=pass,fail,pass&board=[\"b\", \"i\", \"b\", \"l\",\"w\", \"s\", \"d\", \"e\",\"v\", \"t\", \"h\", \"h\",\"y\", \"j\", \"j\", \"r\"]</li>

						</ul>
					</b><br><br><br>";
		echo "<p><b>=======================================================================================</b></p><br>";
		$word = explode(",", strtoupper($this->request->getVar('word')));
		$letters = $this->request->getVar('board');
		$expRes = explode(",", $this->request->getVar('test'));

		// print_r(!$word[0]);die;
		if (!$word[0]) {
			$word[0] = "HELD";
		}
		if (!$expRes[0]) {
			$expRes[0] = "pass";
		}
		// print_r($word);

		if (!$letters) {
			$letters = '[
			"b", "i", "b", "l", 
			"w", "s", "d", "e", 
			"v", "t", "h", "h", 
			"y", "j", "j", "r"]';
		}

		echo "<b>Test Board: $letters</b><br><br>";
		echo "<table style = 'border:solid 3px; margin-left:10%'>
				<tr>
					<th style = 'border:solid 3px;'>Word</th>
					<th style = 'border:solid 3px;'>Expected Result</th>
					<th style = 'border:solid 3px;'>Algorithm Result</th>
					<th style = 'border:solid 3px;'>Remarks</th>";
		foreach ($word as $key => $wrd) {
			// echo "<br>Testing for $wrd";
			// var_dump($this->request->getVar('result'));die;
			$expected = trim($expRes[$key]);
			$expectedResult = ($expected == "pass")?1:0;
			// print_r($expectedResult);die;
			$res = $this->validateWord($letters, trim($wrd));
			$result = json_decode($res, 1);
			
			// echo "<br>".$wrd.":::".$expectedResult.":::".$result['isValid'];

			if ($result['isValid'] == $expectedResult) {
				echo "<tr style = 'background-color:green;'><td>$wrd</td><td>$expected</td><td>".($result['isValid']?"pass":"fail")."</td><td>PASS</td></tr>";
			} else {
				echo "<tr style = 'background-color:red;'><td>$wrd</td><td>$expected</td><td>".($result['isValid']?"pass":"fail")."</td><td>Fail</td></tr>";
			}


			/*if ($result['isValid'] == $expectedResult) {
				echo "<h1 style='color:green;'>Test Passed for word $wrd.</h1>";
				echo "<h3>Expected Result: ".$expected." ::: Algorithm Output : ".($result['isValid']?"pass":"fail")."</h3>";
			} else {
				echo "<h1 style='color:red;'>Test Failed for word $wrd.</h1>";
				echo "<h3>Expected Result: ".$expected." ::: Algorithm Output : ".($result['isValid']?"pass":"fail")."</h3>";
			}*/
			// echo "*****************************";
	
		}
		echo "</table>";
		// print_r($result);
		// echo PHP_EOL."Test Result for word $word: ".$res;
	}
/**
 * Validate if the passed word is valid word in dictionary and boggle board.
 * @return json; json containing flag if the word is valid "isValid"
 */
	public function validateWord($letters = "", $testWord  = array()){
		
		$this->boardLetters = json_decode(strtoupper($this->request->getVar('letters')), 1);
		$word = strtoupper($this->request->getVar('word'));

		if ($letters && $testWord) {
			// var_dump($letters);
			// echo PHP_EOL."Test Words: ".$testWord;
			$this->boardLetters = json_decode(strtoupper($letters), 1);
			$word = $testWord;
		}
		$this->lettersDim = sizeof($this->boardLetters);
		// echo "Letters Dimension: ".$this->lettersDim;
		$this->squareDim = sqrt($this->lettersDim);
		// echo "Square Dimension: ".$this->squareDim;
		$this->board = $this->get2DMatrix($this->boardLetters);
		// var_dump($this->board);

		$isInDictionary = $this->checkInDictionary($word);
		$isInBoard["word"] = $word;
		$isInBoard["isValid"] = 0;
		if ($isInDictionary) {
			// echo "<br>Is in dictionary: ".$isInDictionary; 
			$isInBoard["isValid"] = $this->checkInBoard($word, $this->boardLetters);
		}
		$isInBoard = json_encode($isInBoard);
		return $isInBoard;
	}

/**
 * Check if provided word is a valid dictionary word
 * @param  string; $word; word to be check against dictionary 
 * @return boolean       true if present else false
 */
	private function checkInDictionary($word){
		$dictionary = file_get_contents("assets/dictionary.txt");
		$dictionary = explode("\n", $dictionary);
		return in_array($word, $dictionary);
	}

/**
 * check if the provided word is present in board. First checks if the letters combination is present in the board. If present, verifies if the word formation follows boggle rules.
 * @param  string $word     word to be checked in board 
 * @param  array  $letters  A ordered list of letters present in the boggle board.  
 * @return boolean          true if word is present and follows boggle rules else false.
 */
	private function checkInBoard($word, $letters){
		$wordArr = str_split($word);
		$intersection = implode("", array_intersect($wordArr, $letters));
		if ($word == $intersection) {
			$startingIndex = $this->getIndices($wordArr[0]);
			// var_dump($startingIndex);//die;
			foreach ($startingIndex as $index) {
				$inBoard = $this->checkNeighbours($index, $wordArr, $wordArr[0]);
				if ($inBoard) {
					// echo "<br><b>Is in board: $inBoard</b><br>";
					return 1;
				} else {
					// echo "<br><b>Is in board: $inBoard</b><br>";
					continue;
				}
			}
		} else {
			return 0;
		}
	}

/**
 * get the index of a provided word in the boggle board matrix.
 * @param  string $word word to be checked in board
 * @return [type]       [description]
 */
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

/**
 * check if the tracking neighbours of given index makes a complete and required word.
 * @param  string  $index             string in format "m,n" representing location of the first letter of word on boggle board.
 * @param  string  $word              word to be checked in board
 * @param  string  $formedWord        dynamically built word in each iteration. First letter of word passed at first. 
 * @param  array   $visited           list of visited cells so as to avoid revisit(boggle rule).
 * @param  integer $boardLettersIndex index to track the current letter of word being processed.
 * @return boolean                     true if word is formed using boggle rules else false.
 */
	private function checkNeighbours($index, $word, $formedWord, $visited = array(), $boardLettersIndex = 0){
		// echo "Parameter  word:".implode("", $word)."<br>";
		// echo "<br>$try. Called checkNeighbours function with index $index<br>";
		$boardLettersIndex++;
		// var_dump($index);
		$index = explode(",", $index);
		$x = $index[0];
		$y = $index[1];
		$visited[] = $x.",".$y;
		// var_dump($visited);
		/*if ($try <= 16) {
			$try++;
		} else {
			die;
		}*/

		if ($boardLettersIndex < sizeof($word)) {
			// echo "<br>BoardIndex: ".$boardLettersIndex.PHP_EOL;
			// echo "<br>Next word: ".$word[$boardLettersIndex];
			for ($i = ($x-1); $i <= ($x+1) && $i < $this->squareDim; $i++) { 
				for ($j = ($y-1); $j <= ($y+1) && $j < $this->squareDim; $j++) { 
					$key = $i.",".$j;
					if (($i >= 0 && $j >= 0)) {
						if (!in_array($key, $visited)) {
							// echo "<br>".$i.$j.":";
							// echo $this->board[$i][$j];
							if ($word[$boardLettersIndex] == $this->board[$i][$j]) {
								$formedWord .= $this->board[$i][$j];
								// echo "<br>Aceepted letter ".$i.$j."(".$this->board[$i][$j]."). Checking next neighbour.";
								// echo "<br><b>Formed Word: $formedWord ::: Received Word: ".implode("", $word)." </b><br><br>";
								if ($formedWord == implode("", $word) && $boardLettersIndex == (sizeof($word)-1)) {
									// echo "<br>*********************";
									return 1;
								} else {
									$res = $this->checkNeighbours($key, $word, $formedWord, $visited, $boardLettersIndex);
									if ($res) {
										return 1;
									} else {
										$formedWord = substr($formedWord, 0, -1);
									}
								}	
							} else{
								// echo "<br>Rejected item: ".$i.$j."(".$this->board[$i][$j].")</br>";							
								// continue;
							}
						}
					} else {
						// echo "<br>Here...";
						// echo "<br>Item out of board: ".$i.$j."</br>";
					}
				}	
			}
		}

		// echo "<br>* Last Formed Word: $formedWord";
		if ($formedWord == implode("", $word)) {
			// echo PHP_EOL."True";
			return 1;
		} else {
			// echo PHP_EOL."False";
			// $formedWord = substr($formedWord, 0, -1);
			return 0;
		}
	}
 }
