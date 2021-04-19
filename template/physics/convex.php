<?php
	require("php/colors.php");
	require("php/util.php");
?>

<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../simple.css">
	<title>Convex Lens</title>
	<script>
		var context = null;
		
		var lens_height = 1.5; // meters
		var focal_length = 1; // meters
		var mark = 0;
		
		var object_x = -1;
		var object_y = 0;
		var image_x = 1;
		var image_y = 0;
		
		function update_image_position() {
			image_x = 1/(1/focal_length-1/-object_x);
			var magnification = image_x / object_x;
			image_y = magnification * object_y;
		}
		
		function change_object_and_update_dependents(x, y) {
			object_x = x;
			object_y = y;
			focal_length = object_x * focal_length > 0 ? -focal_length : focal_length;
			
			update_image_position();
		}
		
		function init() {
			context = canvas.getContext("2d");
			
			canvas.onclick = function(mouse_event) {
				var x = 2 * ((mouse_event.offsetX / canvas.width) - 0.5) * canvas.width/100;
				var y = 2 * ((mouse_event.offsetY / canvas.height) - 0.5) * canvas.height/100;
				change_object_and_update_dependents(x, y);
				set_variables();
				draw();
			};
			
			// Immutable context configuration
			centered_coordinate_space();
			context.strokeStyle = "<?=$dark?>";
			context.fillStyle = "<?=$dark?>";
			context.lineWidth = 0.02;
			context.font = "15px Arial";
			
			set_variables();
			draw();
		}
		
		function draw() {
			context.clearRect(-canvas.width/100, -canvas.height/100, canvas.width/50, canvas.height/50);
			
			// Draw the mark
			context.beginPath();
			context.moveTo(mark,-2);
			context.lineTo(mark,2);
			context.stroke();
			
			// Draw the distance of the mark from the optic center
			draw_text_at(Math.abs(mark*100).toFixed(0)+"cm", mark + 0.1, 1.8, "left");
			
			// Draw the lens
			context.beginPath();
			context.ellipse(0, 0, 0.25, lens_height, 0,0, 2*Math.PI);
			context.stroke();
			
			// Draw a dot at the optic center
			context.fillRect(-0.05, -0.05, 0.1, 0.1);
			
			if (Math.abs(object_y) < lens_height) {
				// Draw the image
				context.beginPath();
				context.arc(image_x, image_y, 0.1, 0, 2*Math.PI);
				context.fill();
				draw_distance_from_axis(image_x, image_y);
				
				// "The pursuit of DRY above all other goals can lead to bad code" - Somebody.
				// "Screw it" - Me, using the lines I saved for comments B)
				context.moveTo(object_x, object_y);
				context.lineTo(0, object_y);
				
				// If the product of the two x values numbers is positive, then they're both on the same size
				if (image_x*object_x > 0) {
					// Virtual image
					context.moveTo(image_x, image_y);
					context.lineTo(-image_x*100, -image_y*100);
					
					context.moveTo(image_x, image_y);
					context.lineTo((focal_length-image_x)*100+image_x, -image_y*100+image_y);
					
					context.setLineDash([0.1,0.1]);
				} else {
					// Real image
					context.lineTo(image_x, image_y);
					
					context.moveTo(object_x, object_y);
					context.lineTo(image_x, image_y);
				}
				
				context.stroke();
				context.setLineDash([]);
			}
			
			// Draw the object
			context.beginPath();
			context.arc(object_x, object_y, 0.2, 0, 2*Math.PI);
			context.fill();
			
			draw_distance_from_axis(object_x, object_y);
		}
		
		function draw_distance_from_axis(x, y) {
			var adjective = y < 0 ? "above" : "below";
			draw_text_at(Math.abs(y*100).toFixed(0)+"cm "+adjective, x, y-0.25, "center");
		}
		
		function centered_coordinate_space() { context.setTransform(50, 0, 0, 50, canvas.width/2, canvas.height/2); }
		function default_coordinate_space() { context.setTransform(1,0,0,1,0,0); }
		
		function draw_text_at(text, x, y, align) {
			default_coordinate_space();
			context.textAlign = align || "left";
			context.fillText(text, (x+canvas.width/100)/(canvas.width/50)*canvas.width, (y+canvas.height/100)/(canvas.height/50)*canvas.height);
			centered_coordinate_space();
		}
		
		function update_mark_position() {
			mark = parseInt(mark_input.value)/100 || object_x;
		}
		
		function update_object_position() {
			change_object_and_update_dependents(parseInt(object_distance_input.value)/100, object_y);
		}
		
		function set_variables() {
			object_distance_input.value = Math.abs(object_x*100).toFixed(0) + "cm";
			image_distance_cell.innerHTML = Math.abs(image_x*100).toFixed(0) + "cm";
		}
	</script>
</head>

<body onload="init();">
	<h1>Finding out the properties of a convex lens</h1>
	
	<section style="float: right; width: 300px; margin-left: 20px;">
		<canvas id="canvas" width="300" height="200" style="width: 300px; height: 200px;"><?readfile("php/peasant.txt");?></canvas>
		<p>The intersection of dotted rays indicates a virtual image.</p>
		<h2>Variables</h2>
		<table>
			<tr><td>Image distance</td><td id="image_distance_cell"></td></tr>
			<tr><td><button onclick="update_object_position(); draw();">Object distance</button></td><td><input id="object_distance_input" type="number" value="0"></td></tr>
			<tr><td><button onclick="update_mark_position(); draw();">Mark</button></td><td><input id="mark_input" type="number" value="0"></td></tr>
		</table>
	</section>
	
	<h2>Suggested use</h2>
	<ul>
		<li>Memorise the table. Do this by saying it in your head and then subsequently writing it out a couple of times.</li>
		<li>Adjust the position of the object using the mouse or the input.</li>
		<li>Using your knowledge of the images created in a convex lens, mark: f and 2f.</li>
	</ul>
	<h2>Property table</h2>
	<?php echo file_to_table("template/physics/convex.table")?>
	
	<hr>
	
	<a href="index.html">Back to index</a>
</body>
