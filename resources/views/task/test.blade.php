@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'liste des tache - Admin'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-info"> Info sur la tache</h4>
                            </div>
                            <div class="card-body">
                                    <table class="table">
                                            <tr>
                                              <th>Titre:</th>
                                              <td>{{$tache->title}}</td>
                                            </tr>
                                            <tr>
                                              <th>Deadline:</th>
                                            <td><h6><span class="text-seconde">
                                                {{$tache->deadline->formatLocalized('%A %d %B %Y')}}
                                                </span></h6></td>
                                            </tr>
                                            <tr>
                                              <th>Cree par:</th>
                                              <td>{{$tache->user->name}}</td>
                                            </tr>
                                            <tr>
                                              <th>Affectee a:</th>
                                              <td>{{$tache->assigned['name']}}</td>
                                            </tr>
                                            <tr>
                                                <th>Progression:</th>
                                                <td>
                                                    {{$tache->status}} %
                                                </td>
                                            </tr>
                                          </table>
                            </div>
                        </div>
                        {{-- second card --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-info"> Traitement</h4>
                    </div>
                    <div class="card-body">
                            <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-timeline">
                                                <div class="timeline">
                                                    <a href="#" class="timeline-content">
                                                        <div class="timeline-icon">
                                                            <i class="fa fa-play"></i>
                                                        </div>
                                                        <div class="inner-content">
                                                            <h3 class="title">Demarche de la tache</h3>
                                                            <span>
                                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                    {{$tache->created_at->formatLocalized('%A %d %B %Y')}}
                                                            </span><br>
                                                            <p class="description">
                                                            La tache est affectee a {{$tache->user->name}}
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @if ($details)
                                            @foreach($details as $i)
                                                <div class="timeline">
                                                    <a href="#" class="timeline-content">
                                                        <div class="timeline-icon">
                                                            <i class="fa fa-info-circle"></i>
                                                        </div>
                                                        <div class="inner-content">
                                                            <h3 class="title">{{$i->title}}</h3>
                                                            <span>
                                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                {{$i->created_at->formatLocalized('%A %d %B %Y')}}
                                                            </span><br>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                            @endif
                                            @if ($tache->completed)
                                            <div class="timeline">
                                                    <a href="#" class="timeline-content">
                                                        <div class="timeline-icon">
                                                            <i class="fa fa-flag-checkered"></i>
                                                        </div>
                                                        <div class="inner-content">
                                                            <h3 class="title">{{$tache->updated_at->formatLocalized('%A %d %B %Y')}}</h3>
                                                            <p class="description">
                                                            La tache est completee
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                {{-- third card --}}
                @if(count($details)>0)
                <div class="card">
                    <div class="card-body">
                        <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                            <h4 class="card-title text-info">details des traitements</h4>
                            <ul>
                            @foreach ($details as $i)
                            <div class="card card-plain">
                                <div class="card-header" role="tab" id="heading{{$i->id}}">
                                <li class="list-group-item">
                                        <div class="row">
                                            <div class="col text-left">
                                            <a class="text-primary"><i class="material-icons">{{$i->title}}</i></a>
                                            </div>
                                            <div class="col text-right">
                                            <a href="#exampleModal{{$i->id}}"  class="text-primary"data-toggle="modal"><i class="nc-icon nc-minimal-right"></i></a>
                                            </div>
                                    </li>
                                </div>
                                <div class="modal fade" id="exampleModal{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">{{$i->created_at->formatLocalized('%A %d %B %Y @%H:%m')}}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="fr-view">
                                                {!! $i->details !!}
                                        </div>
                                        </div>

                                      </div>
                                    </div>
                                  </div>
                            </div>
                            @endforeach
                        </ul>
                        </div>
                    </div>
                </div>
            @endif
            @if ($tache->completed == 0)
                {{-- 4 card --}}
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-info"> Status</h4>
                        </div>
                        <div class="card-body">
                         Le deadline se termine <b>{{$tache->deadline->diffForHumans()}}</b> <br/>
                        <div class="row">
                        <div class="col">
                         Le progrès :
                        </div>
                        <div class="col-6 text-left">
                            <!-- add loop for success and in proccess -->
                         <div class="progress">
                             <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{$tache->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                         </div>
                        </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="card">
            <div class="card-header">
                    <form method="post" action="/tache/{{$tache->id}}/reactiver" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <button type="submit" class="btn btn-primary btn-round text-white pull-right">Reactiver la tache</button>
                    </form>
                <h4 class="card-title text-info"> Status</h4>
            </div>
            <div class="card-body">
              <div class="row">
            <div class="col">
             Le progrès :
            </div>
            <div class="col-6 text-left">
                <!-- add loop for success and in proccess -->
             <div class="progress">
                 @if ($tache->completed == '1' || $tache->status == '100')
                 <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{$tache->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                 @else
                 <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$tache->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                 @endif
             </div>
            </div>
            </div>
        </div>
    </div>
    @endif
            </div>
        </div>
    </div>
    <!-- popup -->
    @if($tache->status == 100)
    @elseif($tache->deadline->formatLocalized('%A %d %B %Y') > \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y'))
            {{-- <div class="modal fade show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Le deadline est termine !</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            {{$tache->deadline->diffForHumans()}} , le deadline est termine sans completer la tache
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                  </div>
                </div>
            </div> --}}
            {{-- <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
                    <div class="toast" style="position: absolute; top: 0; right: 0;" data-autohide="false">
                      <div class="toast-header">
                        <svg class="rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
                          focusable="false" role="img">
                          <rect fill="#007aff" width="100%" height="100%" /></svg>
                        <strong class="mr-auto">Bootstrap</strong>
                        <small>11 mins ago</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="toast-body">
                        Hello, world! This is a toast message.
                      </div>
                    </div>
            </div> --}}
        @endif
    @push('style')
    <style>
        .demo{ background-color: #dbdbdb; }
.main-timeline{ font-family: 'Roboto', sans-serif; }
.main-timeline:before{
    content: '';
    background-color: #e7e7e7;
    height: 100%;
    width: 15px;
    border-radius: 10px;
    transform: translateX(-50%);
    position: absolute;
    left: 50%;
    top: 0;
}
.main-timeline:after{
    content: '';
    display: block;
    clear: both;
}
.main-timeline .timeline{
    width: 50%;
    padding: 0 0 0 25px;
    margin: 0 0 30px 10px;
    float: right;
    position: relative;
}
.main-timeline .timeline:after{
    content: '';
    background-color: #734D8E;
    height: 15px;
    width: 15px;
    border-radius: 50%;
    box-shadow: 0 0 0 3px #fff, 0 0 10px #333;
    transform: translateY(-50%);
    position: absolute;
    left: -7px;
    top: 50%;
}
.main-timeline .timeline-content{
    color: #555;
    background: linear-gradient(to right,#734D8E,#B26BC6 22%);
    padding: 0 0 0 120px;
    display: block;
    position: relative;
    clip-path: polygon(7% 0, 100% 0, 100% 100%, 7% 100%, 0 50%);
}
.main-timeline .timeline-content:hover{ text-decoration: none; }
.main-timeline .timeline-icon{
    color: #fff;
    font-size: 45px;
    transform: translateY(-50%);
    position: absolute;
    top: 50%;
    left: 25px;
}
.main-timeline .inner-content{
    color: #555;
    background-color: #fff;
    min-height: 110px;
    padding: 15px 15px 15px 0;
    position: relative;
}
.main-timeline .inner-content:before{
    content: '';
    background-color: #fff;
    height: 98%;
    width: 80px;
    border-radius: 50%;
    transform: translateY(-50%);
    position: absolute;
    left: -37px;
    top: 50%;
    z-index: -1;
}
.main-timeline .title{
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0 0 5px;
}
.main-timeline .description{
    font-size: 14px;
    letter-spacing: 1px;
    margin: 0;
}
.main-timeline .timeline:nth-child(even){
    padding: 0 25px 0 0;
    margin: 0 10px 30px 0;
    float: left;
}
.main-timeline .timeline:nth-child(even):after{
    left: auto;
    right: -8px;
}
.main-timeline .timeline:nth-child(even) .timeline-content{
    padding: 0 120px 0 0;
    clip-path: polygon(93% 0, 100% 50%, 93% 100%, 0 100%, 0 0);
}
.main-timeline .timeline:nth-child(even) .timeline-icon{
    left: auto;
    right: 25px;
}
.main-timeline .timeline:nth-child(even) .inner-content{ padding: 15px 10px 15px 15px; }
.main-timeline .timeline:nth-child(even) .inner-content:before{
    left: auto;
    right: -37px;
}
.main-timeline .timeline:nth-child(4n+2):after{ background-color: #1c6f82; }
.main-timeline .timeline:nth-child(4n+2) .timeline-content{
    background: linear-gradient(to left,#1c6f82,#4491A2 22%);
}
.main-timeline .timeline:nth-child(4n+3):after{ background-color: #4e5db2; }
.main-timeline .timeline:nth-child(4n+3) .timeline-content{
    background: linear-gradient(to right,#4e5db2,#7582D1 22%);
}
.main-timeline .timeline:nth-child(4n+4):after{ background-color: #525156; }
.main-timeline .timeline:nth-child(4n+4) .timeline-content{
    background: linear-gradient(to left,#525156,#686C75 22%);
}
@media screen and (max-width:767px){
    .main-timeline:before{
        left: 19px;
        transform: translateX(0);
    }
    .main-timeline .timeline,
    .main-timeline .timeline:nth-child(even){
        width: 100%;
        margin: 0 0 30px;
        padding: 0 0 0 25px;
    }
    .main-timeline .timeline:after,
    .main-timeline .timeline:nth-child(even):after{
        left: 3px;
    }
    .main-timeline .timeline-icon,
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        font-size: 30px;
        left: 23px;
    }
    .main-timeline .timeline-content,
    .main-timeline .timeline:nth-child(even) .timeline-content{
        padding: 0 0 0 90px;
        clip-path: polygon(7% 0, 100% 0, 100% 100%, 7% 100%, 0 50%);
    }
    .main-timeline .inner-content:before,
    .main-timeline .timeline:nth-child(even) .inner-content:before{
        width: 50px;
        left: -25px;
    }
}
@media screen and (max-width:567px){
    .main-timeline .timeline-content,
    .main-timeline .timeline:nth-child(even) .timeline-content{
        padding: 0 0 0 65px;
        clip-path: polygon(5% 0, 100% 0, 100% 100%, 5% 100%, 0 50%);
    }
    .main-timeline .timeline-icon,
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        font-size: 21px;
        left: 9px;
    }
    .main-timeline .title{ font-size: 18px; }
}
h6 span {
color: #fff;
background-color: #884444;
padding: 1px 5px 3px 5px;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
}
/* body.modal-open .content{
    -webkit-filter: blur(1px);
    -moz-filter: blur(1px);
    -o-filter: blur(1px);
    -ms-filter: blur(1px);
    filter: blur(1px);
} */

    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha256-xykLhwtLN4WyS7cpam2yiUOwr709tvF3N/r7+gOMxJw=" crossorigin="anonymous" />    @endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script><script type="text/javascript">
//    $(window).on('load',function(){
        // $('#myModal').modal('show');
    @if($tache->status == 100 || $tache->completed)
    toastr.success('La tache est terminee')
    @elseif($tache->deadline->formatLocalized('%A %d %B %Y') > \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y'))
    toastr.error('{{$tache->deadline->diffForHumans()}} , le deadline est termine sans completer la tache')
    @endif
    // });
//     $.notify({
// 	// options
// 	icon: 'glyphicon glyphicon-warning-sign',
// 	title: 'Bootstrap notify',
// 	message: 'Turning standard Bootstrap alerts into "notify" like notifications',
// 	url: 'https://github.com/mouse0270/bootstrap-notify',
// 	target: '_blank'
// },{
// 	// settings
// 	element: 'body',
// 	position: null,
// 	type: "info",
// 	allow_dismiss: true,
// 	newest_on_top: false,
// 	showProgressbar: false,
// 	placement: {
// 		from: "top",
// 		align: "right"
// 	},
// 	offset: 20,
// 	spacing: 10,
// 	z_index: 1031,
// 	delay: 5000,
// 	timer: 1000,
// 	url_target: '_blank',
// 	mouse_over: null,
// 	animate: {
// 		enter: 'animated fadeInDown',
// 		exit: 'animated fadeOutUp'
// 	},
// 	onShow: null,
// 	onShown: null,
// 	onClose: null,
// 	onClosed: null,
// 	icon_type: 'class',
// 	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
// 		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
// 		'<span data-notify="icon"></span> ' +
// 		'<span data-notify="title">{1}</span> ' +
// 		'<span data-notify="message">{2}</span>' +
// 		'<div class="progress" data-notify="progressbar">' +
// 			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
// 		'</div>' +
// 		'<a href="{3}" target="{4}" data-notify="url"></a>' +
// 	'</div>'
// });
</script>
@endpush
@endsection
