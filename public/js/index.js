
var time = 120;
$(document).ready(function(){
	populateGrid();
	$(".restart-btn").click(function(){
		$(".boggleTable td").text("");
		clearInterval(window.intervalId);
		$("span.time").text("");
		populateGrid();
	});

	$(".start-btn").click(function(){
		setTimer();
	});

	$("#word").keyup(function(event) {
	    if (event.keyCode === 13) {
	        $("#submitWord").click();
	        $("#word").select();
	    }
	});	
})


/**
 * Populates the boggle grid.
 * @return {[null]}
 */
function populateGrid(){
	const letters = getRandLetters(16, 2);
	// const solutionSet = getSolutionSet(letters);
	const solutionSet = checkWord(letters);
	console.log(letters);
	letters.forEach(function(letter, index){
		// console.log(index+". "+letter);
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

/**
 * Get solution set from the letters generated by getRandLetters function. Uses ajax request to get solution file.
 * @param  {array} letters random letters generated bt getRandLetters function.
 * @return {arr/bool}         return solution set if successful else bool 0
 */		
function getSolutionSet(letters){
	letters = JSON.stringify(letters);
	console.log(typeof(letters));

	$(document).ready(function(){
		$.ajax({
	        url: 'ajax',
	        type: "post",
	        data: {'letters':letters},
	        success: function (response) {
	        	console.log(response);
				return response;
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	           // console.log(textStatus, errorThrown);
	           return 0;
	        }
    	});	
	})
}


function checkWord(letters){
	letters = JSON.stringify(letters);
	$(document).ready(function(){
		$("#submitWord").click(function(){
			var word = $("#word").val();
			var row = "<tr class = 'scoreRow'><td class = 'wordCell'>"+word+"</td><td class = 'scoreCell'><img src='assets/image/loading.gif'>checking...</td></tr>";
			$('#scoreBoard table > tbody:last').append(row);
			// throw new Error("my error message");

			$.ajax({
		        url: 'validateWord',
		        type: "post",
		        data: {'letters':letters, 'word':word},
		        success: function (response) {
		        	var res = $.parseJSON(response);
					var wordStatus = res.isValid
					if (wordStatus) {
						var score = res.word.length;
						$(".scoreCell:last").text("");
						$(".scoreCell:last").text(score);
						var total = getTotal();
						// $(".totalVal").text(total);
					} else {
						$(".scoreRow:last").remove();
						$( "input#word" ).effect("shake");
						/*var alert = "<div class='alert alert-warning' role='alert'>Invalid Word!</div>";
						$(".alertMsg").append(alert);
						setTimeout(function(){ 
							$(".alertMsg div").remove();
						}, 1000);*/
						// var total = getTotal();
					}

					return response;
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           return 0;
		        }
	    	});	

		})
	})
}

function getTotal(){
	var sum = 0;
	$(".scoreCell").each(function(){
		sum += Number($(this).text()); 
	})

	var sumRow = '<tr class = "totalRow"><td class = "total">TOTAL</td><td class = "totalVal"> '+sum+' </td></tr>';
	$(".totalRow").remove();
	$("#scoreBoard table > tbody:last").append(sumRow);
	return sum;
}

function setTimer(){
	window.intervalId = setInterval(function() { 
		time--
		var second = (time % 60).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
		var minute = (Math.floor(time/60)).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
		populateTimer(second, minute);
		if (time == 0) {
			clearInterval(window.intervalId);
			disableInputs();
		}
	}, 1000);
}

function disableInputs(){
	$("input").prop('disabled', true);
}

function populateTimer(sec, min){
	$("span.time").text("");
	var time = min+" : "+sec;
	$("span.time").append(time);
}