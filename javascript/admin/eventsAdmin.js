var pending, index;

window.onload = function() {
  $.get("http://stark.cse.buffalo.edu/ubspectrum/events/fetchEvents.php", function(data, status){
    var date = new Date();
    data.map(function(dataObj, index) {
      if (date.toISOString() < dataObj.start) {
          // adds the existing admins to the page
          addExistingEvents(dataObj);

          // adds the existing admins to the page
          addPendingEvents(dataObj);
      }

    });
  });

  $('#disabledContainer').find('input, textarea, button, select').prop('disabled',true);

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
                  '<br> Time: ' + formatStartTime + ' - ' + formatEndTime + '</p><a href="#" id="existingInfoBtn'+ index +
                  '" onclick=existingInfoEvent(this) name='+ pendingEvent.id + 'class="btn btn-outline-primary btn-sm pull-left">More Info</a></div></div>');
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
$(function () {
    $('#eventEndTime').datetimepicker({
        format: 'LT'
    });
});

/*
  function to show the start time picker
*/
$(function () {
    $('#eventStartTime').flatpickr({
      enableTime: true,
      dateFormat: "Y-m-d H:i",
    });
});

/*
  function to show the end time picker
*/
$(function () {
    $('#eventDate').datetimepicker({
        format: 'L'
    });
});

/*
  fucntion to handle the edit button in the more info window
*/
$("#editEvent").click(function() {
  // enables the form to make edits
  $('#disabledContainer').find('input, textarea, button, select').prop('disabled', false);

  // shows the save button
  $("#saveBtnExisting").show();
});

$("#saveBtnExisting").click(function() {
  $('#disabledContainer').find('input, textarea, button, select').prop('disabled', true);
});

$("#editBtn").click(function() {
  // enables the form to make edits
  $('#disabledContainer').find('input, textarea, button, select').prop('disabled', false);

  // shows the save button
  $("#saveBtnPending").show();
});

$("#saveBtnPending").click(function() {
  $('#disabledContainer').find('input, textarea, button, select').prop('disabled', true);
});

$("#closeBtn").click(function() {
  $('body, html, #disabledContainer').scrollTop(0);
  $('#disabledContainer').find('input, textarea, button, select').prop('disabled', true);
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
  $("#editBtn").show();
  $("#acceptEvent").show();
  $("#declineEvent").show();

  // hides the existing buttons
  $("#deleteEvent").hide();
  $("#editEvent").hide();
  $("#saveBtnExisting").hide();
  $("#saveBtnPending").hide();

  // disables the form so you cant edit unless you click edit
  $("#form8").prop("disabled", true);

  // adds the current data to the form
  //addDataToWindow(jsonTestPending[index]);
}

/**
  fucntion to add teh existing events into to the window
*/
function existingInfoEvent(e) {
  //console.log(e.id);
  //index = e.id.substr(-1);
  //pending = false;

  // hides the buttons for the pending admins
  $("#saveBtnExisting").hide();
  $("#saveBtnPending").hide();
  $("#editBtn").hide();
  $("#acceptEvent").hide();
  $("#declineEvent").hide();

  // shows the buttons for the existing admins
  $("#deleteEvent").show();
  $("#editEvent").show();

    $.ajax({
      type: "POST",
      url: "../../server/fetchEventInfo.php",
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

  // autopopulates the date picker
  $('#eventDate').datetimepicker('date', moment(eventInfo.START_TIME, 'L'));

  // autopopulates the start time picker
  $('#eventStartTime').datetimepicker('date', moment(eventInfo.START_TIME, 'LT'));

  // autopopulates the end time picker
  $('#eventEndTime').datetimepicker('date', moment(eventInfo.END_TIME, 'LT'));

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

  // auto sets the selected categories -- names to be changed when set
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
