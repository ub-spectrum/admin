var jsonTest, jsonTest2;
window.onload = function() {
  // add call to api to get dataset info from the database
  // test data based on how i expected it to look
  jsonCurrentTest = [{datasetName: "datasetName", description: "description", postedBy: "posted by", split: "3", fileType: "pdf"},
                      {datasetName: "datasetName1", description: "description", postedBy: "posted by", split: "3", fileType: "pdf"}];

  jsonArchiveTest = [{datasetName: "datasetName", postedBy: "posted by", split: "3", fileType: "csv", archiveDate: "00/00/0000"},
                     {datasetName: "datasetName", postedBy: "posted by", split: "3", fileType: "xlsx", archiveDate: "00/00/0000"},
                     {datasetName: "datasetName", postedBy: "posted by", split: "3", fileType: "pdf", archiveDate: "00/00/0000"}];

  // adds the current dataset info to the page
//  addCurrent(jsonCurrentTest);
  addCurrentTable(jsonCurrentTest);

  // adds the archive dataset info to the page
  //addArchive(jsonArchiveTest);
  addArchiveTable(jsonArchiveTest);
}

function addCurrentTable(currentDatasets) {
  currentDatasets.map(function(curr, index) {
    var table = document.getElementById("currentDatasetsBody"),
        row = table.insertRow(index);

    row.insertCell(0).innerHTML = curr.datasetName;
    row.insertCell(1).innerHTML = curr.postedBy;
    row.insertCell(2).innerHTML = curr.description;
    row.insertCell(3).innerHTML = curr.fileType;
    row.insertCell(4).innerHTML = curr.split;
    row.insertCell(5).innerHTML = '<button type="button" class="btn btn-outline-primary btn-sm"">Progress</button>';
    row.insertCell(6).innerHTML = '<button type="button" class="btn btn-outline-primary btn-sm"">Download</button>';
    row.insertCell(7).innerHTML = '<button type="button" class="btn btn-outline-danger btn-sm"">Archive</button>';
  });
}

function addArchiveTable(archivedDatasets) {
  archivedDatasets.map(function(arch, index) {
    var table = document.getElementById("archiveDatasetsBody"),
        row = table.insertRow(index);

    row.insertCell(0).innerHTML = arch.datasetName;
    row.insertCell(1).innerHTML = arch.postedBy;
    row.insertCell(2).innerHTML = arch.archiveDate;
    row.insertCell(3).innerHTML = arch.description;
    row.insertCell(4).innerHTML = arch.fileType;
    row.insertCell(5).innerHTML = arch.split;
    row.insertCell(6).innerHTML = '<button type="button" class="btn btn-outline-primary btn-sm"">Results</button>';
    row.insertCell(7).innerHTML = '<button type="button" class="btn btn-outline-primary btn-sm"">Download</button>';
    row.insertCell(8).innerHTML = '<button type="button" class="btn btn-outline-danger btn-sm"">Delete</button>';
  });
}

/**
  function to dynamically add current event info to the web page
*/
function addCurrent(currentEvents) {
  // loops through all of current datasets
  currentEvents.map(function(currObj, index) {
    // dynamically creates a card object for each current dataset
    var myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>'),
        myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                  '<h5 class="card-title">' + currObj.datasetName + '</h5>' +
                  '<p class="card-text">Posted By: ' + currObj.postedBy + '<br>Split: ' + split(currObj.split, currObj.fileType) +
                  ' each<br>File Type: ' + currObj.fileType + '</p><a href="#" id="progressBtn'+ index +
                  '" onclick=showProgress(this) class="btn btn-outline-success btn-sm pull-left">Progress</a>' +
                  '<a href="#" id="archiveData'+ index + '" onclick=archiveData(this) class="btn btn-outline-primary btn-sm pull-left">Archive</a>' +
                  '<a href="#" id="downloadData'+ index + '" onclick=downloadData(this) class="btn btn-outline-secondary btn-sm pull-left">Download Data</a></div></div>');

    // adds card to card list
    myPanel.appendTo(myCol);
    myCol.appendTo('#currentDatasets');
  });
}

/**
  function to dynamically add the archive datasets to the page
*/
function addArchive(archivedEvents) {
  // loops through all archived dataset info and adds them as a single card
  archivedEvents.map(function(archObj, index) {
    var myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>'),
    myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
              '<h5 class="card-title">' + archObj.datasetName + '</h5>' +
              '<p class="card-text">Posted By: ' + archObj.postedBy + '<br>Split: ' + split(archObj.split, archObj.fileType) +
              ' each<br>File Type: ' + archObj.fileType + '<br>Archived Date: ' + archObj.archiveDate +'</p><a href="#" id="resultsBtn'+ index +
              '" onclick=showResults(this) class="btn btn-outline-success btn-sm pull-left">Results</a>&nbsp&nbsp&nbsp' +
              '<a href="#" id="deleteData'+ index + '" onclick=deleteArchiveData(this) class="btn btn-outline-danger btn-sm pull-left">Delete</a>' +
              '<br><br><a href="#" id="downloadData'+ index + '" onclick=downloadArchiveData(this) class="btn btn-outline-secondary btn-sm pull-left">Download Data</a></div></div>');

    // adds the card to the page
    myPanel.appendTo(myCol);
    myCol.appendTo('#archivedDatasets');
  });
}

/**
 function to figure out the type of data to append to the card
*/
function split(split, fileType) {
  if (fileType === "pdf") {
    split = split + " page(s)";
  } else if (fileType === "csv" || fileType === "xlsx") {
    split = split + " row(s)";
  }
  return split;
}

/**
  function handler to show the add a new dataset form
*/
$("#addNewDataset").click(function() {
  console.log("TODO");
});

/**
  function to handle the delete data button -- to finish in other stories
*/
function deleteData(e) {
  var index = e.id.substr(-1);

  // json of the card in the selected button -- to finish in another story
  console.log(jsonCurrentTest[index]);
}

/**
  function to handle the archive data button
*/
function archiveData(e) {
  var index = e.id.substr(-1);

  // json of the card from the selected button -- to finish in another story
  console.log(jsonCurrentTest[index]);
}

/**
  function to handle the download data button
*/
function downloadData(e) {
  var index = e.id.substr(-1);

  // json of the card in the selected button -- to finish in another story
  console.log(jsonCurrentTest[index]);
}

/**
  function to handle the show progress button
*/
function showProgress(e) {
  var index = e.id.substr(-1);

  // json of the card in the selected button -- to finish in another story
  console.log(jsonCurrentTest[index]);
}

/**
  function to handle the delte archived data button
*/
function deleteArchiveData(e) {
  var index = e.id.substr(-1);

  // json of the card in the selected button -- to finish in another story
  console.log(jsonArchiveTest[index]);
}

/**
  function to handle the download archived data button
*/
function downloadArchiveData(e) {
  var index = e.id.substr(-1);

  // json of the card in the selected button -- to finish in another story
  console.log(jsonArchiveTest[index]);
}

/**
  function to handle showing the results page
*/
function showResults(e) {
  var index = e.id.substr(-1);

  // json of the card in the selected button -- to finish in another story
  console.log(jsonArchiveTest[index]);
}
