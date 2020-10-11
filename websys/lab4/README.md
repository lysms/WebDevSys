# Lab 4

Team: LingoLand

Team Members:
Yuhao Wang
Kristofer Kwan
Sam Avis
Yanshen Lin
Phillip Chang

Instructor:
Dr.Callahan

TA:
Priyanshu Tripathi

Part1a:
	For Part1a we created a recursive function to iterate over the DOM. We started with the placeOutlinePartA function, which acts as the kicker function for the recursion as well as setting the inner HTML to what the recursive function returns. The recursion starts with the html tag. The function first edits the return string by adding the current tag's information. This information consists of the tag's name as well as its depth, which is calculated by iterating the depth count every time the function calls itself. In order to recurse down the DOM layers, we iterated over the children of the current element, calling the same function for each child. As a web developer, using the DOM is useful because it allows us to use JS to dynamically change what the user sees by adding or changing the page's html layout.

Part1b:
	
Part2:
	The onclick event bubbles through the DOM because it is applied to every element as the recursive function goes through the DOM's tree structure depth-first. We also had to add another parameter to the function that kept track of if the current element was in the body. Without the use of JQuery, we had to apply the new attribute to each individual DOM object that fit the given parameter of being in the body, checking each node of the DOM tree individually.
Part3:
	
Creativity:
Yuhao Wang (wangy63)
	- What I make is that I create a speech button. This skill is inspired by a funny game video. Then I search Google for a lot of resources to learn how to create a normal speech button. I also have applied this similar method into our group project. Hope you can enjoy the AI voice, Lol.

Yanshen Lin (liny16)
	- I add the color border animation around the div tag. Which is changing during the 6s. Enhance the color of the webpage, and you will not be so bored.
	- I also added some css for the button tag. Made it look more funny. 

Sam Avis (aviss)
	I generally made the site more colorful. 
	I added the rainbow background as I thought the plain white would be dull. I also added the moving animation to the background. 
	I then added a white border around the text to make it easier to read with the new background. 
	I also changed the color of hovering over the divs from a static color to a random color that keeps changing.
