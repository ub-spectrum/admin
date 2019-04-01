var pending, index;

window.onload = function() {
  $.get("/ubspectrum/events/fetchEvents.php", function(data, status){
    var date = new Date();
    data.map(function(dataObj, index) {
      if (date.toISOString() < dataObj.start) {
        console.log(dataObj.approve);
        if (dataObj.approve === "accepted") {
          // adds the existing admins to the page
          addExistingEvents(dataObj);
        } else if (dataObj.approve === "pending") {
          // adds the pending admins to the page
          addPendingEvents(dataObj);
        }
      }
    });
  });

}

/**
  function to dynamically add pending admins to the web page
*/
function addPendingEvents(pendingEvent) {
    var startDate = new Date(pendingEvent.start),
        endDate = new Date(pendingEvent.end),
        formatStartDate = startDate.toLocaleDateString(),
        formatStartTime = startDate.toLocaleTimeString("en-us", {hour: "2-digit", minute: "2-digit"}),
        formatEndTime = endDate.toLocaleTimeString("en-us", {hour: "2-digit", minute: "2-digit"}),
        myCol = $('<div class="col-sm-3 col-md-3 pb-2" id=card' + pendingEvent.id + '></div>'),
        myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                  '<h5 class="card-title">' + pendingEvent.title + '</h5>' +
                  '<p class="card-text">Description: ' + pendingEvent.description + '<br>Date: ' + formatStartDate +
                  '<br> Time: ' + formatStartTime + ' - ' + formatEndTime + '</p><a href="#" id=info'+ pendingEvent.id +
                  ' onclick="window.location.href=\'moreinfo.php?type=pending&eventid=' + pendingEvent.id + '\'" class="btn btn-outline-primary btn-sm pull-left">More Info</a></div></div>');
    // adds card to card list
    myPanel.appendTo(myCol);
    myCol.appendTo('#pendingEvents');
}

/**
  function to dynamically add the already existing admins to the page
*/
function addExistingEvents(event) {
  var startDate = new Date(event.start),
      endDate = new Date(event.end),
      formatStartDate = startDate.toLocaleDateString(),
      formatStartTime = startDate.toLocaleTimeString("en-us", {hour: "2-digit", minute: "2-digit"}),
      formatEndTime = endDate.toLocaleTimeString("en-us", {hour: "2-digit", minute: "2-digit"}),
      myCol = $('<div class="col-sm-3 col-md-3 pb-2" id="card' + event.id + '"></div>'),
      myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                '<h5 class="card-title">' + event.title + '</h5>' +
                '<p class="card-text">Description: ' + event.description + '<br>Date: ' + formatStartDate +
                '<br> Time: ' + formatStartTime + ' - ' + formatEndTime + '</p><a href="#" id=info'+ event.id +
                ' onclick="window.location.href=\'moreinfo.php?type=accepted&eventid=' + event.id + '\'" class="btn btn-outline-primary btn-sm pull-left">More Info</a></div></div>');

  // adds the card to the page
  myPanel.appendTo(myCol);
  myCol.appendTo('#existingEvents');
}
