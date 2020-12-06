<?php
	require("preprocessing/utilities.php");
?>

<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../../style.css">
	<title>Caitlín Maude</title>
</head>

<body>
	<h1 class="box">Caitlín Maude</h1>
	
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
		
		<h4>Íomhanna</h4>
		<p>Feicimid dhá íomhanna sa dán seo: íomhá an anmhí san áit a bhí dual dó, agus íomhá an ainmhí i zú.</p>
	</section>
	
	<center class="box"><a href="../../index.html">Home</a></center>
</body>
