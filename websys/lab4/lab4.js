function getOutlinePartA(element, numDashes, inBody) {
    if (inBody) {
        element.setAttribute("onclick", "alertBox(this)");
    }
    if (element.tagName == "BODY") {
        inBody = true;
    }
    let children = element.children;
    var result = "-".repeat(numDashes) + element.tagName + "\n";
    for (var i = 0; i < children.length; i++) {
        result += getOutlinePartA(children[i], numDashes + 1, inBody);
        result = result.toLowerCase();
    }
    return result;
}

function getRootName(classname) {
    var index = classname.search("root") + 5;
    if (index == -1) {
        return ""
    }
    return classname.substring(index, );
}

function getOutlinePartB(classname, depth, name) {
    let children = document.getElementsByClassName(classname);
    var result = "-".repeat(depth) + name + "\n";
    for (var i = 0; i < children.length; i++) {
        const rootName = getRootName(children[i].className)
        result += getOutlinePartB(rootName, depth + 1, children[i].tagName);
        result = result.toLowerCase();
    }
    return result;
}

function placeOutlinePartA() {
    let outline = getOutlinePartA(document.getElementsByTagName("html")[0], 0, false);
    document.querySelector("#info").innerHTML = outline;
}

function placeOutlinePart1B() {
    let outline = getOutlinePartB("html", 0, "html");
    document.querySelector("#part1b").innerHTML = outline;
}

function alertBox(obj) {
    alert(obj.tagName);
}

function lab4Part3Quote() {
    var myNode = document.getElementsByClassName("root-div1")[0];
    var cln = myNode.cloneNode(true);
    cln.innerHTML = '"When the light turns green, you go. When the light turns red, you stop. But what do you do when the light turns blue with orange and lavender spots?" - Shel Silverstein'
    cln.setAttribute("id", "quote");
    document.body.appendChild(cln);
}

function lab4Part3Mouse() {
    var nodes = document.getElementsByTagName("DIV");
    for (var i = 0; i < nodes.length; i++) {
        nodes[i].addEventListener("mouseover", function() {
            let randColor = Math.floor((Math.random() * 360));
            this.style.background = "hsl("+randColor+", 100%, 50%)";
            this.style["margin-left"] = "10px";
        });
        nodes[i].addEventListener("mouseout", function() {
            this.style.background = "#fff";
            this.style["margin-left"] = "0px";
        });
    }
}

// Yuhao's speech button
function textToSpeech() {
    // get all voices that browser offers
    var available_voices = window.speechSynthesis.getVoices();

    // this will hold an english voice
    var english_voice = '';

    // find voice by language locale "en-US"
    // if not then select the first voice
    for (var i = 0; i < available_voices.length; i++) {
        if (available_voices[i].lang === 'en-US') {
            english_voice = available_voices[i];
            break;
        }
    }
    if (english_voice === '')
        english_voice = available_voices[0];

    // new SpeechSynthesisUtterance object
    var utter = new SpeechSynthesisUtterance();
    utter.rate = 1;
    utter.pitch = 0.5;
    utter.text = "Congratulations, you have found the speech button. This is a lab four given by dear Doctor Callahan. This lab is completed\
    by Yuhao Wang, Kristofer Kwan, Sam Avis, Yanshen Lin, Phillip Chang. This lab is basically for testing our Javascript ability. Hope all audience can\
    enjoy it.";
    utter.voice = english_voice;

    // event after text has been spoken
    utter.onend = function() {
        alert('Speech has finished');
        return;
    }

    // speak
    window.speechSynthesis.speak(utter);

}

placeOutlinePartA()

placeOutlinePart1B()

lab4Part3Quote()

lab4Part3Mouse()