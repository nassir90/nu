<!DOCTYPE html>
<?$counter = 0?>

<head>
	<title>Flash card app</title>
	<link rel="stylesheet" href="simple.css">

	<script>

	var cards = <?php
		$counter = 0;
		$file = fopen("template/notes/chemistry/acidsandbases.txt", "r") or die();
		$content = "";
		while(($line = fgets($file)) !== false) {
			$card = explode("=", $line);
			$content .= ++$counter . ": [\"" . trim($card[0]) . "\", \"" . trim($card[1]) . "\"]" . ",\n";
		}

		fclose($file); // Ugly code works

		print("{" . $content . "}");
	?>;

	var counter = <?=$counter?>;

	function reconstruct_selector() {
		card_list.innerHTML = "";
		var keys = Object.keys(cards);
		for(i = 0; i < keys.length; i++) {
			card_list.innerHTML += "<tr><td><button onclick=\"update_card_bay(this);\" data-id='" + keys[i] +"'>" + cards[keys[i]][0] + "</button></td></tr>\n";
		}
	}

	function toggle_blur(element) {
		element.style.filter = element.style.filter == "none" ? "blur(3px)" : "none";
	}

	window.onkeyup = function(e) {
		if (e.keyCode == 65) {
			toggle_blur(left);
		} else if (e.keyCode == 68) {
			toggle_blur(right);
		}
	}

	function update_card_bay(button) {
		var parts = cards[parseInt(button.getAttribute("data-id"))];
		left.innerHTML = parts[0];
		right.innerHTML = parts[1];
	}

	function pop_inputs() {
		var left = left_input.value.trim();
		var right = right_input.value.trim();

		// genesis 6:5
		if (left.length && right.length) {
			cards[++counter] = [left, right];
			reconstruct_selector();
			left_input.value = "";
			right_input.value = "";
		}
	}

	</script>

</head>

<body onload="reconstruct_selector()">
	<header><h1>Flash card app</h1></header>
	<section>
		<noscript><strong>Your client can't run javascript. You're probably better off to be honest.</strong></noscript>
		<h4>Card bay</h4>
		<table style="height: 150px">
			<td><button id="left" onclick="toggle_blur(this)">N/A</td>
			<td><button id="right" onclick="toggle_blur(this)">N/A</td>
		</table>

		<h4>Change deck/card</h4>
		<div style="height: 200px; overflow: auto">
			<table id="card_list"></table>
		</div>
		<table>
			<td><textarea id="left_input">9+10</textarea></td>
			<td><textarea id="right_input">21</textarea></td>
			<td><button onclick="pop_inputs();">Add</button></td>
		</table>

	</section>
	<footer><a href="index.html">Home</a></footer>
</body>
