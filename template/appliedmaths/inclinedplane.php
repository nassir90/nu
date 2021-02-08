<?php require("preprocessing/colors.php")?>

<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../simple.css">
	<title>Projectiles on an inclined plane</title>
	
	<script>
		var gravity = 9.8; // magnitude only
		var n = 2;
		
		var plane_angle = 10;
		var starting_velocity = 25;
		var projectile_angle = 30;
		
		var perpendicular_gravity;
		var paralell_gravity;
		var perpendicular_starting_velocity;
		var paralell_starting_velocity;
		var range;
		var flight_time;
		var maximum_height;
		
		function toRadians(angle) { return angle * (Math.PI / 180); }
		
		function download() {
			var number;
			
			number = parseFloat(plane_angle_input.value);
			plane_angle = number ? number : plane_angle;
			
			number = parseFloat(projectile_angle_input.value);
			projectile_angle = number ? number : projectile_angle;
			
			number = parseFloat(starting_velocity_input.value);
			starting_velocity = number ? number : starting_velocity;
			
			number = parseFloat(gravity_input.value);
			gravity = number ? number : gravity;
		}
		
		function upload() {
			plane_angle_input.value = plane_angle;
			starting_velocity_input.value = starting_velocity;
			projectile_angle_input.value = projectile_angle;
			gravity_input.value = gravity;
		}
		
		function upload_results() {
			paralell_gravity_td.innerHTML = paralell_gravity.toFixed(n) + "ms<sup>-2</sup>";
			perpendicular_gravity_td.innerHTML = perpendicular_gravity.toFixed(n) + "ms<sup>-2</sup>";
			paralell_starting_velocity_td.innerHTML = paralell_starting_velocity.toFixed(n) + "ms<sup>-1</sup>";
			perpendicular_starting_velocity_td.innerHTML = perpendicular_starting_velocity.toFixed(n) + "ms<sup>-1</sup>";
			maximum_height_td.innerHTML = maximum_height.toFixed(n) + "m";
			flight_time_td.innerHTML = flight_time.toFixed(n) + "s";
			range_td.innerHTML = range.toFixed(n) + "m";
		}
		
		function calculate() {
			paralell_gravity = - gravity * Math.sin(toRadians(plane_angle));
			perpendicular_gravity = - gravity * Math.cos(toRadians(plane_angle));
			paralell_starting_velocity = starting_velocity * Math.cos(toRadians(projectile_angle));
			perpendicular_starting_velocity = starting_velocity * Math.sin(toRadians(projectile_angle));
			maximum_height = -Math.pow(perpendicular_starting_velocity, 2) / (2 * perpendicular_gravity);
			flight_time = (-2*perpendicular_starting_velocity)/perpendicular_gravity;
			range = paralell_starting_velocity*flight_time + paralell_gravity/2*Math.pow(flight_time, 2);
		}
		
		// Simulation
		var context = null;
		var projectile_x = 0;
		var projectile_y = 300;
		var unit_meaning = 0.01;
		var timeout = unit_meaning * 1000;
		var pixels_per_meter; //We scale the variables such that the largest side of the plane is at 300
		var plane_adjecent;
		var plane_opposite;
		var loop_timer;
		var time_elapsed = 0;
		
		function init() {
			context = canvas.getContext("2d");
			context.fillStyle = "<?=$dark?>";
		}
		
		function simulation_prep() {
			plane_adjecent = canvas.width;
			plane_opposite = canvas.width * Math.tan(toRadians(plane_angle));
			
			var length_of_plane = Math.sqrt(Math.pow(canvas.width, 2) + Math.pow(plane_opposite, 2));
			pixels_per_meter = length_of_plane / range;
			time_elapsed = 0;
		}
		
		function simulate() {
			window.clearTimeout(loop_timer);
			projectile_x = paralell_starting_velocity*(time_elapsed) + (paralell_gravity/2)*Math.pow(time_elapsed, 2);
			projectile_y = perpendicular_starting_velocity*(time_elapsed) + (perpendicular_gravity/2)*Math.pow(time_elapsed, 2);
			time_elapsed += unit_meaning;
			draw();
			if (projectile_y >= 0) {
				loop_timer = window.setTimeout(simulate, timeout);
			}
		}
		
		function draw() {
			context.clearRect(0,0, canvas.width, canvas.height);
			
			context.beginPath();
			context.moveTo(0, canvas.width);
			context.lineTo(plane_adjecent, canvas.width);
			context.lineTo(plane_adjecent, 300 - plane_opposite);
			context.closePath();
			context.fill();
			
			// I make the origin the bottom left hand side of the screen.
			// Then I rotate by plane_angle
			// I know that the hypotenuse is the same length as  the range
			// 
			context.save();
			context.translate(0, 300);
			context.rotate(toRadians(-plane_angle));
			context.fillStyle = "white";
			context.beginPath();
			context.arc(pixels_per_meter*projectile_x, -pixels_per_meter*projectile_y, 10, 0, 2 * Math.PI);
			context.fill();
			
			context.textAlign = "center";
			context.font = "15px Arial";
			context.fillText(projectile_y.toFixed(n) + "m", pixels_per_meter*projectile_x, -pixels_per_meter*projectile_y);
			context.restore();
			
			context.beginPath();
			for (var i = 0; i < 300; i += 30) {
				context.moveTo(0, i);
				context.lineTo(10, i);
				context.fillText(((300-i)/pixels_per_meter).toFixed(n) + "m", 10, i);
			}
			context.stroke();
		}
		
		function holy_trinity() {
			download();
			calculate();
			upload_results();
		}
	</script>
	
</head>

<body onload="upload(); init();">
	<h1>Projectiles on an inclined plane</h1>
	
	<!-- Floating sections obey the current y position documnet, so we put it below the h1-->
	<section style="float: right; margin-left: 20px; width: 40vw;">
		<h2>Parameters</h2>
		<h3>Basic</h3>
		<input type="number" id="plane_angle_input" max="20" min="0.0"> Angle of plane<br>
		<input type="number" id="starting_velocity_input"> Starting velocity<br>
		<input type="number" id="projectile_angle_input" max="80" min="0"> Angular offset of projectile<br>
		<input type="number" id="gravity_input"> Gravity<br>
		<button onclick="holy_trinity(); simulation_prep(); draw();" style="width: 98%">display</button>
		<button onclick="holy_trinity();" style="width: 98%">calculate</button>
		<h3>Unknown variables</h3>
		<p>Use this space to do your calculations. I here markers work great on screens.</p>
	</section>
	
	<center>
		<p><button onclick="holy_trinity(); simulation_prep(); simulate();" style="width: 300px;">Simulate</button></p>
		<canvas id="canvas" width="300" height="300">Lol no javascript. Go read the article(s).</canvas>
	</center>
	
	<h2>Purpose of this simulation</h2>
	<ul>
		<li>Find the maximum hight</li>
		<li>Find the range</li>
		<li>Graphically display these results</li>
	</ul>
	
	<h2>Results</h2>
	<table>
		<tr>
			<td>gravity resolved to be perpendicular to the plane.</td>
			<td>g&times;cos(&theta;)</td>
			<td id="perpendicular_gravity_td"></td>
		</tr>
		<tr>
			<td>gravity resolved to be paralell to the plane.</td>
			<td>g&times;sin(&theta;)</td>
			<td id="paralell_gravity_td"></td>
		</tr>
		<tr>
			<td>projectile starting velocity resolved perpendicular to the plane.</td>
			<td>u&times;sin(&theta;)</td>
			<td id="perpendicular_starting_velocity_td"></td>
		</tr>
		<tr>
			<td>projectile starting velocity resolved paralell to the plane.</td>
			<td>u&times;cos(&theta;)</td>
			<td id="paralell_starting_velocity_td"></td>
		</tr>
		<tr>
			<td>maximum height of projectile</td>
			<td>0 = u<sub>&perp;</sub><sup>2</sup> - 2g<sub>&perp;</sub>s</td>
			<td id="maximum_height_td"></td>
		</tr>
		<tr>
			<td>flight time of projectile</td>
			<td>0 = u<sub>&perp;</sub>t - &frac12;g<sub>&perp;</sub>t<sup>2</sup></td>
			<td id="flight_time_td"></td>
		</tr>
		<tr>
			<td>range of projectile (using flight time in t<sub>f</sub>)</td>
			<td>s = u<sub>&#8741;</sub>t<sub>f</sub> - &frac12;g<sub>&#8741;</sub>t<sub>f</sub><sup>2</sup></td>
			<td id="range_td"></td>
		<tr>
	</table>
	<hr>
	
	<a href="index.html">Back to index</a>
	
</body>
