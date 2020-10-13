# Lab 4

## Team: LingoLand

## Team Members:
Yuhao Wang
Kristofer Kwan
Sam Avis
Yanshen Lin
Phillip Chang

## Instructor:
Dr.Callahan

## TA:
Priyanshu Tripathi

## Part1a:
For Part1a we created a recursive function to iterate over the DOM. We started with the placeOutlinePartA function, which acts as the kicker function for the recursion as well as setting the inner HTML to what the recursive function returns. The recursion starts with the html tag. The function first edits the return string by adding the current tag's information. This information consists of the tag's name as well as its depth, which is calculated by iterating the depth count every time the function calls itself. In order to recurse down the DOM layers, we iterated over the children of the current element, calling the same function for each child. As a web developer, using the DOM is useful because it allows us to use JS to dynamically change what the user sees by adding or changing the page's html layout.

## Part1b:
For Part 1b, we utilized the same recursive structure as Part1a to iterate thought the elements. However, instead of using `.children` on the element passed into the function, we instead passed in a unique classname, `root-<unique_element_name>`. the `unique_element_name` is also referenced by a given element's children as class `<unique_element_name>`. As such, to search for the children, we simply searched for all elements that had the `<unique_element_name>` class. We started from the html tag, with a depth of 0 (which indicates how many dashes to place before the tag), and the name of the element to print. The recursive function will pass the `root-<unique_element_name>`, of EACH child element found from the parent. The base case of the recusion is reached when the rootName is "" (in which case there will be no children returned as no element has an empty string class). 
>Note that name and classname can be different as some elements like div are repeated in the webpage.
	
## Part2:
The onclick event iterates recursively through the DOM because it is applied to every element as the recursive function goes through the DOM's tree structure depth-first. We also had to add another parameter to the function that kept track of if the current element was found in the body. If so, it will alert the user about the element name. Without the use of JQuery, we had to apply the new attribute to each individual DOM object that fit the given parameter of being in the body, checking each node of the DOM tree individually.

## Part3:
We applied two important methods (appendchild() and clonenode()) which are required for this part. The cloneNode() method creates a copy of a node, and returns the clone. After we created the clone, we changed the cloneNode() innerHTML to our quote. Then we applied the appendChild() method. The appendChild() method appends a node as the last child of a node. We first clone the "root-div" as a node then append a div tag with the quote into the `root-div` div element. In addition for mouse events, we use addEventListener methods by iterating all div we want to change the color when our mouse is over or not. Also, we applied the position changed by adding CSS style inside the JavaScript function when our mouse is over or not.

## Creativity:
Yuhao Wang (wangy63)
- What I make is that I create a speech button. This skill is inspired by a funny game video. Then I search Google for a lot of resources to learn how to create a normal speech button. I also have applied this similar method into our group project. Hope you can enjoy the AI voice, Lol.

Yanshen Lin (liny16)
- I add the color border animation around the div tag. Which is changing during the 6s. Enhance the color of the webpage, and you will not be so bored.
- I also added some css for the button tag. Made it look more funny. 

Sam Avis (aviss)

- I generally made the site more colorful. 
- I added the rainbow background as I thought the plain white would be dull. I also added the moving animation to the background. 
- I then added a white border around the text to make it easier to read with the new background. 
- I also changed the color of hovering over the divs from a static color to a random color that keeps changing.

Kristofer Kwan (kwank2)
- changed the border radius of each individual div tag
- added some box shadowing to make the individual blocks stick out a bit more (basically I made cards per each part of the lab documented on the webpage) 

Philip Chang
- added so that the button's cursor would change into a pointer while hovering over it
- made it so that the when the "Element node" and "Debugging Javascript using Developer Tools for Chrome" are clicked, they open up in a new tab rather than in the current one
