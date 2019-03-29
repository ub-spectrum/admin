var pending, index;

window.onload = function() {
  $.get("/ubspectrum/events/fetchEvents.php", function(data, status){
    var date = new Date();
    data.map(function(dataObj, index) {
      if (date.toISOString() < dataObj.start) {
        if (dataObj.approve === "approved") {
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
        myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>'),
        myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                  '<h5 class="card-title">' + pendingEvent.title + '</h5>' +
                  '<p class="card-text">Description: ' + pendingEvent.description + '<br>Date: ' + formatStartDate +
                  '<br> Time: ' + formatStartTime + ' - ' + formatEndTime + '</p><a href="#" id='+ pendingEvent.id +
                  ' onclick=pendingInfoEvent(this) class="btn btn-outline-primary btn-sm pull-left">More Info</a></div></div>');
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
      myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>'),
      myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                '<h5 class="card-title">' + event.title + '</h5>' +
                '<p class="card-text">Description: ' + event.description + '<br>Date: ' + formatStartDate +
                '<br> Time: ' + formatStartTime + ' - ' + formatEndTime + '</p><a href="#" id='+ event.id +
                ' onclick=existingInfoEvent(this) class="btn btn-outline-primary btn-sm pull-left">More Info</a></div></div>');

  // adds the card to the page
  myPanel.appendTo(myCol);
  myCol.appendTo('#existingEvents');
}

/**
  function to show the date picker
*/

/*
  function to show the start time picker
*/
  $('#eventStartTime').flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: new Date(),
    allowInput:false

  });

  $('#eventEndTime').flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: new Date(),
    allowInput:false
  });

$("#saveBtn").click(function() {

});

$("#closeBtn").click(function() {
  //$('body, html, #disabledContainer').scrollTop(0);
});

$("#eventFree").change(function() {
  var eventCostBox = document.getElementById("eventCost");
  if (this.checked) {
    eventCostBox.disabled = true;
    eventCostBox.value = 0;
  } else {
    eventCost.disabled = false;
  }
});

/**
  function to show event info window
*/
function pendingInfoEvent(e) {
  console.log(e);
  index = e.id.substr(-1);
  pending = true;

  // shows the pending buttons
  $("#acceptEvent").show();
  $("#declineEvent").show();

  // hides the existing buttons
  $("#deleteEvent").hide();


      $.ajax({
        type: "POST",
        url: "/ubspectrum/admin/events/server/fetchEventInfo.php",
        data: {id: e.id}
      }).then(function(data) {
        addDataToWindow(data);
      });
}

/**
  fucntion to add teh existing events into to the window
*/
function existingInfoEvent(e) {
  // hides the buttons for the pending admins
  $("#acceptEvent").hide();
  $("#declineEvent").hide();

  // shows the buttons for the existing admins
  $("#deleteEvent").show();

    $.ajax({
      type: "POST",
      url: "/ubspectrum/admin/events/server/fetchEventInfo.php",
      data: {id: e.id}
    }).then(function(data) {
      addDataToWindow(data);
    });

  // adds the card data to the window for more info
}

/**
  adds the event info to the more info window
*/
function addDataToWindow(eventInfo) {
  // shows the window
  $('#exampleModal').modal('show');

  // autopopulates the event name
  document.getElementById("eventName").value = eventInfo.NAME;

  // autopopulates the event description
  document.getElementById("eventDescription").value = eventInfo.DESCRIPTION;

  // autopopulates the start time picker
  document.getElementById("eventStartTime").value = eventInfo.START_TIME;

  // autopopulates the end time picker
  document.getElementById("eventEndTime").value = eventInfo.START_TIME;

  // autopopulates the event location
  document.getElementById("eventLocation").value = eventInfo.VENUE;

  // autopopulates the event cost
  var cost = eventInfo.COST,
      eventCostBox = document.getElementById("eventCost");
  if (cost === "Free") {
      $("#eventFree").prop("checked", true);
      eventCostBox.disabled = true;
  } else {
    eventCostBox.value = parseFloat(cost);
  }

/*  // auto sets the selected categories -- names to be changed when set
  if (eventInfo.categories.includes("Category 1")) {
    $("#category1").prop("checked", true);
  }

  if (eventInfo.categories.includes("Category 2")) {
    $("#category2").prop("checked", true);
  }

  if (eventInfo.categories.includes("Category 3")) {
    $("#category3").prop("checked", true);
  }

  if (eventInfo.categories.includes("Category 4")) {
    $("#category4").prop("checked", true);
  }

  if (eventInfo.categories.includes("Category 5")) {
    $("#category5").prop("checked", true);
  }

  if (eventInfo.categories.includes("Category 6")) {
    $("#category6").prop("checked", true);
  }
*/
  // autopopulates the contact label
  document.getElementById("contactEmail").value = eventInfo.EMAIL;

  // autopopulates the contact phone number
  document.getElementById("contactPhone").value = eventInfo.PHONE;

  // autopopulates the event link
  console.log(eventInfo.LINK);
  document.getElementById("eventLink").value = eventInfo.LINK;

  // autopopulates the event flyer link
  //document.getElementById("eventFlyerLink").value = eventInfo.linkToFlyer;

  // autopopulates the events additional info
  document.getElementById("eventAdditionalInfo").value = eventInfo.ADDITIONAL_FILE;
}
