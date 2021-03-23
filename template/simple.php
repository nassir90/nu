<?php require("php/colors.php")?>

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

h1, td, textarea, button, input {
	background: <?=$dark?>;
	border: 3px inset <?=$dark?>;
	color: <?=$light?>;
}

td button, td textarea, td fieldset, td input {
	background-color: inherit;
	color: inherit;
	border: none;
	text-align: left;
	resize: none;
}
