<?php require("preprocessing/colors.php")?>

body, a {
	background: <?=$light?>;
	color: <?=$dark?>;
}

hr {
	border: 2px solid <?=$base?>;
}

canvas {
	border: 3px inset <?=$dark?>;
	background: <?=$base?>;
}

h1, td, textarea, button {
	background: <?=$dark?>;
	border: 3px inset <?=$dark?>;
	color: <?=$light?>;
}

td button, td textarea {
	background-color: inherit;
	color: inherit;
	border: none;
	text-align: left;
	resize: none;
}

table {
	table-layout: fixed;
}
