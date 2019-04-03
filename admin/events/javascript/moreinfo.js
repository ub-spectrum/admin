function addEventInfo() {

  const urlParams = new URLSearchParams(window.location.search);
  const type = urlParams.get('type');
  const id = urlParams.get('eventid');

  $.ajax({
    type: "POST",
    url: "/ubspectrum/admin/events/server/fetchEventInfo.php",
    data: {id: id}
  }).then(function(data) {
    console.log(data);
    addDataToWindow(data);
  });

  document.getElementById("event_id").value = id;
  document.getElementById("event_type").value = type;

  if (type === "accepted") {
    $("#acceptBtn").hide();
    $("#declineBtn").hide();
  } else if(type === "pending") {
    $("#deleteBtn").hide();
  }

}

function addDataToWindow(event) {
  console.log(event);

  document.getElementById("addedBy").value = event.ADDED_BY;

  document.getElementById("name").value = event.NAME;

  document.getElementById("venue").value = event.VENUE;

  document.getElementById("link").value = event.LINK;

  document.getElementById("description").value = event.DESCRIPTION;

  $.ajax({
    type: "POST",
    url: "server/fetchEventC.php",
    data: {
            id: event.ID,
            type: "category"
          }
  }).then(function(data) {
    JSON.parse(data).map(function(cat) {
      onSelectTagFromDropdown(cat.CATEGORY_ID.toString());
    });
  });

  document.getElementById("ub_campus").value = event.UB_CAMPUS_LOCATION;

  document.getElementById("eventCost").value = event.COST;

  var startDate = new Date(event.START_TIME),
      endDate = new Date(event.END_TIME);

  $('#date').flatpickr({
    enableTime: false,
    altInput: true,
    minDate: new Date(),
    defaultDate: startDate
  });


  $('#start_time').flatpickr({
      enableTime: true,
      noCalendar: true,
      altFormat: "h:i K",
      altInput: true,
      minDate: new Date(),
      dateFormat: "H:i",
      defaultDate: startDate
  });

  $('#end_time').flatpickr({
      enableTime: true,
      noCalendar: true,
      altFormat: "h:i K",
      minDate: new Date(),
      altInput: true,
      dateFormat: "H:i",
      defaultDate: endDate
  });

  $.ajax({
    type: "POST",
    url: "server/fetchEventC.php",
    data: {
            id: event.ID,
            type: "contact"
          }
  }).then(function(data) {
    var jsonData = JSON.parse(data);
    jsonData.map(function(con, index) {
      console.log(con);
      var i = index + 1;

      document.getElementById("contact_" + i + "_name").value = con.PERSON_NAME;
      document.getElementById("contact_" + i + "_type").value = con.CONTACT_TYPE;
      if (con.ADDITIONAL_INFO.includes("@")) {
        $("#contact_" + i + "_info_opt_email").prop("checked", true);

      } else {
        $("#contact_" + i + "_info_opt_phone").prop("checked", true);
      }
      document.getElementById("contact_" + i + "_info").value = con.ADDITIONAL_INFO;

      if (index < jsonData.length - 1) {
        addContactFields();
      }
    });
  });
}

function onDeleteConfirm() {
    $("#deleteConfirm").modal('show');
}

function onDeclineConfirm() {
  $("#declineConfirm").modal('show');
}

function onAcceptConfirm() {
  $("#acceptConfirm").modal('show');
}

function acceptEvent() {
  document.getElementById("event_type").value = "accepted";
  document.forms["info"].submit();
}

function deleteEvent() {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('eventid');

  $.ajax({
    type: "POST",
    url: "server/deleteEvent.php",
    data: {eventId: id},
  });
  window.location = "eventsAdmin.php";

}
