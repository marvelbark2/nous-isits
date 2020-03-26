@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'La tache'
])

@section('content')
    <div class="content">
            <div class="container page-todo bootstrap snippets">
                    <div class="col-md-12 tasks">
                        <div class="task-list">
                            <h1>Taches non assignees</h1>
                            <div class="priority high"><span>Urgent</span></div>
                        @if (count($high)>0)
                            @foreach($high as $i)
                            @if($high->last())
                            <div class="task high last">
                                <div class="desc">
                                    <div class="title"> <a href="/tache/{{$i->id}}" style="color:black"> {{$i->title}} </a></div>
                                </div>
                                <div class="time">
                                    <div class="date">{{$i->deadline->formatLocalized('%d %B')}}</div>
                                </div>
                            </div>
                            @else
                            <div class="task high">
                                    <div class="desc">
                                        <div class="title"> <a href="/tache/{{$i->id}}" style="color:black"> {{$i->title}} </a></div>
                                    </div>
                                    <div class="time">
                                        <div class="date">{{$i->deadline->formatLocalized('%d %B')}}</div>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        @else
                            <p class="text-center"><span>Pas de tache Urgent !</span> </p>
                        @endif

                            <div class="priority medium"><span>Moyen</span></div>

                            @if (count($medium)>0)
                            @foreach($medium as $i)
                            @if($medium->last())
                            <div class="task medium last">
                                <div class="desc">
                                    <div class="title"> <a href="/tache/{{$i->id}}" style="color:black"> {{$i->title}} </a></div>
                                </div>
                                <div class="time">
                                    <div class="date">{{$i->deadline->formatLocalized('%d %B')}}</div>
                                </div>
                            </div>
                            @else
                            <div class="task medium">
                                    <div class="desc">
                                        <div class="title"> <a href="/tache/{{$i->id}}" style="color:black"> {{$i->title}} </a></div>
                                    </div>
                                    <div class="time">
                                        <div class="date">{{$i->deadline->formatLocalized('%d %B')}}</div>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        @else
                        <br>
                            <p class="text-center"><span>Pas de tache de priorité mi-saignante !</span> </p>
                        @endif

                            <div class="priority low"><span>Basse</span></div>
                            @if (count($low)>0)
                            @foreach($low as $i)
                            <div class="task low">
                                    <div class="desc">
                                        <div class="title">
                                        <a href="/tache/{{$i->id}}" style="color:black"> {{$i->title}} </a>
                                        </div>
                                    </div>
                                    <div class="time">
                                        <div class="date">{{$i->deadline->formatLocalized('%d %B')}}</div>
                                    </div>
                            </div>
                            @endforeach
                            @else
                            <br>
                            <p class="text-center"><span>Pas de tache de priorité basse !</span> </p>
                        @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    </div>
    </div>
    @push('style')
    <style>
        .page-todo .tasks {
    background: #fff;
    padding: 0;
    border-right: 1px solid #d1d4d7;
    margin: -30px 15px -30px -15px
}

.page-todo .task-list {
    padding: 30px 15px;
    height: 100%
}

.page-todo .graph {
    height: 100%
}

.page-todo .priority.high {
    background: #fffdfd;
    margin-bottom: 1px
}

.page-todo .priority.high span {
    background: #f86c6b;
    padding: 2px 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px
}

.page-todo .priority.medium {
    background: #fff0ab;
    margin-bottom: 1px
}

.page-todo .priority.medium span {
    background: #f8cb00;
    padding: 2px 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px
}

.page-todo .priority.low {
    background: #cfedda;
    margin-bottom: 1px
}

.page-todo .priority.low span {
    background: #4dbd74;
    padding: 2px 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px
}

.page-todo .task {
    border-bottom: 1px solid #e4e5e6;
    margin-bottom: 1px;
    position: relative
}

.page-todo .task .desc {
    display: inline-block;
    width: 75%;
    padding: 10px 10px;
    font-size: 12px
}

.page-todo .task .desc .title {
    font-size: 18px;
    margin-bottom: 5px
}

.page-todo .task .time {
    display: inline-block;
    width: 15%;
    padding: 10px 10px 10px 0;
    font-size: 12px;
    text-align: right;
    position: absolute;
    top: 0;
    right: 0
}

.page-todo .task .time .date {
    font-size: 18px;
    margin-bottom: 5px
}

.page-todo .task.last {
    border-bottom: 1px solid transparent
}

.page-todo .task.high {
    border-left: 2px solid #f86c6b
}

.page-todo .task.medium {
    border-left: 2px solid #f8cb00
}

.page-todo .task.low {
    border-left: 2px solid #4dbd74
}

.page-todo .timeline {
    width: auto;
    height: 100%;
    margin: 20px auto;
    position: relative
}

.page-todo .timeline:before {
    position: absolute;
    content: '';
    height: 100%;
    width: 4px;
    background: #d1d4d7;
    left: 50%;
    margin-left: -2px
}

.page-todo .timeslot {
    display: inline-block;
    position: relative;
    width: 100%;
    margin: 5px 0
}

.page-todo .timeslot .task {
    position: relative;
    width: 44%;
    display: block;
    border: none;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.page-todo .timeslot .task span {
    border: 2px solid #63c2de;
    background: #e1f3f9;
    padding: 5px;
    display: block;
    font-size: 11px
}

.page-todo .timeslot .task span span.details {
    font-size: 16px;
    margin-bottom: 10px
}

.page-todo .timeslot .task span span.remaining {
    font-size: 14px
}

.page-todo .timeslot .task span span {
    border: 0;
    background: 0 0;
    padding: 0
}

.page-todo .timeslot .task .arrow {
    position: absolute;
    top: 6px;
    right: 0;
    height: 20px;
    width: 20px;
    border-left: 12px solid #63c2de;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent;
    margin-right: -18px
}

.page-todo .timeslot .task .arrow:after {
    position: absolute;
    content: '';
    top: -12px;
    right: 3px;
    height: 20px;
    width: 20px;
    border-left: 12px solid #e1f3f9;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent
}

.page-todo .timeslot .icon {
    position: absolute;
    border: 2px solid #d1d4d7;
    background: #2a2c36;
    -webkit-border-radius: 50em;
    -moz-border-radius: 50em;
    border-radius: 50em;
    height: 30px;
    width: 30px;
    top: 0;
    left: 50%;
    margin-left: -17px;
    color: #fff;
    font-size: 14px;
    line-height: 30px;
    text-align: center;
    text-shadow: none;
    z-index: 2;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.page-todo .timeslot .time {
    background: #d1d4d7;
    position: absolute;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    top: 1px;
    left: 50%;
    padding: 5px 10px 5px 40px;
    z-index: 1;
    margin-top: 1px
}

.page-todo .timeslot.alt .task {
    margin-left: 56%;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.page-todo .timeslot.alt .task .arrow {
    position: absolute;
    top: 6px;
    left: 0;
    height: 20px;
    width: 20px;
    border-left: none;
    border-right: 12px solid #63c2de;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent;
    margin-left: -18px
}

.page-todo .timeslot.alt .task .arrow:after {
    top: -12px;
    left: 3px;
    height: 20px;
    width: 20px;
    border-left: none;
    border-right: 12px solid #e1f3f9;
    border-top: 12px solid transparent;
    border-bottom: 12px solid transparent
}

.page-todo .timeslot.alt .time {
    top: 1px;
    left: auto;
    right: 50%;
    padding: 5px 40px 5px 10px
}

@media only screen and (min-width:992px) and (max-width:1199px) {
    .page-todo task .desc {
        display: inline-block;
        width: 70%;
        padding: 10px 10px;
        font-size: 12px
    }
    .page-todo task .desc .title {
        font-size: 16px;
        margin-bottom: 5px
    }
    .page-todo task .time {
        display: inline-block;
        float: right;
        width: 20%;
        padding: 10px 10px;
        font-size: 12px;
        text-align: right
    }
    .page-todo task .time .date {
        font-size: 16px;
        margin-bottom: 5px
    }
}

@media only screen and (min-width:768px) and (max-width:991px) {
    .page-todo .task {
        margin-bottom: 1px
    }
    .page-todo .task .desc {
        display: inline-block;
        width: 65%;
        padding: 10px 10px;
        font-size: 10px;
        margin-right: -20px
    }
    .page-todo .task .desc .title {
        font-size: 14px;
        margin-bottom: 5px
    }
    .page-todo .task .time {
        display: inline-block;
        float: right;
        width: 25%;
        padding: 10px 10px;
        font-size: 10px;
        text-align: right
    }
    .page-todo .task .time .date {
        font-size: 14px;
        margin-bottom: 5px
    }
    .page-todo .timeslot .task span {
        padding: 5px;
        display: block;
        font-size: 10px
    }
    .page-todo .timeslot .task span span {
        border: 0;
        background: 0 0;
        padding: 0
    }
    .page-todo .timeslot .task span span.details {
        font-size: 14px;
        margin-bottom: 0
    }
    .page-todo .timeslot .task span span.remaining {
        font-size: 12px
    }
}

@media only screen and (max-width:767px) {
    .page-todo .tasks {
        position: relative;
        margin: 0!important
    }
    .page-todo .graph {
        position: relative;
        margin: 0!important
    }
    .page-todo .task {
        margin-bottom: 1px
    }
    .page-todo .task .desc {
        display: inline-block;
        width: 65%;
        padding: 10px 10px;
        font-size: 10px;
        margin-right: -20px
    }
    .page-todo .task .desc .title {
        font-size: 14px;
        margin-bottom: 5px
    }
    .page-todo .task .time {
        display: inline-block;
        float: right;
        width: 25%;
        padding: 10px 10px;
        font-size: 10px;
        text-align: right
    }
    .page-todo .task .time .date {
        font-size: 14px;
        margin-bottom: 5px
    }
    .page-todo .timeslot .task span {
        padding: 5px;
        display: block;
        font-size: 10px
    }
    .page-todo .timeslot .task span span {
        border: 0;
        background: 0 0;
        padding: 0
    }
    .page-todo .timeslot .task span span.details {
        font-size: 14px;
        margin-bottom: 0
    }
    .page-todo .timeslot .task span span.remaining {
        font-size: 12px
    }
}
        </style>
    @endpush
@endsection
