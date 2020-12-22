<?php
$dark = "hsl(50, 100%, 10%)";
$base = "hsl(50, 100%, 30%)";
$light = "hsl(50, 100%, 40%)";
?>

body, a {
	background: <?=$light?>;
	color: <?=$dark?>;
}

hr {
	border: 2px solid <?=$base?>;
}

h1 {
	background: <?=$dark?>;
	border: 3px inset <?=$dark?>;
	color: <?=$light?>;
}
