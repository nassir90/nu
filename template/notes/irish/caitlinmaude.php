<?php require("preprocessing/utilities.php") ?>

<!DOCTYPE html>

<head>
	<title>Caitlín Maude</title>
	<link rel="stylesheet" href="../../style.css">
	<meta charset="utf-8">
</head>

<body>
	<header><h1>Caitlín Maude</h1></header>
	
	<section>
		<h2>Cúlra an fhile</h2>
		<?php print(file_to_table("template/notes/irish/caitlinmaude_background.txt")); ?>
		
		<h2>Géibheann</h2>
		<h4>Vocabulary</h4>
		<?php print(file_to_table("template/notes/irish/caitlinmaude_geibheann_vocabulary.txt"));?>
		
		<h4>Íomhanna</h4>
		<p>Feicimid dhá íomhanna sa dán seo: íomhá an anmhí san áit a bhí dual dó, agus íomhá an ainmhí i zú.</p>
	</section>
	
	<footer><a href="../../index.html">Home</a></footer>
</body>
