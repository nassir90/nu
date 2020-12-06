<?php
	require("preprocessing/utilities.php")
?>

<!DOCTYPE html>

<head>
	<title>Acids and bases</title>
	<link rel="stylesheet" href="../../style.css">
</head>

<body>
	<header class="box">
		<h1>Acids and bases</h1>
	</header>
	
	<section class="box">
	<table>
		<?php print(file_to_table("template/notes/chemistry/acidsandbases.txt")); ?>
	</table>
	</section>
	
	<footer class="box">
		<center><a href="../../index.html">Home</a></center>
	</footer>
</body>
