$(document).ready(function() {
    $('#Result').click(() => {
        const result = document.querySelector("#result").innerHTML;
        const resultIndex = result.search("=");
        const resultValue = result.slice(resultIndex+2);
        document.querySelector("#name").value = parseFloat(resultValue);
    }) 
})

