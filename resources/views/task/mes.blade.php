@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'mt'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Mes Tache</h4>
                    </div>
                    <div class="card-body">
                        @if (count($mt) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Tache
                                    </th>
                                    <th>
                                        Cree par
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th class="text-right">
                                        DeadLine
                                    </th>
                                    <th></th>
                                </thead>
                                <tbody>
                                @foreach ($mt as $i)
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
                                        <td>
                                            {{$i->title}}
                                        </td>
                                        <td>
                                            {{$i->user->name}}
                                        </td>
                                        <td>
                                            <div class="progress">
                                                @if($i->status == 100)
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$i->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                @else
                                                <div class="progress-bar" role="progressbar" style="width: {{$i->status}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            @if($i->deadline < \Carbon\Carbon::now() || $i->deadline == \Carbon\Carbon::now())
                                            <s>{{$i->deadline->formatLocalized('%A %d %B %Y')}}</s>
                                            @else
                                            {{$i->deadline->formatLocalized('%A %d %B %Y')}}
                                            @endif
                                        </td>
                                        <td class="text-right">
                                        <a href="/tache/{{$i->id}}/details"><i class="nc-icon nc-alert-circle-i"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-center">Pas des taches assignee a vous</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
