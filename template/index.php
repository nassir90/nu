<!DOCTYPE html>

<head>
	<title>Naza's Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
	
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
	<header>Naza's website</header>

	<section>
		<h1>Languages used to make this page <small>(in order of quality)</small></h1>
		<ol>
			<li>PHP</li>
			<li>CSS</li>
			<li>HTML</li>
			<li>...</li>
			<li>Javascript</li>
		</ol>
		
		<h1>Flash cards <small>(wip)</small></h1>
		<noscript>Note: This won't work as you have javascript disabled</noscript>
		
		<h4>Card bay</h4>
		<table class="row">
			<td><button id="left" onclick="toggle_blur('left')">N/A</td>
			<td><button id="right" onclick="toggle_blur('right')">N/A</td>
		</table>
		
		<h4>Change deck / card</h4>
		<div class="row">
			<table id="card_selector">
				<?php
					$file = fopen("template/notes/chemistry/acidsandbases.txt", "r") or die();
					
					while(($line = fgets($file)) !== false) {
						list($left, $right) = explode("=", $line);
						
						# Apparently, it's bad practice to store application state in the DOM
						print("<tr><td><button data-card=\"$left=$right\" onclick=\"update_card_bay(this)\">$left</button></td></tr>");
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
		
		<h1>Notes</h1>
		<h4>Chemistry</h4>
		<ul>
			<li><a href="notes/chemistry/acidsandbases.html">Acids and bases</a></li>
		</ul>
		
		<h4>Irish</h4>
		<ul>
			<li><a href="notes/irish/caitlinmaude.html">Caitlín Maude <small>(poetry)</small></a></li>
		</ul>
	</section>

	<footer>
		<h1>Links to other pages</h1>
		<ul>
			<li><a href="https://openra.net">OpenRA - an RTS game</a></li>
			<li><a href="https://github.com/nassir90/nu">Github repo</a></li>
			<li><a href="https://www.theleavingcert.com/exam-papers/">Leaving cert exam papers</a></li>
			<li><a href="http://shakespeare.mit.edu/lear/">King Lear play <small>(old english)</small></a></li>
			<li><a href="https://thephysicsteacher.ie">Physics and Applied maths notes</a></li>
		</ul>
	</footer>
</body>
