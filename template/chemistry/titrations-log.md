# Quick titrations simulation
I'll make a titration simulator that will do the calculations for the user aswell as providing an interactive mode of carrying out the experiment. They'll be able to leave the burette open until the stuff in the conical flask changes color.

## Planning

I need to:

* Port the calculations into javascript, and display the results on a table.
The calculations take inputs and produce outputs, so I'll use the upload/download system that I used [here](../appliedmaths/inclinedplane.html).
* Make graphics for all the apparatus.
This is a more laborious task, but doable.
I might just use squares for the MVP.
* Summarise the experiment so that the page is useful even without javascript.
There's an argument to be made that if the page is informative, it should have no javascript, but for this site in particular, both are equally important.
* Integrate the calculation part in with the simulation part.
I'm not actually going to let the user let the burette run.
I'll just put it on train tracks.
* Allow the user to decide whether to use a known base volume OR a random base volume due to a random molarity.
* Allow the user to switch between unknown base properties and unknown acid properties.

I want to:

* Make the output numbers reasonably nice.
Javascript allows you to round by significant figures, which is better than only keeping n decimal places for all numbers.
* Finally get unknown variables working.
I could do this by essentially having multiple apps on the same page.
There would be different HTML input and output sections for each app, and they'd each have their own javascript functions.
The only problem with this approach is that it makes other functions invisible if you don't have javascript...
I could have them all be visible.
If it's too ugly, I'll just use the javascript only method.

## Implementation

As for allowing the user to switch the substance whose properties are unknown, I considered putting all references to acid or base in `<span>` tags, and switching them depending on the unknown substance.
I don't know whether or not this is a good idea.

## Evaluation

