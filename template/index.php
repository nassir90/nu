<!DOCTYPE html>

<head>
	<title>Naza's Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">


<head>

<body>
	<div class="box">
		<h1>Naza's website</h1>
	</div>

	<div class="box">
		<p>Html is simple once you start trying to use it</p>
		<h1>Undeducated musings</h1>
		<p>
		<li><a href="biosecurity.html">Biosecurity</a></li>
		<li><a href="maybevirusnondemic.html">The big perhaps</a></li>
		</p>
		<h1>Links to other pages</h1>
		<p>
		<li><a href="https://openra.net">OpenRA - an RTS game</a></li>
		</p>
	</div>

	<div class="box">
		<h1>Chemistry Experiment?</h1>
		<canvas id="game">canvas can't be loaded</canvas>
	</div>
	<script>
		var canvas = document.getElementById("game");
		var context = canvas.getContext("2d");
		
		function doIReallyNeedToCallThis() {
			canvas = document.getElementById("game");
			context = canvas.getContext("2d");
			context.fillStyle="white";
			context.fillRect(0,0,canvas.width, canvas.height);
		}
		
		doIReallyNeedToCallThis();
	</script>
</body>
