<?php require("preprocessing/colors.php")?>

<!DOCTYPE html>
</head>
	<link rel="stylesheet" href="../simple.css">
	<title>Dropping a mass at different heights</title>
	<script>
		var mass_x = 40;
		
		var drop_height = 40;
		var mass_y = drop_height;
		var mass_velocity = 0;
		var gravity = 9.8; // 10px = one meter
		var drop_time = null;
		var context = null;
		var canvas = null;
		var counter = 0;
		
		function init() {
			canvas = document.getElementById("canvas");
			context = canvas.getContext("2d");
			context.fillStyle = "<?=$dark?>";
			draw();
		}
		
		function draw() {
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.fillRect(mass_x, mass_y, 20, 20);
			
			for (i=300; i > 0; i-=10) {
				context.beginPath();
				context.moveTo(0, i);
				context.lineTo(35, i);
				context.stroke();
				
				context.moveTo(0, i);
				context.fillText((300-i)/10+"m", 0, i);
			}
		}
		
		function fall() {
			if (mass_y < 280) {
				mass_velocity += 0.001 * gravity;
				mass_y += mass_velocity;
				window.setTimeout(fall, 1);
			} else {
				results.innerHTML += "<tr><td>Drop #" + counter++ + "</td><td>" + (Date.now() - drop_time) + " milliseconds</td></tr>";
			}
			
			draw();
		}
		
		function meters_to_pixels(meters) {
			return Math.min(300, Math.max(0, 300 - meters*10));
		}
		
		function update_drop_height() {
			drop_height = meters_to_pixels(parseInt(new_mass_height.value) || drop_height);
		}
		
		function reset_mass_properties() {
			mass_y = drop_height;
			mass_velocity = 0;
		}
		
		function start_simulation() {
			reset_mass_properties();
			drop_time = Date.now();
			fall();
		}
	</script>
<head>
	
<body onload="init();">
	<h1>Dropping a mass at different heights</h1>
	<center><p><em>"s = ut + ½at²" - Einstein</em></p></center>
	
	<canvas id="canvas" width="200" height="300" style="float: right;"><?readfile("preprocessing/peasant.txt");?></canvas>
	
	<h2>Suggested use</h2>
	<ul>
		<li>Use the results collected to find gravity</li>
	</ul>
	<table>
		<tr><td><button onclick="start_simulation();">Drop box</button></td><td><button onclick="reset_mass_properties(); draw();">Reset Simulation</button></td></tr>
	</table>
	<table>
		<tr><td><button onclick="update_drop_height(); reset_mass_properties(); draw();">Change the drop height</button></td><td><textarea id="new_mass_height">40</textarea></td></tr>
	</table>
	
	<h2>Results</h2>
	<section style="overflow-y: auto; height: 150px;"><table style="width: 100%" id="results"></table></section>
	
	<hr>
	
	<a href="index.html">Back to index</a>
</body>
