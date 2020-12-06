<?php
	require("preprocessing/utilities.php");
?>

<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../../style.css">
	<title>Caitlín Maude</title>
</head>

<body>
	<header class="box">
		<h1>Caitlín Maude</h1>
	</header>
	<section class="box">
		<h1>Cúlra an fhile</h1>
		<table>
			<?php print(file_to_table("template/notes/irish/caitlinmaude_background.txt")); ?>
		</table>
		
		<h1>Géibheann</h1>
		<h4>Vocabulary</h4>
		<table>
		<?php print(file_to_table("template/notes/irish/caitlinmaude_geibheann_vocabulary.txt"));?>
		</table>
	</section>
	<footer class="box">
		<center><a href="../../index.html">Home</a></center>
	</footer>
</body>
