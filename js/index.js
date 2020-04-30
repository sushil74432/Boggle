populateGrid();

/**
 * Populates the boggle grid.
 * @return {[null]}
 */
function populateGrid(){
	const letters = getRandLetters(16, 2);
	console.log(letters);
	letters.forEach(function(letter, index){
		console.log(index+". "+letter);
		var clas = "td.c-"+(index+1);
		// console.log(clas);
		$(clas).append("<p>"+letter.toUpperCase()+"</p>");
	})
}

/**
 * generate random letters assignment of provided length 
 * @length : {[type]} length of expected array
 * @maxDuplicate : {[type]} maximum amount of acceptable duplicate
 * @return {[array]} array containing random letters of provided length
 */
function getRandLetters(length, maxDuplicate){
	const alphaSet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
	var randSet = [];
	while(randSet.length < length) {
		var rand = alphaSet[Math.floor(Math.random() * alphaSet.length)];
		var duplicateCount = 0;
		
		randSet.forEach(function(item, index){
			if (item == rand) {
				duplicateCount++; 
			}
		})

		if (duplicateCount >= maxDuplicate) {
			console.log(`More than ${maxDuplicate} '${rand}' present. Reject...`);
			continue
		} else{
			randSet.push(rand);
		}
	}
	return randSet;
}
