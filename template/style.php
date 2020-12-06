<?php
	$dark = "hsl(50, 100%, 10%)";
	$base = "hsl(50, 100%, 30%)";
	$light = "hsl(50, 100%, 40%)";
?>

body { background-color: <?=$dark?>; color: <?=$light?>; }
/*The only textareas used are inside <td> elements, so I want them to integrate properly */
textarea { width: 90%; resize: none; }
/*Normally, the side of <td> tags varies depending on the contents. I don't want this. The default behavior of table.width is to take up only the amount of space the table needs, but I want the table to fill the page horizonatally*/
table { table-layout: fixed; width: 100%; }

.box { background-color: <?=$light?>; color: <?=$dark?>; border: 7px outset <?=$light?>; margin: 2%;}
td, button { background-color: <?=$dark?>; color: <?=$light?>; border: 10px inset <?=$dark?>; }
td button, td textarea { background-color: inherit; color: inherit; border: 0px; }
.row { height: 150px; overflow: auto; }
