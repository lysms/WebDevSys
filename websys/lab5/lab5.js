(function ( $ ) {
    $.fn.hexed = function(settings) {
        console.log("this is the hex function");
    };
}( jQuery ));

var state = {
    gameInSession: true,
    correct: {
        red: 122,
        green: 122,
        blue: 133
    },
    guess: {},
    turnNumber: 1,
    totalTurns: 10
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function guesschecker(guess){
    let percentoff = {};
    let correctVals = 0;

    for(var color in guess){
        percentoff[color] =Math.round((Math.abs(state.correct[color] - guess[color])/255) * 100) 
    }
    
    for(var color in percentoff){
        if (percentoff[color] == 0){
            document.querySelector("#" + color + "-result").innerHTML = "You got it! (" + percentoff[color] + "% off)";    
            correctVals += 1
        }else{
            document.querySelector("#" + color + "-result").innerHTML = percentoff[color] + "% off";
        }
    }
    if(correctVals == 3){
        alert("you got it right!")
        resetGame();
    }
    state.turnNumber += 1;
}

function getRandomColor(){
    return {
        red: getRandomInt(0, 255),
        blue: getRandomInt(0, 255),
        green: getRandomInt(0, 255)
    }
}

function resetGame(){
    state = {
        gameInSession: false,
        correct: {},
        guess: {},
        turnNumber: 1,
        totalTurns: 10
    }
    $("#guess").hide();
    $("#Results").hide();
    $("#newGame").show();
    document.querySelector("#num-turn").innerHTML = state.turnNumber;
}

function newGame(){
    state.gameInSession = true
    state.correct = getRandomColor()
    $("#newGame").hide()
    $("#guess").show()
    $("#Results").show()
}

function updateGame(){
    document.querySelector("#num-turn").innerHTML = state.turnNumber;
}

$( document ).ready(function() { 

    let setting = {
        player_name:"john",
        turn: 3
    };
    document.querySelector("#num-turn").innerHTML = state.turnNumber;
    document.querySelector("#total-turns").innerHTML = state.totalTurns;
    resetGame();

    $("#game").hexed(setting);
    $("#guess").click(function(){
        let test = {
            red: getRandomInt(0, 255),
            blue: getRandomInt(0, 255),
            green: getRandomInt(0, 255)
        }
        guesschecker(state.guess); 
        updateGame();
        if(state.turnNumber == state.totalTurns + 1){
            resetGame();
        }
    })
    $("#newGame").click(function(){
        newGame()
    })
});

$(function() {

    function hexFromRGB(r, g, b){
        var hex = [r.toString(16), g.toString(16), b.toString(16)];
        state.guess = {
            red: r,
            blue: b,
            green: g
        }
        console.log(state.guess);        
        $.each(hex, function(color, value){
            if(value.length === 1){
                hex[color] = "0"+ value;
            }
        });
        return hex.join("").toUpperCase();
    }

    function refreshSwatch() {
        var red = $( "#red" ).slider( "value" ),
          green = $( "#green" ).slider( "value" ),
          blue = $( "#blue" ).slider( "value" ),
          hex = hexFromRGB( red, green, blue );
        $( "#swatch" ).css( "background-color", "#" + hex );
      }
    
      $( "#red, #green, #blue" ).slider({
        orientation: "horizontal",
        range: "min",
        max: 255,
        value: 127,
        slide: refreshSwatch,
        change: refreshSwatch
      });
      $( "#red" ).slider( "value", 255 );
      $( "#green" ).slider( "value", 140 );
      $( "#blue" ).slider( "value", 60 );
});


