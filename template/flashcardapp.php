<!DOCTYPE html>

<head>
	<title>Flash card app</title>
	<link rel="stylesheet" href="style.css">
	
	<script>
	
	function toggle_blur(id) {
		var style = document.getElementById(id).style;
		if (style.filter == "none") {
			style.filter = "blur(3px)";
		} else {
			style.filter = "none";
		}
	}
	
	window.onkeyup = function(e) {
		if (e.keyCode == 65) {
			toggle_blur("left");
		} else if (e.keyCode == 68) {
			toggle_blur("right");
		}
	}
	
	function update_card_bay(button) {
		var parts = button.getAttribute("data-card").split("=");
		document.getElementById("left").innerHTML = parts[0];
		document.getElementById("right").innerHTML = parts[1];
	}
	
	function add_card() {
		var left_entry = document.getElementById("left_entry");
		var right_entry = document.getElementById("right_entry");
		var l = left_entry.value.trim();
		var r = right_entry.value.trim();
		
		// genesis 6:5
		if (!(l.length && r.length)) return;
		
		document.getElementById("card_selector").innerHTML += "<tr><td><button data-card=\""+ l + "=" + r + "\" onclick=\"update_card_bay(this)\">" + l + "</button></td></tr>";
		left_entry.value = "";
		right_entry.value = "";
	}
	
	</script>

</head>

<body>
	<header>Flash card app <small>(wip)</small></header>
	<section>
		
		<h4>Card bay</h4>
		<table style="height: 150px">
			<td><button id="left" onclick="toggle_blur('left')">N/A</td>
			<td><button id="right" onclick="toggle_blur('right')">N/A</td>
		</table>
		
		<h4>Change deck/card</h4>
		<div style="height: 200px; overflow: auto">
			<table id="card_selector">
				<?php
					$file = fopen("template/notes/chemistry/acidsandbases.txt", "r") or die();
					
					while(($line = fgets($file)) !== false) {
						list($left, $right) = explode("=", $line);
						
						# Apparently, it's bad practice to store application state in the DOM
						print("\n<tr><td><button data-card=\"$left=$right\" onclick=\"update_card_bay(this)\">$left</button></td></tr>");
					}
					
					fclose($file);
				?>
			</table>
		</div>
		<table>
			<td><textarea id="left_entry">Question...</textarea></td>
			<td><textarea id="right_entry">Answer...</textarea></td>
			<td><button onclick="add_card()">Add</button></td>
		</table>
		
	</section>
	<footer><a href="index.html">Home</a></footer>
</body>
