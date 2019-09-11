<script>
  // var todayDate = moment().startOf('day');
  // var YM = todayDate.format('YYYY-MM');
  // var yesterday = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
  // var today = todayDate.format('YYYY-MM-DD');
  // var tomorrrow = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

  function sup_calender(){
    $("#m_supervisor_calendar").fullCalendar({ 
      height: 700,
      defaultView: "month",
      eventLimit: true,
      navLinks:true,   
      loading : function(loading){
        if(loading){
          $('body').append('<div class="m-loader page" rel="pageLoader"></div>');
        }else{

          $(document).find('.m-loader.page').remove();
          
        }
      },
      header : {
        left: 'title',
        right : 'prev,next today'
      },
      views : {
        month: {
          eventLimit: 3
        }
      },
      eventSources : [

        {
          id: 'calendar_dashboard',
          url: '/calendarSchedule/getCalendarData',
        }

      ],     
      
      editable: false,      
      droppable: false,
      dayClick: function(date, jsEvent,view){

      },
      eventRender: function(event, el){
        if(event.rendering == 'background'){

          el.css({"vertical-align" : "middle", "opacity" : '0.8'});

          el.append(`<h3 style="color:black !important; opacity : 1; font-size: 14px; text-align: center">${event.title}</h3>`);

        }
      },
      eventAfterAllRender(event, element, view) {
        let nextday;
        /*
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

            var eventStart = new Date(event.dateProfile.start._d);
            var eventEnd = new Date(event.dateProfile.end._d);

            
            nextday = nextday ? new Date(moment(nextday, 'YYYY-MM-DD').add(1, 'days').toString()) : eventStart;

            if(nextday.getTime() !== eventEnd.getTime()){


                $(".fc-bg td[data-date='"+ moment(nextday, 'YYYY-MM-DD').format('YYYY-MM-DD') +"']").css('background-color','pink');


            }
            
          }
        })
        */
      },
      eventMouseover: function(calEvent, domEvent) {

        // $(this).css("cursor", "pointer");

        // var p = $(this).offset();
        // var top = p.top-50;
        // var left = p.left-40;
        // var d = calEvent.description;
        // if(d==undefined){
        //   d = calEvent.miscProps.description;
        // }
        // var layer = "<div id='events-layer' class='fc-events-layer fc-transparent' style='will-change: transform;transform: translate3d("+left+"px, "+top+"px, 0px);'>"+d+"</div>";

        // $('body').append(layer);
      },
      eventClick: function(calEvent, jsEvent, view) {

        let request= {         
          method: 'get',
          loader: true

        };

        if(calEvent.type === "volunteer"){

          request.url = `vol-calendar/${calEvent.vol_id}/ts_id/${calEvent.id}`;

          $('.clear-all-templates').hide();

        }else if(calEvent.type === "sites"){

          request.url = `site-calendar/${calEvent.site_id}/period_id/${calEvent.period_id}/${calEvent.date}`;

          $('.clear-all-templates').hide();          

        }else{


          // request.url = 'time-sheets/add/new?id='+calEvent.id;     

        }
        //remove this return

        if(calEvent.type !== "volunteer" && calEvent.type !== 'sites') return;
        
        sendAjax(request, function(response){
          $('.m_calendar_time_Changable').slideUp('slow');
          $('#m_calendar_time_detail').show();
          $('.calendar-view-act-btns').show();
          $('.calendar-default-act-btns').hide(); //printbtn
          $('#m_calendar_time_detail').html(response);
        });      
      },
      eventMouseout: function(calEvent, domEvent) {
        
        $("body").find('div[id*=events-layer]').remove();
      },  
    });
  }

</script>