# Boggle - https://assurance-boggle.herokuapp.com/

- Boggle game written on PHP language using Codeigniter Framework.
- Features : Select difficulty level, Timer color changes as time approaches to an end.
- Languages Used :
	Frontend - Javascript/Jquery/HTML/CSS
	Backend - PHP
	Entry point for app : public/index.php

- Tested locally on WAMP server with PHP 7.2.14

- **Algorithm** :
 - Word is passed through ajax as the user find it and enters in the input field.
 - In backend, Word is seperated into letters and starting from first letter
 - First it is ensured if the word is valid dictionary word
 - Second, it is checked if all the letters in word are present in the board
 - Third, Starting from the first letter it is checked if the consecutive letter for each letter present in the users word is adjacent(neighbouring) in the board.
	eg. For word BOGGLE, starting from "B", it is checked if the letter "O" is present in the neighbouring 8(max) cells of "B" and if "G" is present in neighbouring cells of "B" and so on.

- Available to run online at https://assurance-boggle.herokuapp.com/


-----------------------------

**Testing**:
-Manual test can be performed for word checking algorithm using the URL: 
https://assurance-boggle.herokuapp.com/test?word=held,hold,bible&test=pass,fail,pass&board=["b", "i", "b", "l","w", "s", "d", "e","v", "t", "h", "h","y", "j", "j", "r"]

-**Parameters** : 
	- **word** => the words to be tested against board(default word "held" used if passed empty value)
	- **test** => expected output 
	- **board (optional)** => 16 random letters that represent boggle board in left to right and top to down order.
