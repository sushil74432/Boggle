<html>
	<head>
		<title>Boggle</title>
		<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="assets/main.css">

		<script>
			const solveUrl = "<?php echo base_url('ajax');?>";
			console.log(solveUrl); 
		</script>
	</head>
	<body>
		<div class="wrapper">
			<div id="container" class="container">
				<div class = "left">
					<div class="boggleBox">
						<table class="boggleTable" id="boggleTable">
							<tr>
								<td class="boggleCell c-1" id="one"></td>
								<td class="boggleCell c-2" id="two"></td>
								<td class="boggleCell c-3" id="three"></td>
								<td class="boggleCell c-4" id="four"></td>
							</tr>
							<tr>
								<td class="boggleCell c-5" id="five"></td>
								<td class="boggleCell c-6" id="six"></td>
								<td class="boggleCell c-7" id="seven"></td>
								<td class="boggleCell c-8" id="eight"></td>
							</tr>
							<tr>
								<td class="boggleCell c-9" id="nine"></td>
								<td class="boggleCell c-10" id="ten"></td>
								<td class="boggleCell c-11" id="eleven"></td>
								<td class="boggleCell c-12" id="twelve"></td>
							</tr>
							<tr>
								<td class="boggleCell c-13" id="thirteen"></td>
								<td class="boggleCell c-14" id="fourteen"></td>
								<td class="boggleCell c-15" id="fifteen"></td>
								<td class="boggleCell c-16" id="sixteen"></td>
							</tr>
						</table>
					</div>
					<div class="controls">
						<div class="buttons">
							<button class="restart-btn btn-lg btn-danger">RE-START</button>
							<button class="start-btn btn-lg btn-success">START TIMER</button>						
						</div>
					</div>
				</div>
				<div class = "right">
					<div id="timer">
						Time   
						<span class="time"></span>
					</div>
					<div class="inputs input-group">
						<input type="text" class="word form-control width50" id="word">
						<span class="input-group-btn">
							<button class="submitWord btn btn-success" id="submitWord">Submit</button>							
						</span>
					</div>
					<div class="socreBoard" id="scoreBoard">
						<table class="score">
							<tr>
								<th>WORD</th>
								<th>SCORE</th>
							</tr>
						</table>
					</div>				
				</div>
			</div>
		</div>
		<footer>
			<script src = "js/index.js"></script>
		</footer>
	</body>
</html>
