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
		var data_card = document.getElementById("entry-adder").value.split("=");
		var id = "added" + counter;
		entry = "<tr><td><button data-card=\""+ data_card[0] + "=" + data_card[1] + "\" class='inner-button' id=\"" + id + "\" onclick=\"change_card('" + id + "')\">" + data_card[0] + "</button></td></tr>";
		counter += 1;
		
		table.innerHTML += entry;
	}
	
	</script>
</head>

<body>
	<header class="box">
		<h1>Naza's website</h1>
	</header>

	<section class="box">
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
		
		<textarea class="inner-box" style="max-width:50%; max-height:5em" id="entry-adder">Add entries</textarea>
		<button class="inner-box" onclick="append_card()" id="append-button">Add</button>
		
		<h1>Notes</h1>
		<ul>
			<li><a href="notes/chemistry/acidsandbases.html">acids and bases</a></li>
			<li><a href="notes/irish/caitlinmaude.html"</li></ul>
	</section>

	<section class="box">
		<h1>Links to other pages</h1>
		<ul>
			<li><a href="https://openra.net">OpenRA - an RTS game</a></li>
			<li><a href="https://github.com/nassir90/nu">Github repo</a></li>
			<li><a>Monero account - coming soon</a></li>
		</ul>
	</section>
</body>
