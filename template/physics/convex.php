<?php
	require("preprocessing/colors.php");
	require("preprocessing/util.php");
?>

<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../simple.css">
	<title>Convex Lens</title>
	<script>
		<?php readfile("template/physics/util.js")?>
		
		var canvas = null;
		var context = null;
		
		var lens_height = 1.5; // meters
		var focal_length = 1; // meters
		var mark = 0;
		
		var object = vec2(-1,0);
		var image = vec2(1,0);
		
		function update_image_position() {
			image.x = 1/(1/focal_length-1/-object.x);
			var magnification = image.x / object.x;
			image.y = magnification * object.y;
		}
		
		function change_object_and_update_dependents(x, y) {
			object.x = x;
			object.y = y;
			focal_length = object.x * focal_length > 0 ? -focal_length : focal_length;
			
			update_image_position();
		}
		
		function init() {
			canvas = document.getElementById("canvas");
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
			context.font = "15px Arial";
			draw_text_at(Math.trunc(Math.abs(mark*100))+"cm", mark + 0.1, 1.8, "left");
			
			// Draw the lens
			context.beginPath();
			context.ellipse(0, 0, 0.25, lens_height, 0,0, 2*Math.PI);
			context.stroke();
			
			// Draw a dot at the optic center
			context.fillRect(-0.05, -0.05, 0.1, 0.1);
			
			if (Math.abs(object.y) < lens_height) {
				// Draw the image
				context.beginPath();
				context.arc(image.x, image.y, 0.1, 0, 2*Math.PI);
				context.fill();
				draw_distance_from_axis(image);
				
				// "The pursuit of DRY above all other goals can lead to bad code" - Somebody.
				// "Screw it" - Me, using the lines I saved for comments B)
				context.moveTo(object.x, object.y);
				context.lineTo(0, object.y);
				
				// If the product of the two x values numbers is positive, then they're both on the same size
				if (image.x*object.x > 0) {
					// Virtual image
					context.moveTo(image.x, image.y);
					context.lineTo(-image.x*100, -image.y*100);
					
					context.moveTo(image.x, image.y);
					context.lineTo((focal_length-image.x)*100+image.x, -image.y*100+image.y);
					
					context.setLineDash([0.1,0.1]);
				} else {
					// Real image
					context.lineTo(image.x, image.y);
					
					context.moveTo(object.x, object.y);
					context.lineTo(image.x, image.y);
				}
				
				context.stroke();
				context.setLineDash([]);
			}
			
			// Draw the object
			context.beginPath();
			context.arc(object.x, object.y, 0.2, 0, 2*Math.PI);
			context.fill();
			
			draw_distance_from_axis(object);
		}
		
		function draw_distance_from_axis(obj) {
			var adjective = obj.y < 0 ? "above" : "below";
			draw_text_at(Math.trunc(Math.abs(obj.y*100))+"cm "+adjective, obj.x, obj.y-0.25, "center");
		}
		
		function centered_coordinate_space() { context.setTransform(50, 0, 0, 50, canvas.width/2, canvas.height/2); }
		function default_coordinate_space() { context.setTransform(1,0,0,1,0,0); }
		
		function draw_text_at(text, x, y, align) {
			default_coordinate_space();
			context.textAlign = align || "left";
			context.fillText(text, (x+canvas.width/100)/(canvas.width/50)*canvas.width, (y+canvas.height/100)/(canvas.height/50)*canvas.height);
			centered_coordinate_space();
		}
		
		function update_mark_position() { mark = -parseInt(mark_textarea.value)/100 || object.x; }
		
		function update_object_position() {
			change_object_and_update_dependents(-parseInt(object_distance_textarea.value)/100 || object.x, object.y);
		}
		
		function set_variables() {
			object_distance_textarea.value = Math.trunc(Math.abs(object.x*100)) + "cm";
			image_distance_cell.innerHTML = Math.trunc(Math.abs(image.x*100)) + "cm";
		}
	</script>
</head>

<body onload="init();">
	<h1>Finding out the properties of a convex lens</h1>
	
	<div style="float: right; width: 300px; margin-left: 20px;">
		<canvas id="canvas" width="300" height="200" style="width: 300px; height: 200px;"><?readfile("preprocessing/peasant.txt");?></canvas>
		<p>The intersection of dotted rays indicates a virtual image.</p>
		<h2>Variables</h2>
		<table>
			<tr><td>Image distance</td><td id="image_distance_cell"></td></tr>
			<tr><td><button onclick="update_object_position(); draw();">Object distance</button></td><td><textarea id="object_distance_textarea"></textarea></td></tr>
			<tr><td><button onclick="update_mark_position(); draw();">Mark</button></td><td><textarea id="mark_textarea"></textarea></td></tr>
		</table>
	</div>
	
	<h2>Suggested use</h2>
	<ul>
		<li>Memorise the table. Do this by saying it in your head and then subsequently writing it out a couple of times.</li>
		<li>Adjust the position of the object using the mouse or the textarea.</li>
		<li>Using your knowledge of the images created in a convex lens, mark: f and 2f.</li>
	</ul>
	<h2>Property table</h2>
	<?php echo file_to_table("template/physics/convex.table")?>
	
	<hr>
	
	<a href="index.html">Back to index</a>
</body>
