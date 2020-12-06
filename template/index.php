<!DOCTYPE html>

<head>
	<title>Naza's Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script>
	
	var counter = 0;
	
	function change_card(button_id) {
		var data_card = document.getElementById(button_id).getAttribute("data-card").split("=");
		document.getElementById("left_text").innerHTML = data_card[0];
		document.getElementById("right_text").innerHTML = data_card[1];
	}
	
	function append_card() {
		var table = document.getElementById("card-selector");
		var left_entry = document.getElementById("left-entry").value.trim();
		var right_entry = document.getElementById("right-entry").value.trim();
		
		if (left_entry.length == 0 || right_entry.length == 0) {
			return;
		}
		
		var id = "added" + counter;
		
		// genesis 6:5
		entry = "<tr><td><button data-card=\""+ left_entry + "=" + right_entry + "\" class='inner-button' id=\"" + id + "\" onclick=\"change_card('" + id + "')\">" + left_entry + "</button></td></tr>";
		counter += 1;
		
		document.getElementById("left-entry").value = "";
		document.getElementById("right-entry").value = "";
		table.innerHTML += entry;
	}
	
	</script>
</head>

<body>
	<header class="box">
		<h1>Naza's website</h1>
	</header>

	<section class="box">
		<h1>Languages used to make this page <small>(in order of quality)</small></h1>
		<ol>
			<li>PHP</li>
			<li>CSS</li>
			<li>HTML</li>
			<li>...</li>
			<li>Javascript</li>
		</ol>
		
		<h1>Flash cards <small>(wip)</small></h1>
		<table class="card-bay">
			<tr>
				<td id="left_text">N/A</td>
				<td id="right_text">N/A</td>
			</tr>
		</table>
		
		<section class="card-selector">
		<table style="width:100%" id="card-selector">
			<?php
				chdir("template");
				$file = fopen("notes/chemistry/acidsandbases.txt", "r") or die();
				
				$counter = 0;
				
				while(($line = fgets($file)) !== false) {
					list($left, $right) = explode("=", $line);
					
					$id = "flashcard" . $counter;
					print("<tr><td><button data-card=\"$left=$right\" class='inner-button' id=\"$id\" onclick=\"change_card('$id')\">$left</button></td></tr>");
					$counter += 1;
				}
				
				fclose($file);
			?>
		</table>
		</section>
		
		<textarea class="inner-box" style="width:23%; height:5em" id="left-entry"></textarea>
		<textarea class="inner-box" style="width:23%; height:5em" id="right-entry"></textarea>
		<button class="inner-box" onclick="append_card()" id="append-button" style="display:block">Add</button>
		
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

	<footer class="box">
		<h1>Links to other pages</h1>
		<ul>
			<li><a href="https://openra.net">OpenRA - an RTS game</a></li>
			<li><a href="https://github.com/nassir90/nu">Github repo</a></li>
		</ul>
	</footer>
</body>
