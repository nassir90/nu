<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../simple.css">
	<title>Electromagnetic Induction</title>
	
	<script>
		var context = null;
		var n = 3;
		
		var unit_meaning = 0.01; // seconds
		var timeout = unit_meaning * 1000;
		
		var loop_timer = null;
		var coil_framebuffer = null;
		var coil_context = null;
		
		var magnet = {x: 0, y: 0};
		var mouse = {x: 1, y: 0};
		var magnet_old = {x: magnet.x, y: magnet.y};
		var number_of_coils = 3;
		var flux_density = 2; /* Teslas */
		var simulation_speed = 1; // ms
		var dropoff_coefficient = flux_density / 2.5; // -2 teslas per meter
		var bulb_resistance = 5;
		var coil_radius = 0.3;
		var coil_area = 2 * Math.PI * Math.pow(coil_radius, 2);
		var starting_position = -2.5;
		var magnet_can_move = true;
		
		var experimental_work = 0;
		var expected_work = 0;
		var max_expected_voltage = 0;
		var max_experimental_voltage = 0;
		
		// privatre
		var flux_density_at_core = 0;
		
		// Show variables
		var speed = 0;
		var voltage = 0;
		
		function flux_at(distance) {
			return Math.max(0, flux_density - distance * dropoff_coefficient);
		}
		function distance_of_flux (desired) {
			return Math.max(0, (flux_density - desired) / dropoff_coefficient);
		}
		
		function init() {
			context = canvas.getContext("2d");
			context.setTransform(0.5, 0, 0, 0.5, canvas.width/2, canvas.height/2);
			context.font = "30px Arial";
				
			coil_framebuffer = document.createElement("canvas");
			coil_framebuffer.width = 300;
			coil_framebuffer.height = 600;
			
			coil_context = coil_framebuffer.getContext("2d");
			update_coil_framebuffer();
			upload();
			
			window.onkeyup = function(william) {
				var code = william.keyCode;
				if (code == 85) {
					magnet_can_move = true;
				} else if (code == 76) {
					magnet_can_move = false;
				}
			}
			
			start_interactive();
		}
		
		function upload() {
			current_flux_density.innerHTML = flux_density + "T";
			current_dropoff_coefficient.innerHTML = dropoff_coefficient;
			current_number_of_coils.innerHTML = number_of_coils;
			current_simulation_speed.innerHTML = simulation_speed + "ms";
			current_coil_dimension.innerHTML = "known radius of " + coil_radius + "m";
			current_starting_position.innerHTML = Math.abs(starting_position) + "m from core";
			current_bulb_resistance.innerHTML = bulb_resistance + "&Omega;";
			
		}
		
		function update_starting_position() {
			var number = parseFloat(simulation_starting_position.value);
			if (number) {
				starting_position = known_distance.checked ? -number : known_flux.checked ? -distance_of_flux(number) : starting_position;
				current_starting_position.innerHTML = Math.abs(starting_position).toFixed(n) + "m from core";
				simulation_starting_position.value = "";
			}
		}
		
		function update_coil_number() {
			var number = Math.abs(parseInt(coils_input.value));
			if (number) {
				number_of_coils = number;
				current_number_of_coils = number;
				coils_input.value = "";
				update_coil_framebuffer();
			}
		}
		
		function update_coil_radius() {
			var number = Math.abs(parseFloat(coil_dimension_input.value));
			if (number) {
				coil_dimension_input.value = "";
				if (use_radius.checked) {
					coil_radius = number;
					current_coil_dimension.innerHTML = "known radius of " + number + "m";
				} else if (use_area.checked) {
					coil_radius = Math.sqrt(number/(2 * Math.PI));
					current_coil_dimension.innerHTML = "known area of " + number + "m2";
				}
				
				coil_area = 2 * Math.PI * Math.pow(coil_radius, 2);
				update_coil_framebuffer();
			}
		}
		
		function update_flux_density() {
			var number = parseFloat(flux_density_input.value);
			if (number) {
				flux_density = number;
				upload();
			}
		}
		
		function set_num(input, variable) {
			var number = parseFloat(input.value);
			if (number) {
				window[variable] = number;
				document.getElementById("current_" + variable).innerHTML = number;
				input.value = number;
			}
		}
		
		function simulation_prep() {
			max_experimental_voltage = 0;
			experimental_work = 0;
			voltage = 0;
			magnet.x = starting_position;
			magnet.y = 0;
			magnet_old.x = magnet.x;
			magnet_old.y = 0;
			
			var full_time = (distance_of_flux(0) / simulation_speed);
			max_expected_voltage = -number_of_coils * ( coil_area * (flux_density - flux_density_at_core)) / full_time;
			expected_work = 2 * (Math.pow(max_expected_voltage, 2)/bulb_resistance) * full_time; // P = IV = (V/R)(V) = V²/R/t
		}
		
		function regulate_voltage() {
			var distance_traveled = Math.sqrt(Math.pow(magnet.x - magnet_old.x, 2) + Math.pow(magnet.y - magnet_old.y, 2));
			speed = distance_traveled / unit_meaning;
			
			var distance_from_core = Math.sqrt(Math.pow(magnet.x, 2) + Math.pow(magnet.y, 2));
			var distance_from_core_old = Math.sqrt(Math.pow(magnet_old.x, 2) + Math.pow(magnet_old.y, 2));
			 
			var density = flux_at(distance_from_core);
			var density_old = flux_at(distance_from_core_old);
			flux_density_at_core = (density + density_old) / 2;
			
			voltage = - number_of_coils * (coil_area * (density - density_old)) / unit_meaning;
			
			magnet_old.x = magnet.x;
			magnet_old.y = magnet.y;
		}
		
		function start_simulation() {
			simulation_prep();
			simulate();
		}
		
		function simulate() {
			window.clearTimeout(loop_timer);
			regulate_voltage();
			magnet.x += simulation_speed * unit_meaning;
			experimental_work += Math.pow(voltage, 2) / bulb_resistance * unit_meaning;
			max_experimental_voltage = voltage > max_experimental_voltage ? voltage : max_experimental_voltage;
			draw();
			if (magnet.x < 2.5) {
				loop_timer = window.setTimeout(simulate, timeout);
			} else {
				start_interactive();
			}
		}
		
		function start_interactive() {
			canvas.onmousemove = function(mousemove) {
				mouse.x = (mousemove.offsetX * 2 - canvas.width) / 100;
				mouse.y = (mousemove.offsetY * 2 - canvas.height) / 100;
			}
			
			interactive();
		}
		
		function end_interactive() {
			canvas.onmousemove = null;
		}
		
		function interactive() {
			window.clearTimeout(loop_timer);
			if (magnet_can_move) {
				var dealta_x = magnet.x - mouse.x;
				var dealta_y = magnet.y - mouse.y;
				var len = Math.sqrt(Math.pow(dealta_x, 2) + Math.pow(dealta_y, 2));
				var to_mouse_x = dealta_x / len || 0;
				var to_mouse_y = dealta_y / len || 0;
				magnet.x -= to_mouse_x * simulation_speed * unit_meaning;
				magnet.y -= to_mouse_y * simulation_speed * unit_meaning;
			}
			regulate_voltage();
			draw();
			
			loop_timer = window.setTimeout(interactive, timeout);
		}
		
		function update_coil_framebuffer() {
			coil_context.clearRect(-coil_framebuffer.width, -coil_framebuffer.height, coil_framebuffer.width*2, coil_framebuffer.height*2);
			
			var half_length = 300 /(number_of_coils + 2);
			for (var i = half_length; i <= 300-half_length; i+= half_length) {
				coil_context.beginPath();
				coil_context.ellipse(i, coil_radius*100, half_length, coil_radius*100, 0, Math.PI, false);
				coil_context.stroke();
				
				if ( Math.ceil(i) != 300-Math.floor(half_length)) {
					coil_context.beginPath();
					coil_context.ellipse(i + half_length/2, coil_radius*100, half_length/2, coil_radius*100, -Math.PI, Math.PI, false);
					coil_context.stroke();
				}
			}
		}
		
		function draw() {
			/* The second two arguments are sizes not positions */
			context.clearRect(-canvas.width, -canvas.height, canvas.width*2, canvas.height*2);
			
			context.beginPath();
			context.strokeRect(-150, 0, 300, 150);
			context.stroke();
			context.clearRect(-149, -10, 298, 20); // Remove the top part of the rectangle to make way for the coils
			
			// Draw the fillament
			context.clearRect(-10, 140, 20, 20);
			context.beginPath();
			context.arc(0, 150, 10, Math.PI, 0);
			context.stroke(); // inner
			context.beginPath();
			context.arc(0, 150, 20, 0, 2 * Math.PI); // outer
			context.stroke();
			
			//Draw the manget
			//context.beginPath();
			context.fillText("E", magnet.x*100, magnet.y*100);
			//context.fill();
			
			// Draw the drop off radius
			context.save();
			context.beginPath();
			var outer_bound = distance_of_flux(0)*100;
			var inner_bound = distance_of_flux(flux_density*0.8)*100;
			var gradient = context.createRadialGradient(magnet.x*100, magnet.y*100, inner_bound, magnet.x*100, magnet.y*100, outer_bound);
			context.fillStyle = gradient;
			gradient.addColorStop(0, "rgba(0, 0, 0, 0.5)");
			gradient.addColorStop(1, "rgba(0, 0, 0, 0)");
			context.arc(magnet.x*100, magnet.y*100, outer_bound, 0, 2*Math.PI);
			context.fill();
			context.restore();
			
			context.save();
			context.beginPath();
			context.globalAlpha = 0.2;
			context.fillStyle = "yellow";
			var plume_radius = 5*Math.abs(voltage / bulb_resistance);
			context.arc(0, 150, plume_radius, 0, 2 * Math.PI);
			context.fill();
			context.restore();
			
			context.drawImage(coil_framebuffer, -150, -coil_radius*100);
			
			context.fillStyle = "black";
			context.fillText("Expect max EMF of " + max_expected_voltage.toFixed(n) + "V, actually got " + max_experimental_voltage.toFixed(n) + "V", -300, -75);
			context.fillText("Done " + experimental_work.toFixed(n) + "J, expected " + expected_work.toFixed(n) + "J", -300, -100);
			context.fillText("Flux density at core is " + flux_density_at_core.toFixed(n) + "T, flux is " + (flux_density_at_core*coil_area).toFixed(n) + "Wb", -300, -125);
			context.fillText("Magnet moving at " + speed.toFixed(n) + "ms", -300, -150);
			context.fillText("Induced voltage of " + voltage.toFixed(n) + "V", -300, -175);
		}
	</script>
</head>

<body onload="init();">
	<h1>Electromagnetic Induction</h1>
	
	<section style="float: right; width: 40vw; margin-left: 20px;">	
		<h2>Equipment parameters</h2>
		<table>
			<tr>
				<td><button onclick='update_flux_density();'>Set flux density</button></td>
				<td><input type="number"  id="flux_density_input"></td><td id="current_flux_density"></td>
			</tr>
			<tr>
				<td><button onclick='set_num(dropoff_input, "dropoff_coefficient");'>Set magnetic field dropoff coefficient (if you like headaches)</button></td>
				<td><input type="number"  id="dropoff_input"></td><td id="current_dropoff_coefficient"></td>
			</tr>
			<tr>
				<td><button onclick='update_coil_number();'>Set coils</button></td>
				<td><input type="number"  id="coils_input"></td><td id="current_number_of_coils"></td>
			</tr>
			<tr>
				<td>
					<fieldset>
						<input type="radio" name="coil_dimension" id="use_radius">Modify coil size with a known radius<br>
						<input type="radio" name="coil_dimension" id="use_area">Modify coil size with a known area
					</fieldset>
					<center><button onclick="update_coil_radius()">Set</button></center>
				</td>
				<td><input type="number" id="coil_dimension_input"></td>
				<td id="current_coil_dimension"></td>
			</tr>
			<tr>
				<td><button onclick='set_num(bulb_resistance_input, "bulb_resistance");'>Set resistance of bulb</button></td>
				<td><input type="number" id="bulb_resistance_input"></td>
				<td id="current_bulb_resistance"></td>
			</tr>
		</table>
		
		<h2>Simulation parameters</h2>
		<table>
			<tr>
				<td><button onclick='set_num(speed_input, "simulation_speed");'>Set field speed</button></td>
				<td><input type="number"  id="speed_input"></td><td id="current_simulation_speed"></td>
			</tr>
			<tr>
				<td>
					<fieldset>
						<input type="radio" name="simulation_starting_position" id="known_flux">Start with a known magnetic flux density at core<br>
						<input type="radio" name="simulation_starting_position" id="known_distance">Start with the field at a known distance<br>
					</fieldset>
					<center><button onclick="update_starting_position();">Set</button></center>
				</td>
				<td>
					<input type="number" id="simulation_starting_position">
				</td>
				<td id="current_starting_position"></td>
			</tr>
		</table>
		
		<button style="width: 98%" onclick="simulation_prep();">Prepare</button>
		<button style="width: 98%" onclick="end_interactive(); start_simulation();">Prepare and Execute</button>
	</section>
	
	<h2>Simulation window</h2>
	<center>
		<canvas id="canvas" width="500px" height="200px"><?readfile("php/peasant.txt");?></canvas>
		<p>Press 'l' to lock the position of the field, and press 'u' to unlock the field</o>
	</center>
	
	<h2>Use of this simulation.</h2>
	<ul>
		<li>Verifying lenz law by showing that the induced emf always moves away from the change producing it</li>
	</ul>
	
	<h2>Formulae</h2>
	<p><em>EMF = n(&Phi;1-&Phi;)/t</em> - the electromotive force created in a circuit given the rate of change of magnetic flux</p>
	<p><em>Q = (V2/R)t</em> - the formula I used to find the work done</p>
	<hr>
	
	<a href="index.html">Back to index</a> <a href="induction_reflection.html">Reflection</a>
</body>
