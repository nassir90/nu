<?php
$dark = "hsl(50, 100%, 10%)";
$base = "hsl(50, 100%, 30%)";
$light = "hsl(50, 100%, 40%)";
?>

/*The only textareas used are inside <td> elements, so I want them to integrate properly */
textarea {
	width: 90%;
	resize: none;
}

body {
	background-color: <?=$dark?>;
	color: <?=$light?>;
}

/*Normally, the side of <td> tags varies depending on the contents. I don't want this. The default behavior of table.width is to take up only the amount of space the table needs, but I want the table to fill the page horizonatally*/ table {
	width: 100%;
	table-layout: fixed;
}

section { 
	background-color: <?=$light?>;
	color: <?=$dark?>;
	border: 9px outset <?=$light?>;
	margin: 2%;
}

header {
	text-align: center;
	margin: 2%;
}

footer {
	text-align: center;
	margin: 2%;
}

td, button {
	background-color: <?=$dark?>;
	color: <?=$light?>;
	border: 3px inset <?=$dark?>;
}

td button, td textarea {
	background-color: inherit;
	color: inherit;
	border: 0px;
}

a {
	color: inherit
}
