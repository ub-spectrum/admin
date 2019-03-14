$(document).ready(function() {
  // test data -- will need to call db -- updated in a later story
  var i = 0, history = [];
  for (i; i < 30; i++) {
    history.push({app: "Events Calendar", user: "aepellec", data: "user alan", action: "delete", timestamp: "timestamp"});
    history.push({app: "Crowdsourced Data Review", user: "aepellec", data: "user alan", action: "delete", timestamp: "timestamp"});
    history.push({app: "User Management", user: "aepellec", data: "user alan", action: "delete", timestamp: "timestamp"});
  }

  // appends the history rows to the table
  history.map(function(historyObj) {
    var app = historyObj.app,
        tr = '';

    if (app === "Events Calendar") {
      tr = '<tr class=table-info>';
    } else if (app === "Crowdsourced Data Review") {
      tr = '<tr class=table-active>';
    } else {
      tr = '<tr class=table-success>';
    }

    $(tr).append(
      $('<td>').text(historyObj.app),
      $('<td>').text(historyObj.user),
      $('<td>').text(historyObj.data),
      $('<td>').text(historyObj.action),
      $('<td>').text(historyObj.timestamp))
      .appendTo($('#historyTableBody'));
  });
});


$(function () {
   $('#filterDateTime').datetimepicker();
 });
