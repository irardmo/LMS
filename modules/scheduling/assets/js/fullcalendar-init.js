document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay' },
    events: {
      url: '/modules/scheduling/api/appointments.php',
      method: 'GET',
      failure: function() { alert('There was an error while fetching events!'); },
    },
    eventClick: function(info) {
      const ev = info.event; const ext = ev.extendedProps || {};
      let message = ev.title + '\n' + (ev.start ? ev.start.toLocaleString() : '') + ' — ' + (ev.end ? ev.end.toLocaleString() : '') + '\nStatus: ' + (ext.status || '');
      message += '\nLocation: ' + (ext.location || 'N/A') + '\nType: ' + (ext.type || 'N/A');
      alert(message);
    },
    eventColor: '#1976d2',
  });

  calendar.render();
});