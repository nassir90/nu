<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="../simple.css">
	<title>Reflection</title>
</head>

<body>
	<h1>Reflection on the induction simulation</h1>

	<h2>Time</h2>
	<p>This program should have been pretty easy to make, but I just didn't know the right way to tackle it. The first version was so inaccurate, that it would serve better as a random number generator than a physics simulation. I was trusting that <code>window.setTimeout(function, time)</code> would call my code at regular intervals, but this was finicky, and became a source of problems. It resulted in the displayed average speed (actual, real world motion of the magnet) being completely different from the target speed inputted by the user.</p>

	<p>I ended up switching to virtual time, i.e. incrementing a counter by a particular amount that represents real world time. Realistically, not many legitimate simulations are going to be ran at real time, so it makes sense. I also figured out, by experimentation, the variables to use to get the visual simulation of the magnet to line up with the mathematical 'simulation' of the magnets.</p>

	<h2>Other</h2>
	<p>I should probably change the magnet, or remove it all together, as it's quite disingenuous. The magnetic flux density around a point magnet does not drop off uniformily, as there is a dipole. You've seen the images, the magnetic field lines look like two ovals. Because of this, there's no simple formula that you can use to represent the magnetic flux density as a function of distance. This is what helmholtz coils are for, but they are not point magnets. The "magnet" just represents an ethereal magnetic field which is strong in the middle and weaker at the sides. I've used a linear drop off function, as this makes it easier to match equations based on faraday's law of electromagnetic induction</p>
	
	<p>Some more simulation parameters would be cool, like an option to cause the magnetic field to move from side to side until unlocked, or an option to rotate the coil such that it would be at a different angle to the field</p>
	<hr>
	
	<a href="induction.html">Back to simulation</a>
	
</body>
