var jsonTestExisting, jsonTestPending, pending, index;

window.onload = function() {
  var date = new Date(),
      todaysDate = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear();
      todaysTime = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
console.log(todaysTime.hour12);
  $('#disabledContainer').find('input, textarea, button, select').prop('disabled',true);
  // add call to api to get admins from the database
  // test data based on how i expected it to look
  jsonTestExisting = [{eventName: "Event Name", description: "Event Description", date: "3/15/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["brainy", "free"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "Free", additionalInfo: "additional info"},
                  {eventName: "Event Name", description: "Event Description", date: "3/14/2019", startTime: "7:53 AM", endTime: "6:53 PM", categories: ["brainy", "free"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"},
                  {eventName: "Event Name", description: "Event Description", date: "4/10/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["brainy", "free"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"}];

  jsonTestPending = [{eventName: "Event Name", description: "Event Description", date: "3/10/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["Category 1", "Category 4"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"},
                  {eventName: "Other Name", description: "Event Description", date: "3/10/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["Category 1", "Category 4"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"},
                  {eventName: "Event Name", description: "Event Description", date: "3/10/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["Category 1", "Category 4"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"},
                  {eventName: "Event Name", description: "Event Description", date: "3/10/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["Category 1", "Category 4"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"},
                {eventName: "Event Name", description: "Event Description", date: "3/10/2019", startTime: "6:53 PM", endTime: "6:53 PM", categories: ["Category 1", "Category 4"], contact: {phone: "000-000-0000", email: "@email"}, linkToEvent: "http://link.com", linkToFlyer: "linkToFlyer", location: "location", cost: "1.00", additionalInfo: "additional info"}];

  var futureDates = jsonTestExisting.filter(date => {
    console.log(date);
    if (date) {
      if (date.date === todaysDate) {
        return date.startTime > todaysTime;
      } else {
        return date && (date.date > todaysDate);
      }
    }
    // Filter out dates in the past or falsey values

  });

  console.log(futureDates);


  // adds the existing admins to the page
  addExistingEvents(jsonTestExisting);

  // adds the existing admins to the page
  addPendingEvents(jsonTestPending);
}

/**
  function to dynamically add pending admins to the web page
*/
function addPendingEvents(pendingEvents) {
  // loops through all of the pending admins
  pendingEvents.map(function(eventObj, index) {
    // dynamically creates a card object for each admin
    var myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>'),
        myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                  '<h5 class="card-title">' + eventObj.eventName + '</h5>' +
                  '<p class="card-text">Description: ' + eventObj.description + '<br>Date: ' + eventObj.date +
                  '<br> Time: ' + eventObj.startTime + ' - ' + eventObj.endTime + '</p><a href="#" id="existingInfoBtn'+ index +
                  '" onclick=existingInfoEvent(this) class="btn btn-outline-primary btn-sm pull-left">More Info</a></div></div>');
    // adds card to card list
    myPanel.appendTo(myCol);
    myCol.appendTo('#pendingEvents');
  });
}

/**
  function to dynamically add the already existing admins to the page
*/
function addExistingEvents(events) {
  // loops through all admins and adds them as a single card
  events.map(function(eventObj, index) {
    var myCol = $('<div class="col-sm-3 col-md-3 pb-2"></div>'),
        eventString = JSON.stringify(eventObj),
        myPanel = $('<div class="card bg-dark text-white" style="width: 18rem;"><div class="card-body">' +
                  '<h5 class="card-title">' + eventObj.eventName + '</h5>' +
                  '<p class="card-text">Description: ' + eventObj.description + '<br>Date: ' + eventObj.date +
                  '<br> Time: ' + eventObj.startTime + ' - ' + eventObj.endTime + '</p><a href="#" id="existingInfoBtn'+ index +
                  '" onclick=existingInfoEvent(this) class="btn btn-outline-primary btn-sm pull-left" name=' +
                  eventString +'>More Info</a></div></div>');

    // adds the card to the page
    myPanel.appendTo(myCol);
    myCol.appendTo('#existingEvents');
  });
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
    $('#eventStartTime').datetimepicker({
        format: 'LT'
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
  addDataToWindow(jsonTestPending[index]);
}

/**
  fucntion to add teh existing events into to the window
*/
function existingInfoEvent(e) {
  index = e.id.substr(-1);
  pending = false;

  // hides the buttons for the pending admins
  $("#saveBtnExisting").hide();
  $("#saveBtnPending").hide();
  $("#editBtn").hide();
  $("#acceptEvent").hide();
  $("#declineEvent").hide();

  // shows the buttons for the existing admins
  $("#deleteEvent").show();
  $("#editEvent").show();

  // adds the card data to the window for more info
  addDataToWindow(jsonTestExisting[index]);
}

/**
  adds the event info to the more info window
*/
function addDataToWindow(eventInfo) {
  // shows the window
  $('#exampleModal').modal('show');

  // autopopulates the event name
  document.getElementById("eventName").value = eventInfo.eventName;

  // autopopulates the event description
  document.getElementById("eventDescription").value = eventInfo.description;

  // autopopulates the date picker
  $('#eventDate').datetimepicker('date', moment(eventInfo.date, 'L'));

  // autopopulates the start time picker
  $('#eventStartTime').datetimepicker('date', moment(eventInfo.startTime, 'LT'));

  // autopopulates the end time picker
  $('#eventEndTime').datetimepicker('date', moment(eventInfo.endTime, 'LT'));

  // autopopulates the event location
  document.getElementById("eventLocation").value = eventInfo.location;

  // autopopulates the event cost
  var cost = eventInfo.cost,
      eventCostBox = document.getElementById("eventCost");
  if (cost === "Free") {
      $("#eventFree").prop("checked", true);
      eventCostBox.disabled = true;
  } else {
    eventCostBox.value = parseFloat(eventInfo.cost);
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
  document.getElementById("contactEmail").value = eventInfo.contact.email;

  // autopopulates the contact phone number
  document.getElementById("contactPhone").value = eventInfo.contact.phone;

  // autopopulates the event link
  document.getElementById("eventLink").value = eventInfo.linkToEvent;

  // autopopulates the event flyer link
  document.getElementById("eventFlyerLink").value = eventInfo.linkToFlyer;

  // autopopulates the events additional info
  document.getElementById("eventAdditionalInfo").value = eventInfo.additionalInfo;
}
