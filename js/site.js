﻿$(document).ready(function () {
  $('#view-details-button').on('click', viewInfo);	
});

$(document).keypress(function(e) {
  if(e.which == 13) {
  e.preventDefault();
    $("#view-details-button").click();
  }
});

var first = true;

function viewInfo() {
  var cpuName = $('#cpu-name').val();
  var append = $('#append-checkbox').is(':checked');
  showBusyCursor(true);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(this.readyState === 4) {
      if(this.status === 200) {
        var data = this.responseText;
        
        try {
          var jsonResponse = JSON.parse(data);
          if(Object.keys(jsonResponse).length > 0) {
            if (append) {
              var existingData = [];
              gridOptions.api.forEachNode(function(node) {
                existingData.push(node.data);
              });
              jsonResponse = existingData.concat(jsonResponse);
            }
            showCpuGridData(jsonResponse);
          }
          else {
            if (!append) {
              showCpuGridData([]);
            }
          }
        }catch(e){
          if (!append) {
            showCpuGridData([]);
          }
        }
      } else {
        if (!append) {
          showCpuGridData([]);
        }
      }
      showBusyCursor(false);
    }
  };
  xhttp.open('GET', 'info.php/' + cpuName, true);
  xhttp.send();
}

function showBusyCursor(busy) {
  cursorType = "default";
  if (busy === true) {
    cursorType = "progress";
  }
  $("body").css("cursor", cursorType);
  $("#view-details-button").css("cursor", cursorType);
  $("#cpu-name").css("cursor", cursorType);
}

function showCpuGridData(results) {
  if(first === true) {
    first = false;
    document.getElementById("cpu-info-results-grid").style.display = "block";
    // specify the columns
    columnDefs = [
      {headerName: "Name", field: "Name", width: 255, suppressSizeToFit: false},
      {headerName: "CPU Mark", field: "CpuMark", width: 100, suppressSizeToFit: false},
      {headerName: "Cores", field: "Cores", width: 90, suppressSizeToFit: false},
      {headerName: "Threads", field: "Threads", width: 90, suppressSizeToFit: false},
      {headerName: "Type", field: "Type", width: 140, suppressSizeToFit: false},
      {headerName: "Single Thread Mark", field: "SingleThreadMark", width: 160, suppressSizeToFit: false},
      {headerName: "TDP", field: "TDP", width: 70, suppressSizeToFit: false},
      {headerName: "Power Perf", field: "PowerPerf", width: 130, suppressSizeToFit: false},
      {headerName: "Released", field: "ReleaseDate", width: 100, suppressSizeToFit: false}
    ];
  
    // let the grid know which columns and what data to use
    gridOptions = {
      columnDefs: columnDefs,
      enableSorting: true,
      suppressHorizontalScroll: false,
      enableFilter: true,
      onGridReady: function(event) { 
        gridOptions.api.sizeColumnsToFit(); 
      }
    };

    // lookup the container we want the Grid to use
    eGridDiv = document.querySelector('#resultsGrid');

    // create the grid passing in the div to use together with the columns & data we want to use
    new agGrid.Grid(eGridDiv, gridOptions);
  }
  gridOptions.api.setRowData(results);
  gridOptions.api.sizeColumnsToFit;
}
