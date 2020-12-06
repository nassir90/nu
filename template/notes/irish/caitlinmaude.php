<?php require("preprocessing/utilities.php") ?>

<!DOCTYPE html>

<head>
	<title>Caitlín Maude</title>
	<link rel="stylesheet" href="../../style.css">
	<meta charset="UTF-8">
</head>

<body>
	<h1 class="box">Caitlín Maude</h1>
	
	<section class="box">
		<h1>Cúlra an fhile</h1>
		<?php print(file_to_table("template/notes/irish/caitlinmaude_background.txt")); ?>
		
		<h1>Géibheann</h1>
		<h4>Vocabulary</h4>
		<?php print(file_to_table("template/notes/irish/caitlinmaude_geibheann_vocabulary.txt"));?>
		
		<h4>Íomhanna</h4>
		<p>Feicimid dhá íomhanna sa dán seo: íomhá an anmhí san áit a bhí dual dó, agus íomhá an ainmhí i zú.</p>
	</section>
	
	<center class="box"><a href="../../index.html">Home</a></center>
</body>
