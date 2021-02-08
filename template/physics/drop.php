<?php require("preprocessing/colors.php")?>

<!DOCTYPE html>
</head>
	<link rel="stylesheet" href="../simple.css">
	<title>Dropping a mass at different heights</title>
	<script>
		var unit_meaning = 0.01;
		var timeout = unit_meaning * 1000;
		var gravity = 98; // 10px = one meter
		
		var local_time = 0;
		var distance_from_top = 0;
		var mass_y = distance_from_top;
		
		var context = null;
		var drop_index = 0;
		
		function init() {
			context = canvas.getContext("2d");
			context.fillStyle = "<?=$dark?>";
			new_mass_height.value = distance_from_top;
			draw();
		}
		
		function draw() {
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.fillRect(40, mass_y, 20, 20);
			
			context.beginPath();
			context.moveTo(0,300);
			context.lineTo(300,300);
			context.stroke();
			
			context.beginPath();
			for (i=300; i > 0; i-=10) {
				context.moveTo(0, i);
				context.lineTo(35, i);
				context.fillText((300-i)/10+"m", 0, i);
			}
			context.stroke();
		}
		
		function fall() {
			if (mass_y < 300) {
				mass_y = gravity/2 * Math.pow(local_time, 2);
				local_time += unit_meaning;
				draw();
				window.setTimeout(fall, timeout);
			} else {
				results.innerHTML += "<tr><td>Drop #" + ++drop_index + "</td><td>" + (30-distance_from_top/10) + "m in " + local_time.toFixed(3) + "s</td></tr>";
			}
		}
		
		function meters_to_pixels(meters) {
			return Math.min(300, Math.max(0, 300-meters*10));
		}
		
		function update_distance_from_top() {
			distance_from_top = meters_to_pixels(parseInt(new_mass_height.value) || 300);
		}
		
		function prepare_for_simulation() {
			mass_y = distance_from_top;
			local_time = 0;
		}
		
		function start_simulation() {
			prepare_for_simulation();
			fall();
		}
	</script>
<head>
	
<body onload="init();">
	<h1>Dropping a mass at different heights</h1>
	<center><p><em>"s = ut + ½at²" - Einstein</em></p></center>
	
	<canvas id="canvas" width="200" height="320" style="float: right; margin-left: 20px;"><?readfile("preprocessing/peasant.txt");?></canvas>
	
	<h2>Suggested use</h2>
	<ul>
		<li>Drop the body at different heights</li>
		<li>Use the formula "s = (0)t - &frac12;at<sup>2</sup> to calculate gravity</li>
		<li>Get the average of the results</li>
	</ul>
	<table>
		<tr><td><button onclick="start_simulation();">Drop box</button></td><td><button onclick="prepare_for_simulation(); draw();">Reset Simulation</button></td></tr>
	</table>
	<table>
		<tr><td><button onclick="update_distance_from_top(); prepare_for_simulation(); draw();">Change the drop height</button></td><td><textarea id="new_mass_height"></textarea></td></tr>
	</table>
	
	<h2>Results</h2>
	<section style="overflow-y: auto; height: 150px;"><table style="width: 100%" id="results"></table></section>
	
	<hr>
	
	<a href="index.html">Back to index</a>
</body>
