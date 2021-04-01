# How I make a simulation
In this document, I'll guide you through how I'd make a basic simulation of a brick falling on the ground.

## Prerequisites

You need to:

* Understand basic HTML.
* Understand basic Javascript.

Web Development is so trendy right now that you can basically learn it in any format that you fancy.
The [MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web) are pretty useful if your a reader.
Here's a [youtube video]() if you like watching your content.

## The Steps

### Make the skeleton webpage
First use your knowledge of rudimentary HTML, make a website with a title and a heading.

I simply used 'Mock Simulation'

[Source Code](skeleton.html)

### Initialise the canvas context
The `<canvas>` element provides an area on the screen for drawing.
To use the canvas, you need to get a `context` from it, which has methods that allow you to draw to the canvas.
The context can be obtained with the line: `context = canvas.getContext('2d')`.
If you don't already know, you can reference HTML elements from Javascript if they have an id.
You have to pass an argument as there are multiple ways of drawing to the screen, hence there are multiple contexts.

HTML is parsed from top to bottom, so you would normally have to put the script below the canvas element.
This is what Mr Foley does on [mathsphysics.com](http://mathsphysics.com/).
However, I like having the script in the `<head>`.
To do this, you have to create an initialisation function, which is to be called once the `<body>` has been loaded.
To call the function once the `<body>` is loaded, you use the `onload` attribute.

[Source Code](initialisation.html)


### Draw to the canvas

To reiterate what I said before, you use the context object to draw onto the canvas.
You normally create a `draw()` function to hold all of the rendering code.

These methods are to be used.

* `context.fillRect(startx, starty, sizex, sizey)` - This function is pretty self explanatory.
The starting coordinates refer to the top left of the rectangle.
The rectangle expands rightwards and downwards, according the the values of sizex and sizey.
* `context.clearRect(startx, starty, sizex, sizey)` - This function is identical to the former function, differing only that it erases anything on the canvas rather than filling the specified area with a color.

[Source Code](canvas.html)

### Getting input
To get numerical input, you use `<input type="number"`>.
The `<input>` element has a member called `value` which holds the string representation of the number contained in it.
You have to convert this to a number in javascript, and you do this using the function `parseInt()`;
The `parseInt()` function takes a string argument and returns the parsed number OR a special value called NaN(Not a number).

You shouldn't have to deal with NaNs, as by specifying `type=number` HTML will prohibit any non-numeric characters from being entered into the input box.
You can also set minimum and maximum values using the `min` and `max` attributes respectively.

The user inputs a value in meters, and we parse it to pixels.
The canvas coordinate space increases rightwards along the x axis and downwards along the y axis.
If we take 10 pixels to be 1 meter, the maximum height of the block is 30 meters.
To parse the meters into a pixel offset for internal use, we invert it and then multiply it by 10.

`offset_from_top = (30 - meters) * 10`

You use button elements to get Javascript to recognise that the values have been updated.
You set the `onclick` attribute to call whatever javascript function downloads the values from the input box.
I called my function `download()`.

[Source Code](downloads.html)

### Simulate the motion of the block as a function of time
To get a value for the amount of time elapsed, you need to use the `Date` facility.
To create a date, you call `new Date()`.
The date object has a method called `getTime()` which returns the amount of milliseconds passed since the unix epoch time.
In order to get a value for the time elapsed since a particular point in time, you simply subtract it time from the the current time.

The formula for the displacement of a falling block is `(a/2)*t^2`.
Gravity is 98 pixels per second per second.
Internally, the top of the canvas is not 30 meters, but 0 pixels and the bottom is 300 pixels.
When the block reaches the bottom, the simulatio should end, but otherwise, the block should appear to fall downwards.

To do this, you need to create a function that:

* Checks if the block has reached the bottom of the screen.
* Renders the block or resets the simulation depending on whether or not its falling.

This function must be called repeatedly.
Javascript provides a way of doing this by means of the `id = window.setInterval(function, time)` method.
This method takes a function to call periodically at offsets of '`time`' milliseconds.
When the simulation is over, you need to make sure that Javascript knows to stop calling the loop.
To do this, you call `window.clearInterval(id)`.

The position of the block has to be reset after the simulation ends for aesthetic purposes, and the starting time has to be reset before the next simulation begins for practical purposes.
I bundle both of these into a `reset()` funciton which is called when required.

To start the loop, you create another button.
This button's `onclick` attribute should:

* Reset the simulation.
* Set the `id` variable to `window.setInterval(your_loop_function, small_enogugh_interval)`.

[Source Code](loop.html)

### Output results
After each drop, you should store the height and the time needed for the block to hit the ground.
To do this, you use Javascript arrays.
After the simulation ends, in addition to resetting things, you should add to a results array.

In addition to the `download()` function, you then need an `upload()` function to display the results.
`<table>` elements are good for this.
The HTML syntax for tables is pretty straightforward:

* First you have enclosing `<table>` tags.
* Inside the table, you have multiple rows marked by `<tr>` tags.
* Inside the `<tr>` tags, you have multiple `<td>` tags, which are essentially columns.

To upload the results, you iterate over the results array, and add a row for each result.
To add a row, you simply append a `<tr> ... </tr>` element to the table's `innerHTML` member, which is exposed in Javascript.

[Source Code](the-whole-nine-yards.html)

---

[Back to index](../index.html)
