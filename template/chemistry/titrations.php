<!DOCTYPE>

<?php require("php/colors.php")?>

<head>
	<title>Titrations</title>
	<link rel='stylesheet' href='../simple.css'>

<style>
	li {
		float: left;
	}
</style>

<script>
var n = 3;

var molarity_of_acid;
var volume_of_acid;
var molarity_of_base;
var volume_of_base;
var acid_to_base_ratio; // HCl + NaOH -> NaCl + H2O
var dilution_factor_of_acid;
var calculate = calculate_0;

var loop_timer = null;
var volume_of_base_drained;
var time_elapsed = 0;
var unit_meaning = 0.1;
var timeout = unit_meaning * 1000;
var context = null;

function init() {
	context = canvas.getContext('2d');
	context.fillStyle = "<?=$dark?>";
	reset_variables();
}

function reset_variables() {
	dilution_factor_of_acid = 1;
	volume_of_acid = 0.025;
	acid_to_base_ratio = 1;
	molarity_of_acid = 0.1;
	molarity_of_base = 0.1 + 0.5 * Math.random();
	mode_0;
}

function download() {
	var number;

	number = parseFloat(molarity_of_acid_input.value);
	molarity_of_acid = number ? number : moles_of_acid;

	number = parseFloat(dilution_factor_of_acid_input.value);
	dilution_factor_of_acid = number ? number : dilution_factor_of_acid;

	number = parseFloat(moles_of_acid_input.value);
	moles_of_acid = number ? number : moles_of_acid;

	number = parseFloat(volume_of_acid_input.value);
	volume_of_acid = number ? number : volume_of_acid;
}

function mode_0() {
	clear_table();
	molarity_of_acid_input_div.style.display = "block";
	dilution_factor_of_acid_input_div.style.display = "none";
	moles_of_acid_div.style.display = "none";
	volume_of_acid_div.style.display = "none";
	molarity_of_acid_tr.style.display = "none";
	calculate = calculate_0;
}

function mode_1() {
	clear_table();
	molarity_of_acid_input_div.style.display = "none";
	dilution_factor_of_acid_input_div.style.display = "block";
	moles_of_acid_div.style.display = "block";
	volume_of_acid_div.style.display = "block";
	molarity_of_acid_tr.style.display = "table-row";
	calculate = calculate_1;
}

function calculate_0() {
	moles_of_acid = molarity_of_acid * volume_of_acid;
	moles_of_base = moles_of_acid * acid_to_base_ratio;
	volume_of_base = moles_of_base / molarity_of_base;
}

function calculate_1() {
	molarity_of_acid = moles_of_acid / volume_of_acid / dilution_factor_of_acid;
	calculate_0();
}

function clear_table() {
	molarity_of_acid_td.innerHTML = "";
	moles_of_acid_td.innerHTML = "";
	volume_of_base_needed_to_neutralise_td.innerHTML = "";
	moles_of_base_needed_to_neutralise_td.innerHTML = "";
	molarity_of_base_td.innerHTML = "";
}

function upload() {
	molarity_of_acid_td.innerHTML = molarity_of_acid.toPrecision(n) + " mol/L";
	moles_of_acid_td.innerHTML = moles_of_acid.toPrecision(n) + " moles";
	volume_of_base_needed_to_neutralise_td.innerHTML = volume_of_base.toPrecision(n) + " litres";
	moles_of_base_needed_to_neutralise_td.innerHTML = moles_of_base.toPrecision(n) + " moles";
	molarity_of_base_td.innerHTML = molarity_of_base.toPrecision(n) + " mol/L";
}

function holy_trinity() {
	download();
	calculate();
	upload();
}

function simulate() {
	window.clearTimeout(loop_timer);

	volume_of_base_drained = 0.0025 * time_elapsed;
	draw();

	if (volume_of_base_drained < volume_of_base) {
		time_elapsed += unit_meaning;
		window.setTimeout(simulate, timeout);
	} else {
		upload();
		time_elapsed = 0;
	}
	
}

function draw() {
	context.clearRect(0,0,200,400);

	// Draw retort stand
	context.fillRect(50,25,10,350);
	context.fillRect(30,375,50,10);

	// Draw burette
	context.fillRect(100,25+volume_of_base_drained*10000, 10, 250-volume_of_base_drained*10000);

	// Draw conical flask
	context.fillRect(90, 350-volume_of_base_drained*1000, 30, 30+volume_of_base_drained*1000);
}

</script>
</head>

<body onload="init()">
	<h1>Titrations</h1>
	
	<section style="float: right; width: 600px;">
		<h2>Calculation type</h2>
		<button onclick="mode_0()">I know the molarity of the acid</button>
		<button onclick="mode_1()">I know the volume of the acid, and the number moles dissolved therin</button>

		<h2>Parameters</h2>
		<div id="molarity_of_acid_input_div"><input id="molarity_of_acid_input" type="number" value="0.1"> Molarity of the acid</div>
		<div id="volume_of_acid_div"><input id="volume_of_acid_input" type="number" value="0.025"> The volume of the acid (L)</div>
		<div id="moles_of_acid_div"><input id="moles_of_acid_input" type="number" value="1.0"> The number of moles of the acid</div>
		<div id="dilution_factor_of_acid_input_div"><input id="dilution_factor_of_acid_input" type="number" value="1.0"> The dilution factor of the acid</div>
		<p>The molarity of the base will be a random value between 0.1M and 0.4M.</p>
		<button onclick="holy_trinity();">Calculate</button>
		
		<h2>Outputs</h2>
		<table>
			<tr id="molarity_of_acid_tr">
				<td>The molarity of the acid</td>
				<td>(N<sub>of moles of acid</sub>/V<sub>acid</sub>)/k</td>
				<td id="molarity_of_acid_td"></td>
			</tr>
			<tr>
				<td>The number of moles of acid inside the conical flask</td>
				<td>V<sub>acid</sub>M<sub>acid</sub></td>
				<td id="moles_of_acid_td"></td>
			</tr>
			<tr>
				<td>The volume of the base needed to neutralise the flask</td>
				<td><em>Obtained experimentally</em></td>
				<td id="volume_of_base_needed_to_neutralise_td"></td>
			</tr>
			<tr>
				<td>The molarity of the base</td>
				<td>(V<sub>acid</sub>M<sub>acid</sub>)/V<sub>base</sub></td>
				<td id="molarity_of_base_td"></td>
			</tr>
			<tr>
				<td>The number of moles of the base needed to neutralise the flask</td>
				<td>M<sub>base</sub>V<sub>base</sub></td>
				<td id="moles_of_base_needed_to_neutralise_td"></td>
			</tr>
		</table>
	</section>

	<center>
		<h2>Simulation</h2>
		<canvas id="canvas" width="200" height="400" style="width: 200px; height: 400px"></canvas>
		<button style="display: block;" onclick="calculate(); simulate();">Simulate</button>
		<p>The burette drains at 2.5cm<sup>3</sup> per second</p>
		<p>Also, try not to break the simulation. It's only the conical flask (the square shaped container) is only meant to store 25cm<sup>3</sup> of liquid</p>
	</center>

	<h2>Description</h2>
	<ul>
		<li>The simulation is rendered accurately on screen, as you can see. In fact, it's so precise, that the values cannot be discerned using traditional measurement tools.</li>
	</ul>

	<hr/>

	<a href="index.html">Back to index</a>
</body>
