<?php
	require("preprocessing/utilities.php")
?>

<!DOCTYPE html>

<head>
	<title>Acids and bases</title>
	<link rel="stylesheet" href="../../style.css">
</head>

<body>
	<h1 class="box">Acids and bases</h1>
	
	<section class="box">
	<table>
		<?php print(file_to_table("template/notes/chemistry/acidsandbases.txt")); ?>
	</table>
	</section>
	
	<center class="box"><a href="../../index.html">Home</a></center>
</body>
