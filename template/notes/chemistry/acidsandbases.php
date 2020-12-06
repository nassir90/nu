<?php
	require("preprocessing/utilities.php")
?>

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
		<?php print(file_to_table("template/notes/chemistry/acidsandbases.txt")); ?>
	</table>
	<footer class="box">
		<center><a href="../../index.html">Home</a></center>
	</footer>
</body>
