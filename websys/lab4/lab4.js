function getOutlinePartA(element, numDashes, inBody){
	if(inBody) {
		element.setAttribute("onclick", "alertBox(this)");
	}
	if(element.tagName == "BODY") {
		inBody = true;	
	}
    let children = element.children;
    var result = "-".repeat(numDashes) + element.tagName + "\n";
    for(var i = 0; i < children.length; i++){
        result += getOutlinePartA(children[i], numDashes+1, inBody);
        result = result.toLowerCase();
    }
    return result;
}

function getRootName(classname){
    var index = classname.search("root") + 5;
    if(index == -1){
        return ""
    }
    return classname.substring(index,);
}

function getOutlinePartB(classname, depth, name){
    let children = document.getElementsByClassName(classname);
    console.log(classname);
    console.log(children);
    var result = "-".repeat(depth) + name + "\n";
    for(var i = 0; i < children.length; i++){
        const rootName = getRootName(children[i].className)
        result += getOutlinePartB(rootName, depth+1, children[i].tagName);
        result = result.toLowerCase();
    }
    return result;
}

function placeOutlinePartA(){
   let outline = getOutlinePartA(document.getElementsByTagName("html")[0], 0, false);
   document.querySelector("#info").innerHTML = outline;
}

function placeOutlinePart1B(){
    let outline = getOutlinePartB("html",0, "html");
    document.querySelector("#part1b").innerHTML = outline;
 }

function alertBox(obj) {
	alert(obj.tagName);	
}

function lab4Part3Quote() {
	var myNode = document.getElementsByClassName("root-div1")[0];
//	var quote = "When the light turns green, you go. When the light turns red, you stop. But what do you do when the light turns blue with orange and lavender spots? - Shel Silverstein"
//	var code = document.getElementsByTagName("DIV")[0];
	var cln = myNode.cloneNode(true);
	cln.innerHTML = '"When the light turns green, you go. When the light turns red, you stop. But what do you do when the light turns blue with orange and lavender spots?" - Shel Silverstein' 
	cln.setAttribute("id", "quote");
	document.body.appendChild(cln);
}

function lab4Part3Mouse() {
	var nodes = document.getElementsByTagName("DIV");
	for(var i = 0; i < nodes.length; i++) {
		nodes[i].addEventListener("mouseover",function(){
			this.style.background = "#f00";
			this.style["margin-left"] = "10px";
		});
		nodes[i].addEventListener("mouseout",function(){
			this.style.background = "#fff";
			this.style["margin-left"] = "0px";
		});
	}
}

function mouseOver(className) {
	className = className.replace(" ", ".");
	console.log(className);
	document.querySelector("." + className).style.backgroundColor = "red";	
}

function mouseOut(className) {
	className = className.replace(" ", ".");
	console.log(className);
	document.querySelector("." + className).style.backgroundColor = "white";	
}

placeOutlinePartA()

placeOutlinePart1B()

lab4Part3Quote()

lab4Part3Mouse()
