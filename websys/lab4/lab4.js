
function getOutlinePartA(element, numDashes){
    let children = element.children;
    var result = "-".repeat(numDashes) + element.tagName + "\n";
    for(var i = 0; i < children.length; i++){
        result += getOutlinePartA(children[i], numDashes+1);
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
   let outline = getOutlinePartA(document.getElementsByTagName("html")[0], 0);
   document.querySelector("#info").innerHTML = outline;
}

function placeOutlinePart1B(){
    let outline = getOutlinePartB("html",0, "html");
    document.querySelector("#part1b").innerHTML = outline;
 }

placeOutlinePartA()

placeOutlinePart1B()

