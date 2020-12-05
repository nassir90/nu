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
<head>

<body>
	<header class="box">
		<h1>Naza's website</h1>
	</header>

	<section class="box">
		<table class="card-bay">
			<tr>
				<td id="left_text">Question</td>
				<td id="right_text">Answer</td>
			</tr>
		</table>
		
		<section class="card-select">
		<table style="width:100%">
			<tr><td><button class="inside-button" onclick="change_card('button1')" id="button1" data-card="ss=dog">Arr</button></td></tr>
		</table>
		</section>
		
		<h1>Flashcard sets</h1>
		<p><li><a href="flashcardsets/acidsandbases.html">acids and bases</a></li></p>
	</section>

	<section class="box">
		<h1>Links to other pages</h1>
		<p><li><a href="https://openra.net">OpenRA - an RTS game</a></li></p>
	</section>
</body>
