function createTable(data, id){
    console.log(data);
    const tableHeaders = Object.keys(data[0]);
    var row = `<thead>\n<tr>\n\t<th scope="col">#</th>\n\t`;
    tableHeaders.forEach(function(header){
        row += '<th scope="col">'+ header + '</th>\n\t';
    })
    row += "</tr>\n</thead>\n";

    var dataRows = `<tbody>\n`;
    var i = 1;
    data.forEach(function(entry){
        dataRows += `<tr>\n\t<th scope="row">`+i+`</th>\n\t`;
        i += 1;
        for(var attribute in entry){
            dataRows += '<td>' + entry[attribute] + '</td>\n\t';
        }
        dataRows += '</tr>\n';
    })
    dataRows += '</tbody>\n';

    const table = '<table class="table table-striped">\n' + row + dataRows + '</table>';
    document.getElementById(id).innerHTML = table;
}

function makeGetRequest(requestId, tableId){
  const url = window.location.href.toString().replace("gradebook.php", "getRequests.php")
  const response = $.ajax({
      type: 'GET',
      url: url,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      data: {
          requestId: requestId
      },
      success: function(res){
        console.log(res);
        createTable(res, tableId);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { // if there was a problem
        console.log(XMLHttpRequest, textStatus, errorThrown);
        alert('Error Occured');
      }
    });
  return response;
}

$(document).ready(function() {
    $(".lexicographicalOrder").click(function(){
      makeGetRequest(7, "results");
    })

    $(".getListStudentsOver90").click(function(){
      makeGetRequest(8, "results");  
    })
    
    $(".getAvgStudents").click(function(){
      makeGetRequest(9, "results");
    })

    $(".getListStudents").click(function(){
      makeGetRequest(10, "results");
    })
})