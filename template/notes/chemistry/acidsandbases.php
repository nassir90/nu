<!DOCTYPE html>

<head>
	<title>Flashcard set for acids and bases</title>
	<link rel="stylesheet" href="../../style.css">
</head>

<body>
	<header class="box">
		<h1>Flashcard set for acids and bases</h1>
	</header>
	<table class="box">
		<?php
			chdir("template/notes/chemistry");
			$file = fopen("acidsandbases.txt", "r");
			
			while (($line = fgets($file)) !== false) {
				list($left, $right) = explode("=", $line);
				print("<tr><td>$left</td><td>$right</td></tr>");
			}
			
			fclose($file);
		?>
	</table>
	<footer class="box">
		<center><a href="../index.html">Home</a></center>
	</footer>
</body>