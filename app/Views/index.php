<html>
	<head>
		<title>Boggle</title>
		<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>


		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="assets/main.css">
		<link rel="stylesheet" href="assets/mobile.css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-26371590-2"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-26371590-2');
		</script>

		<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
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
						<div class="upperControl">
							<button type="button" class="aboutBtn btn btn-lg btn-primary" data-toggle="modal" data-target="#aboutModal">
								About Game
							</button>

							<select class="form-control selectMenu" id = "selectMenu">
							  <!-- <option>Select Level</option> -->
							  <option value="2">Level 2-Medium</option>
							  <option value="1">Level 1-Easy</option>
							  <option value="3">Level 3-Hard</option>
							</select>
						</div>
						<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalTitle" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
						            <div class="modal-header">
						                <h5 class="modal-title" id="aboutModalTitle">About Game</h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                    <span aria-hidden="true">&times;</span>
						                </button>
						            </div>
						            <div class="modal-body">
						                <p>Boggle is a word game originally invented by Allan Turoff in which players attempt to find words in sequences of adjacent letters.</p>
						                <h3>How to play?</h3>
						                <p>
						                	<ul>
						                		<li>Click on the start game button. The empty 4*4 matrix is populated by some random letters and timer will also start at that same time.</li>
						                		<li>You can then enter the words you can form from letters on the board</li>
						                		<li>The adjacent letters of the word you formed should also be adjacent in the boggle board</li>
						                		<li>For example:</li>
						                		<img src="assets/image/boggle.gif" alt="boggle board example">
						                		<li>In the board above, as shown, the word "SUPER" is valid. Similarly "GLUE" would also be a valid word while "LIE" would be an invalid word as the letters are not connected(adjacent) on the example board</li>
						                		<li>One letter of the same cell cannot be used twice. "STUNT" would be invalid as the letter "T" is used twice from same location. "GLEE" is valid because there are 2 E's in the board.</li>
						                		<li>Score for a correct word will be equal to the length of the word.</li>
						                		<li>Click on restart button if you wish to restart the game</li>
						                	</ul>
						                </p>
						            </div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						            </div>
						        </div>
						    </div>
						</div>

						<button type="button" class="userNameBtn btn btn-lg btn-primary" data-toggle="modal" data-target="#userNameModal" style = "display: none;">
							UserName
						</button>
						<div class="modal fade" id="userNameModal" tabindex="-1" role="dialog" aria-labelledby="userNameModalTitle" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
						            <div class="modal-header">
						                <h5 class="modal-title" id="aboutModalTitle">Your Name?</h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                    <span aria-hidden="true">&times;</span>
						                </button>
						            </div>
						            <div class="modal-body">
										<input type="text" name = "userNameInput" class = "userNameInput" id = "userNameInput">
						            </div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-primary submitUsename" data-dismiss="modal">Continue</button>
						            </div>
						        </div>
						    </div>
						</div>

						<button type="button" class="timeUpBtn btn btn-lg btn-primary" data-toggle="modal" data-target="#timeUpModal" style = "display:none">
							Timeup
						</button>
						<div class="modal fade" id="timeUpModal" tabindex="-1" role="dialog" aria-labelledby="timeUpModalTitle" aria-hidden="true">
						    <div class="modal-dialog" role="document">
						        <div class="modal-content">
						            <div class="modal-header">
						                <h5 class="modal-title" id="timeUpTitle"></h5>
						                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                    <span aria-hidden="true">&times;</span>
						                </button>
						            </div>
						            <div class="modal-body">
										<span class = "timeUpText"></span>
						            </div>
									
						            <div class="modal-footer">
						                <button type="button" class="btn btn-primary submitUsename" data-dismiss="modal">Close</button>
						            </div>
						        </div>
						    </div>
						</div>

						<!-- <div class="alert alert-success" role="alert">
							<h4 class="alert-heading">
								Times Up!
								<button type="button" class="close" data-dismiss="alert">&times;</button>
							</h4>
							<br>
							<p>Your Total score was</p>
							<span class="scorePopUp"></span>
							<hr>
							<p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
						</div> -->

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
<!-- 						<div class="tableOverlay">
						i am on top	
						</div> -->
					</div>
					
					<div class="controls">
						<div class="buttons">
							<button class="restart-btn btn-lg btn-danger" disabled>RE-START</button>
							<button class="start-btn btn-lg btn-success">START GAME<!-- START TIMER --></button>						
						</div>
					</div>
				</div>
				<div class = "right">
					<div class="desktopInputGroup">
						<div id="timer" style = "background-color: rgb(255, 240, 0); display : none">
							<!-- Time    -->
							<span class="time"></span>
						</div>
						<div class="inputs input-group">
							<input type="text" class="word form-control width50" id="word" disabled>
							<span class="input-group-btn">
								<button class="submitWord btn btn-success" id="submitWord">Submit</button>
							</span>
						</div>
					</div>

					<div class="mobileInputGroup">
						<table>
							<tr>
								<td class="time">
									<div id="timer" style = "background-color: rgb(255, 240, 0);">
										<span class="time"></span>
									</div>
								</td>
								<td class="inputField">
									<div class="inputs input-group">
										<input type="text" class="word form-control width50" id="word" disabled>
										<span class="input-group-btn">
											<button class="submitWord btn btn-success" id="submitWord">CHECK</button>
										</span>
									</div>						
								</td>
							</tr>
							<tr>
								<td></td>
								<td class="score">
									Total Score: 
									<span></span>
									<!-- <input type="text" class="word form-control width50" id="word" disabled> -->
								</td>
							</tr>
						</table>
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
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
			<script src="https://rawgit.com/benevolenttech/jquery.confetti.js/master/jquery.confetti.js"></script>
		</footer>
	</body>
</html>
