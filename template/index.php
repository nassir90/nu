<!DOCTYPE html>

<head>
	<title>Naza's Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script>
	
	function change_card(button_id) {
		var data_card = document.getElementById(button_id).getAttribute("data-card").split("=");
		document.getElementById("left_text").innerHTML = data_card[0];
		document.getElementById("right_text").innerHTML = data_card[1];
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
		
		<section class="card-select">
		<table style="width:100%">
			<?php
				chdir("template");
				$file = fopen("flashcardsets/acidsandbases.txt", "r") or die();
				
				$counter = 0;
				
				while(!feof($file)) {
					list($left, $right) = explode("=", fgets($file));
					print("<tr><td><button data-card=\"$left=$right\" class='inner-button' id=\"$counter\" onclick=\"change_card('$counter')\">$left</button></td></tr>");
					$counter += 1;
				}
				
				fclose($file);
			?>
		</table>
		</section>
		
		<h1>Flashcard sets</h1>
		<ul><li><a href="flashcardsets/acidsandbases.html">acids and bases</a></li></ul>
	</section>

	<section class="box">
		<h1>Links to other pages</h1>
		<ul><li><a href="https://openra.net">OpenRA - an RTS game</a></li></ul>
	</section>
</body>
