<?php
	$dark_green = "hsl(130, 100%, 10%)";
	$base_green = "hsl(130, 100%, 30%)";
	$light_green = "hsl(130, 100%, 40%)";
?>

/*
 * The spacing is a nightmare. I apologise if you have OCD.
 */


body {
	background-color: <?=$dark_green?>;
	color: <?=$light_green?>;
}

.box {
	background-color: <?=$light_green?>;
	color: <?=$dark_green?>;
	border: 10px outset <?=$light_green?>;
	margin: 1%;
}

.inner-box, td {
	background-color: <?=$dark_green?>;
	color: <?=$light_green?>;
	border: 5px inset <?=$dark_green?>;
}

.inner-button {
	background-color: inherit;
	color: inherit;
	border: 0px;
}

.card-row {
	width: 75%;
	height: 150px;
	overflow: auto;
}

textarea {
	resize: none;
}

table {
	table-layout: fixed;
	width: 100%;
}
/* consider khaki and wheat (for white) */
