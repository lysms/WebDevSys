(function ( $ ) {
    $.fn.hexed = function(settings) {
        console.log("this is the hex function");
    };
}( jQuery ));

$( document ).ready(function() { 
     
    let setting = {
        player_name:"john",
        turn: 3
    };

    $("#game").hexed(setting);

});

