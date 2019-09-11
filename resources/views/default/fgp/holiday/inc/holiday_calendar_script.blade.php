<script>
  var todayDate = moment().startOf('day');
  var YM = todayDate.format('YYYY-MM');
  var yesterday = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
  var today = todayDate.format('YYYY-MM-DD');
  var tomorrrow = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
  function calendar(){
    $("#m_holiday_calendar").fullCalendar({ 
        height: 617,
        defaultView: "month",
        eventLimit: true,
        navLinks:true,
        events: function (start, end, timezome, callback) {
          $.ajax({
              url: '/holiday/getHolidayCalendarData',
              dataType: 'json',
              success: function (events) {
                  callback(events)
              }
          })
        },
        editable: false,
        droppable: true,
        dayClick: function(date, jsEvent,view){
          let selDate = date.format()
          showModal('addHoliday?date='+selDate);
        },
        eventAfterAllRender(event, element, view) {
          // make all events draggable but disable dragging
          $(".fc-event").each(function() {
            const $event = $(this);
            if ($event.data("fcSeg")) {
              // store data so the calendar knows to render an event upon drop
              const event = $event.data("fcSeg").footprint.eventDef;
              $event.data("event", event);

              // make the event draggable using jQuery UI
              $event.draggable({
                disabled: true,
                helper: "clone",
                revert: true,
                revertDuration: 0,
                zIndex: 999,
                stop(event, ui) {
                  // when dragging of a copied event stops we must set them
                  // copyable again if the control key is still held down
                  if (ctrlIsPressed) {
                    setEventsCopyable(true);
                  }
                }
              });
              var eventStart = event.dateProfile.start._i;
              $("td[data-date='"+eventStart+"']").css('background-color','pink');
            }
          });
        },
        eventClick: function(calEvent, jsEvent, view) {
           showModal('/holiday/edit/'+calEvent.id);
        },
    });
  }

  function removeClass(){
    $(".fc-body").each(function() {
      $(this).find('tr').removeClass("active_row");
    });
  }
  $(document).on('click', '#m_supervisor_calendar_div table table td', e => e.stopPropagation());
</script>