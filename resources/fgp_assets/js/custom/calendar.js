
function fullCalendarInit(){
    var CalendarExternalEvents1 = function() {
    
        var initCalendar = function() {
            let ctrlIsPressed = false;

            function setEventsCopyable(isCopyable) {
              ctrlIsPressed = !ctrlIsPressed;
              $("#calendar").fullCalendar("option", "eventStartEditable", !isCopyable);
              $(".fc-event").draggable("option", "disabled", !isCopyable);
            }

            // set events copyable if the user is holding the control key
            $(document).keydown(function(e) {
              if (e.ctrlKey && !ctrlIsPressed) {
                setEventsCopyable(true);
              }
            });

            // if control has been released stop events being copyable
            $(document).keyup(function(e) {
              if (ctrlIsPressed) {
                setEventsCopyable(false);
              }
            });

            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var yesterday = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var today = todayDate.format('YYYY-MM-DD');
            var tomorrrow = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
            $("#m_calendar_time").fullCalendar({ 
              height: 617,
              defaultView: "month",
              eventLimit: true,
              navLinks:true,
              events: [
                {
                  title: "All Day Event",
                  start: YM+'-01',
                  description: 'Lorem ipsum dolor sit incid idnut ut',
                  className: 'fc-event--success'
                },
                {
                  title: "Event 2",
                  start: YM+'-02',
                  end: YM+'-03',
                  description: 'Lorem ipsum dolor sit incid idnut ut',
                  className: 'fc-event--primary'
                },
                {
                  title: 'Travel Expenses',
                  start: YM+'-12',
                  description:'Lorem ipsum dolor sit incid idnut ut',
                  end: YM+'-10',
                  className: 'fc-event--info'
                }
              ],
              editable: false,
              droppable: true,
              dayClick: function(date, jsEvent,view){
                openDayEvent();
              },
              eventAfterAllRender(event, element, view) {
                // make all events draggable but disable dragging
                $(".fc-event").each(function() {
                  const $event = $(this);
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
                });
              },
              eventMouseover: function(calEvent, domEvent) {
                var p = $(this).offset();
                var top = p.top-50;
                var left = p.left-40;
                var d = calEvent.description;
                if(d==undefined){
                  d = calEvent.miscProps.description;
                }
                var layer = "<div id='events-layer' class='fc-events-layer fc-transparent' style='will-change: transform;transform: translate3d("+left+"px, "+top+"px, 0px);'>"+d+"</div>";
                $('body').append(layer);
              },
              eventClick: function(calEvent, jsEvent, view) {
                var request= {
                  url: 'getCalendarDayDetail',
                  method: 'get'
                }
                ajaxRequest(request, function(response){
                  $('.m_calendar_time_Changable').slideUp('slow');
                  $('#m_calendar_time_detail').show();
                  $('#m_calendar_day_detail').html(response.data);
                });      
              },
              eventMouseout: function(calEvent, domEvent) {
                $("body").find('div[id*=events-layer]').remove();
              },  
          });
        }
    
        return {
            //main function to initiate the module
            init: function() {
                initCalendar(); 
            }
        };
    }();
    
    jQuery(document).ready(function() {
        CalendarExternalEvents1.init();
    });

    function openDayEvent(){
      var request= {
        url: 'getCalendarDayDetail',
        method: 'get'
      }
      ajaxRequest(request, function(response){
        $('.m_calendar_time_Changable').slideUp('slow');
        $('#m_calendar_time_detail').show();
        $('#m_calendar_day_detail').html(response.data);
      });      
    }
}
