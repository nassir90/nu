<?php require("php/colors.php")?>

<!DOCTYPE html>
</head>
	<link rel="stylesheet" href="../simple.css">
	<title>Dropping a mass at different heights</title>
	<meta encoding="UTF-8">
	<script>
		var unit_meaning = 0.01;
		var timeout = unit_meaning * 1000;
		var gravity = 98; // 10px = one meter
		
		var local_time = 0;
		var drop_height = 30;
		var mass_y = 0;
		
		var context = null;
		
		function init() {
			context = canvas.getContext("2d");
			context.fillStyle = "<?=$dark?>";
			draw();
		}
		
		function draw() {
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.fillRect(40, mass_y+20, meters_to_pixels(2), meters_to_pixels(2));
			
			context.beginPath();
			for (i=300; i > 0; i-=10) {
				context.moveTo(0, i+20);
				context.lineTo(35, i+20);
				context.fillText(pixels_to_meters(300-i).toFixed(1)+"m", 0, i+20);
			}
			context.stroke();
		}
		
		function fall() {
			if (mass_y < 300) {
				mass_y = gravity/2 * Math.pow(local_time,2);
				local_time += unit_meaning;
				draw();
				window.setTimeout(fall, timeout);
			} else {
				results.innerHTML += "<tr><td>" + drop_height + " m Drop </td><td>" + local_time.toFixed(3) + "s</td></tr>";
			}
		}

		function download_drop_height() {
			drop_height = parseInt(drop_height_input.value);
		}

		function pixels_to_meters(pixels) {
			return pixels * (drop_height / 300);
		}

		function meters_to_pixels(meters) {
			return (300 / drop_height) * meters;
		}
		
		function reset() {
			gravity = meters_to_pixels(9.8);
			mass_y = 0;
			local_time = 0;
		}
		
		function start_simulation() {
			reset();
			fall();
		}
	</script>
<head>
	
<body onload="init();">
	<h1>Dropping a mass at different heights</h1>
	<center><p><em>"s = ut + &frac12;at<sup>2</sup>" - Einstein</em></p></center>
	
	<canvas id="canvas" width="200" height="320" style="float: right; margin-left: 20px;"><?readfile("php/peasant.txt");?></canvas>
	
	<h2>Suggested use</h2>
	<ul>
		<li>Drop the body at different heights</li>
		<li>Use the formula "s = (0)t - &frac12;at<sup>2</sup> to calculate gravity</li>
		<li>Get the average of the results</li>
	</ul>
	<table>
		<tr>
			<td><button onclick="start_simulation();">Drop box</button></td>
			<td><button onclick="reset(); draw();">Reset Simulation</button></td>
		</tr>
	</table>
	<table>
		<tr>
			<td><button onclick="download_drop_height(); reset(); draw();">Change the drop height</button></td><td><input id="drop_height_input" type="number" value="30"></td>
		</tr>
	</table>
	
	<h2>Results</h2>
	<section style="overflow-y: auto; height: 150px;"><table style="width: 100%" id="results"></table></section>
	
	<hr/>
	
	<a href="index.html">Back to index</a>
</body>
