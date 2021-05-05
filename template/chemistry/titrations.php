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
var dilution_factor_of_base;
var calculate = calculate_0;
var calculate_molarity_of_acid = calculate_molarity_of_acid_0;
var calculate_molarity_of_base = calculate_molarity_of_base_1;

var loop_timer = null;
var volume_of_base_drained;
var time_elapsed = 0;
var unit_meaning = 0.1;
var timeout = unit_meaning * 100;
var context = null;

function init() {
	context = canvas.getContext('2d');
	context.fillStyle = "<?=$dark?>";
	reset_variables();
	base_mode_1();
	mode_0();
	download_unknown();
}

function reset_variables() {
	dilution_factor_of_acid = 1;
	dilution_factor_of_base = 1;
	volume_of_acid = 0.025;
	acid_to_base_ratio = 1;
	molarity_of_acid = 0.1;
	molarity_of_base = 0.1 + 0.5 * Math.random();
	mode_0;
}

function download() {
	acid_to_base_ratio = parseFloat(acid_to_base_ratio_input.value);
	molarity_of_acid = parseFloat(molarity_of_acid_input.value);
	dilution_factor_of_acid = parseFloat(dilution_factor_of_acid_input.value);
	dilution_factor_of_base = parseFloat(dilution_factor_of_base_input.value);
	moles_of_acid = parseFloat(moles_of_acid_input.value);
	volume_of_acid = parseFloat(volume_of_acid_input.value);
	volume_of_base = parseFloat(volume_of_base_input.value);
}

function mode_0() {
	clear_table();
	molarity_of_acid_input_div.style.display = "block";
	dilution_factor_of_acid_input_div.style.display = "none";
	moles_of_acid_div.style.display = "none";
	molarity_of_acid_tr.style.display = "none";
	calculate = calculate_0;
}

function mode_1() {
	clear_table();
	molarity_of_acid_input_div.style.display = "none";
	dilution_factor_of_acid_input_div.style.display = "block";
	moles_of_acid_div.style.display = "block";
	molarity_of_acid_tr.style.display = "table-row";
	calculate = calculate_1;
}

function calculate_molarity_of_acid_0() {
	return molarity_of_acid;
}

function calculate_molarity_of_acid_1() {
	return moles_of_acid / volume_of_acid / dilution_factor_of_acid;
}

// The volume of the base is known
function calculate_molarity_of_base_1() {
	return moles_of_base / volume_of_base;
}

function calculate_molarity_of_base_2() {
	return 0.1 + 0.5 * Math.random();
}

function calculate_0() {
	moles_of_acid = molarity_of_acid * volume_of_acid;
	moles_of_base = 1 / acid_to_base_ratio * moles_of_acid * dilution_factor_of_base;
	molarity_of_base = calculate_molarity_of_base();
	volume_of_base = moles_of_base / molarity_of_base;
}

function calculate_1() {
	molarity_of_acid = moles_of_acid / volume_of_acid / dilution_factor_of_acid;
	calculate_0();
}

// Use a random value for the molarity
function base_mode_2(){
	volume_of_base_div.style.display = "none";
	dilution_factor_of_base_input_div.style.display = "none";
	volume_of_base_tr.style.display = "table-row";
	random_notice_p.style.display = "block";
	calculate_molarity_of_base = calculate_molarity_of_base_2;
}

// Calculate the molarity of the base given the volume, number of moles and dilution factor
function base_mode_1(){
	volume_of_base_div.style.display = "block";
	dilution_factor_of_base_input_div.style.display = "block";
	volume_of_base_tr.style.display = "none";
	random_notice_p.style.display = "none";
	calculate_molarity_of_base = calculate_molarity_of_base_1;
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

function start() {
	time_elapsed = 0;
	loop_timer = window.setInterval(simulate, timeout);
}

function simulate() {

	volume_of_base_drained = 0.0025 * time_elapsed;
	draw();

	if (volume_of_base_drained < volume_of_base) {
		time_elapsed += unit_meaning;
	} else {
		upload();
		window.clearTimeout(loop_timer);
	}
	
}

function draw() {
	context.clearRect(0,0,200,400);

	// Draw burette
	context.fillRect(95,25+volume_of_base_drained*10000, 10, 250-volume_of_base_drained*10000);
	context.strokeRect(95,25, 10, 250);

	var volume_of_liquid_in_conical_flask = (volume_of_base + volume_of_acid) * 0.01; // We have to convert liters to meters cubed
	var conical_flask_radius = Math.pow((3*volume_of_liquid_in_conical_flask + 3*0.01*0.025 /*We leave some extra room*/)/(16.0*Math.PI), 1.0/3.0);

	context.beginPath();
	context.moveTo(100 - 2 * conical_flask_radius * 500, 390);
	context.lineTo(100 + 2 * conical_flask_radius * 500, 390);
	context.lineTo(100 + conical_flask_radius * 500, 390 - 2 * conical_flask_radius * 500);
	context.lineTo(100 - conical_flask_radius * 500, 390 - 2 * conical_flask_radius * 500);
	context.closePath();
	context.stroke();

	var imaginary_cone_radius = Math.pow(3*(volume_of_liquid_in_conical_flask - volume_of_base_drained*0.01)/(16.0*Math.PI), 1.0/3.0);
	var liquid_height = 4 * conical_flask_radius - 4 * imaginary_cone_radius;
	context.beginPath();
	context.moveTo(100 - 2 * conical_flask_radius * 500, 390);
	context.lineTo(100 + 2 * conical_flask_radius * 500, 390);
	context.lineTo(100 + (2 * conical_flask_radius - liquid_height / 2.0) * 500, 390 - liquid_height * 500);
	context.lineTo(100 - (2 * conical_flask_radius - liquid_height / 2.0) * 500, 390 - liquid_height * 500);
	context.closePath();
	context.fill();

	// Draw the neck
	context.beginPath();
	context.moveTo(100 - conical_flask_radius * 500, 390 - 2 * conical_flask_radius * 500);
	context.lineTo(100 - conical_flask_radius * 500, 390 - 6 * conical_flask_radius * 500);
	context.lineTo(100 + conical_flask_radius * 500, 390 - 6 * conical_flask_radius * 500);
	context.lineTo(100 + conical_flask_radius * 500, 390 - 2 * conical_flask_radius * 500);
	context.stroke();
}

function download_unknown() {
	var unknown;
	var known;

	if (unknown_base.checked) {
		unknown="base";
		known = "acid";
	} else {
		unknown="acid";
		known="base";
	}
	
	knowns = document.getElementsByClassName("known");
	for (i=0; i<knowns.length; i++) {
		knowns[i].innerHTML = known;
	}

	unknowns = document.getElementsByClassName("unknown");
	for (i=0; i<unknowns.length; i++) {
		unknowns[i].innerHTML = unknown;
	}
}

</script>

</head>

<body onload="init()">
	<h1>Titrations</h1>
	
	<section style="float: right; width: 600px;">
		<h2>What you want to know about</h2>
		<input onchange="download_unknown()" type="radio" name="unknown_radio" id="unknown_base" checked="true"> The properties of the base are unknown<br>
		<input onchange="download_unknown()" type="radio" name="unknown_radio" id="unknown_acid"> The properties of the acid are unknown

		<h2>Calculation type</h2>
		<button onclick="mode_0()">I know the volume of the <span class="known"></span>, and its molarity</button>
		<button onclick="mode_1()">I know the volume of the <span class="known"></span>, and the number moles dissolved therin</button>
		<button onclick="base_mode_1()">I know the volume of the <span class="unknown"></span> needed to reach the end point</button>
		<button onclick="base_mode_2()">Use a random value for the molarity of the <span class="unknown"></span></button>

		<h2>Parameters</h2>
	
		<div><input id="acid_to_base_ratio_input" type="number" value="1"> The <span class="known"></span> to <span class="unknown"></span> ratio</div>
		<div id="molarity_of_acid_input_div"><input id="molarity_of_acid_input" type="number" value="0.1"> Molarity of the <span class="known"></span></div>
		<div><input id="volume_of_acid_input" type="number" value="0.025"> The volume of the <span class="known"></span> (L)</div>
		<div id="moles_of_acid_div"><input id="moles_of_acid_input" type="number" value="1.0"> The number of moles of the <span class="known"></span></div>
		<div id="dilution_factor_of_acid_input_div"><input id="dilution_factor_of_acid_input" type="number" value="1.0"> The dilution factor of the <span class="known"></span></div>
		<div id="volume_of_base_div"><input id="volume_of_base_input" type="number" value="0.025"> The volume of <span class="unknown"></span> needed to reach the end point (L)</div>
		<div id="dilution_factor_of_base_input_div"><input id="dilution_factor_of_base_input" type="number" value="1.0"> The dilution factor of the <span class="unknown"></span></div>
		
		<p id="random_notice_p">The molarity of the <span class="unknown"></span> will be a random value between 0.1M and 0.4M.</p>
		<button onclick="holy_trinity();">Calculate</button>
		
		<h2>Outputs</h2>
		<table>
			<tr id="molarity_of_acid_tr">
				<td>The molarity of the <span class="known"></span></td>
				<td>(N<sub>of moles of <span class="known"></span></sub>/V<sub><span class="known"></span></sub>)/k</td>
				<td id="molarity_of_acid_td"></td>
			</tr>
			<tr>
				<td>The number of moles of <span class="known"></span> inside the conical flask</td>
				<td>V<sub><span class="known"></span></sub>M<sub><span class="known"></span></sub></td>
				<td id="moles_of_acid_td"></td>
			</tr>
			<tr id="volume_of_base_tr">
				<td>The volume of the <span class="unknown"></span> needed to neutralise the flask</td>
				<td id="volume_of_base_source_td"><em><span class="unknown"></span>d on random molarity</em></td>
				<td id="volume_of_base_needed_to_neutralise_td"></td>
			</tr>
			<tr>
				<td>The molarity of the <span class="unknown"></span></td>
				<td>(V<sub><span class="known"></span></sub>M<sub><span class="known"></span></sub>)/V<sub><span class="unknown"></span></sub></td>
				<td id="molarity_of_base_td"></td>
			</tr>
			<tr>
				<td>The number of moles of the <span class="unknown"></span> needed to neutralise the flask</td>
				<td>M<sub><span class="unknown"></span></sub>V<sub><span class="unknown"></span></sub></td>
				<td id="moles_of_base_needed_to_neutralise_td"></td>
			</tr>
		</table>
	</section>

	<center>
		<h2>Simulation</h2>
		<canvas id="canvas" width="200" height="400" style="width: 200px; height: 400px"></canvas>
		<button style="display: block;" onclick="calculate(); start();">Simulate</button>
		<p>The burette drains at 2.5cm<sup>3</sup> per second</p>
	</center>

	<h2>Description</h2>
	<ul>
		<li>The simulation is rendered accurately on screen, as you can see. In fact, it's so precise, that the values cannot be discerned using traditional measurement tools.</li>
	</ul>

	<hr>

	<a href="index.html">Back to index</a> <a href="/chemistry/titrations-log.html">Log</a>
</body>
