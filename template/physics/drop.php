<?php require("preprocessing/colors.php")?>

<!DOCTYPE html>
</head>
	<link rel="stylesheet" href="../simple.css">
	<title>Dropping a mass at different heights</title>
	<script>
		var mass_x = 40;
		var mass_y = 10;
		var mass_velocity = 0;
		var gravity = 9.8; // 10px = one meter
		var initial = null;
		var context = null;
		var canvas = null;
		
		function init() {
			canvas = document.getElementById("canvas");
			context = canvas.getContext("2d");
			
			draw();
		}
		
		function draw() {
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.fillStyle = "black";
			context.fillRect(mass_x, mass_y, 20, 20);
			
			
			for (i=300; i > 0; i-=10) {
				context.beginPath();
				context.moveTo(0, i);
				context.lineTo(35, i);
				context.stroke();
				
				context.moveTo(0, i);
				context.strokeText((300-i)/10+"m", 0, i);
			}
		}
		
		var timer = null;
		
		function loop() {
			window.clearTimeout(timer);
			
			if (mass_y < 280) {
				mass_velocity += 0.001 * gravity;
				mass_y += mass_velocity;
				timer = window.setTimeout(loop, 1);
			} else {
				mass_y = 280;
				document.getElementById("time_taken").innerHTML = ((new Date()).getTime() - initial.getTime()) + " milliseconds, 10 for every year";
			}
			
			draw();
		}
		
		function start_loop() {
			document.getElementById("lol").innerHTML = "Should have listened to Volataire";
			initial = new Date();
			loop();
		}
	</script>
<head>
<body onload="init();">
	<h1>Dropping a mass at different heights</h1>
	<center><p><em>"Anyone who has the power to make you believe absurdities has the power to make you commit injustices" - Volataire</em></p></center>
	
	<canvas id="canvas" width="200" height="300" style="border: 3px <?=$dark?> solid; float: left; margin: 10px;">For some reason, I guess for the ones with no javascript, you can put text in between canvas tags... Hello peasant <small>(you're probably better off)</small></canvas>
	
	<h2>Description</h2>
	<p>The box will lose most of its potential energy as kinetic energy, but air resistance should lessen the impact.</p>
	<p>Grandad took part in making this experiment possible. Make him proud.</p>
	<button id="lol" onclick="start_loop();">Drop box</button>
	<p id="time_taken"></p>
	<hr>
	
	<a href="index.html">Back to index</a>
</body>
