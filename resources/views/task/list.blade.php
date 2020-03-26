@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tache-admin'
])

@section('content')
    <div class="content">
        <div class="row">
             <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                 @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-left">
                        <a href="/tache/create" class="btn btn-primary btn-round text-white pull-right">Nouvelle tache</a>
                        <h4 class="card-title"> Liste des taches</h4>
                    </div>
                    <div class="card-body">
                        @if (session('password_status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('password_status') }}
                            </div>
                        @endif
                            <table id="table_id" class="table">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Cree par</th>
                                            <th>Affectee a</th>
                                            <th>Deadline</th>
                                            <th>status</th>
                                            <th>Complete ?</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $i)
                                        @if($i->status == 100 || $i->completed == 1)
                                            <tr style="color: #270;
                                            background-color: #DFF2BF;" >
                                        @elseif($i->deadline->formatLocalized('%A %d %B %Y') == \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y'))
                                            <tr style="color: #9F6000;background-color: #FEEFB3;">
                                        @elseif($i->deadline < \Carbon\Carbon::now())
                                            <tr style="background-color: #ff4444 !important; color:white;">
                                        @else
                                            <tr>
                                        @endif
                                            <td>{{$i->title}}</td>
                                            <td>{{$i->user->name}}</td>
                                            <td>
                                                @if($i->assigned)
                                                {{$i->assigned->name}}
                                                @else
                                                <span class="text-danger">Pas encore</span>
                                                @endif
                                            </td>
                                            <td>{{$i->deadline->formatLocalized('%A %d %B %Y')}}</td>
                                            <td>
                                                <div class="progress">
                                                @if($i->status == 100)
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$i->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                @else
                                                <div class="progress-bar" role="progressbar" style="width: {{$i->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($i->completed)
                                                Oui
                                                @else
                                                Non
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="nc-align-left-2 nc-icon"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('tache.destroy', $i->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')

                                                            <a class="dropdown-item" href="/admin/tache/{{$i->id}}/details">{{ __('Details') }}</a>
                                                            <a class="dropdown-item" href="/tache/{{$i->id}}/edit">{{ __('Modfier') }}</a>
                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Vous voulez vraiment supprimer cette tache ?") }}') ? this.parentElement.submit() : ''">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-left"> Calendrier des Deadlines</h4>
                    </div>
                    <div class="card-body" style=" margin-top: 40px;
                    text-align: center;
                    font-size: 14px;
                    font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
                    background-color: #DDDDDD;">
                        <div id='wrap'>

                        <div id='calendar'></div>

                        <div style='clear:both'></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @push('style')
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>

    @endpush
    @push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
    var table = $("#table_id").DataTable({
    "columnDefs": [
    { "orderable": false, "searchable": false, "targets": 6 }
  ],
  "oLanguage": { "sUrl": "//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json" }
  });

//  table.button().add( 0, {
//      action: function ( e, dt, button, config ) {
//          dt.ajax.reload();
//      },
//      text: 'Reload table'
//  } );
    </script>
    @endpush
    @push('style')
    <link href='/assets/css/fullcalendar.css' rel='stylesheet' />
    <link href='/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<style>

            /* body {
                margin-top: 40px;
                text-align: center;
                font-size: 14px;
                font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
                background-color: #DDDDDD;
                } */

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
                .fc-grid .fc-day-number {
                float: right;
                padding: 0 2px !important;
                }
                .fc-week .fc-day > div .fc-day-number {
    font-size: 15px;
    margin: 2px;
    min-width: 21px;
    padding: 6px;
    text-align: center;
}
        </style>
    @endpush
    @push('scripts')
    <script src='/assets/js/jquery-1.10.2.js' type="text/javascript"></script>
    <script src='/assets/js/jquery-ui.custom.min.js' type="text/javascript"></script>
    <script src='/assets/js/fullcalendar.js' type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales/ar.js" integrity="sha256-O5YjpZzV1NrRpfN4ylO/NIqA+wkNuZFcFoQTYtiik10=" crossorigin="anonymous"></script>
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
            lang: 'ar',
			header: {
				left: 'title',
				//center: 'month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                // week: 'ddd d', // Mon 7
                // day: 'dddd M/d',  // Monday 9/7
                // agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                // week: "MMMM yyyy", // September 2009
                // day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
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
                     // now carbon: {{\Carbon\Carbon::now()->formatLocalized('%A %d %B %Y')}}
                     // now php: {{$i->deadline->formatLocalized('%A %d %B %Y')}}
                     //strtotime deadline: {{strtotime($i->deadline)}}
                     //stro ame {{strtotime("now")}}
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
