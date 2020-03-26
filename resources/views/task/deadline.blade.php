@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'La tache'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div id='wrap'>

                        <div id='calendar'></div>

                        <div style='clear:both'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('style')
    <link href='/assets/css/fullcalendar.css' rel='stylesheet' />
    <link href='/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<style>

            body {
                margin-top: 40px;
                text-align: center;
                font-size: 14px;
                font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
                background-color: #DDDDDD;
                }

            #wrap {
                width: 1100px;
                margin: 0 auto;
                }

            #external-events {
                float: left;
                width: 150px;
                padding: 0 10px;
                text-align: left;
                }

            #external-events h4 {
                font-size: 16px;
                margin-top: 0;
                padding-top: 1em;
                }

            .external-event { /* try to mimick the look of a real event */
                margin: 10px 0;
                padding: 2px 4px;
                background: #3366CC;
                color: #fff;
                font-size: .85em;
                cursor: pointer;
                }

            #external-events p {
                margin: 1.5em 0;
                font-size: 11px;
                color: #666;
                }

            #external-events p input {
                margin: 0;
                vertical-align: middle;
                }

            #calendar {
        /* 		float: right; */
                margin: 0 auto;
                width: 900px;
                background-color: #FFFFFF;
                  border-radius: 6px;
                box-shadow: 0 1px 2px #C3C3C3;
                }

        </style>
    @endpush
    @push('scripts')
    <script src='/assets/js/jquery-1.10.2.js' type="text/javascript"></script>
    <script src='/assets/js/jquery-ui.custom.min.js' type="text/javascript"></script>
    <script src='/assets/js/fullcalendar.js' type="text/javascript"></script>
<script>
    $(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		/*  className colors

		className: default(transparent), important(red), chill(pink), success(green), info(blue)

		*/


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		var calendar =  $('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,

			droppable: false, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},
            events : [
                @foreach($tasks as $i)
                {
                    title : '{{ $i->title }}',
                    start: '{{ $i->deadline }}',
                    //formatLocalized
                     // now carbon: {{\Carbon\Carbon::now()->formatLocalized('%A %d %B %Y')}}
                     // now php: {{$i->deadline->formatLocalized('%A %d %B %Y')}}
                     //toDateString
                    // now carbon: {{\Carbon\Carbon::now()->toDateString()}}
                     // now php: {{$i->deadline->toDateString()}}
                    url: '/admin/tache/{{ $i->id }}/details',
                    @if($i->status == 100 || $i->completed == 1)
					className: 'success'
                    @elseif($i->deadline->toDateString() == \Carbon\Carbon::now()->toDateString())
                    className: 'info'
                    @elseif($i->deadline < \Carbon\Carbon::now())
                    className: 'important'
                    @else
                    className: 'chill'
                    @endif
                },
                @endforeach
            ],
        });
    });
</script>
    @endpush
@endsection
