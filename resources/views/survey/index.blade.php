@extends('layouts.app')
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
<div class="container-fluid"></div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Listes des sondages</h3>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <ul class="list-group">
                        @foreach ($surveys as $item)
                        @php
                            $isset = MattDaneshvar\Survey\Models\Entry::where('survey_id', $item->id)->where('participant_id', Auth::id())->count();
                        @endphp
                        <a href="{{route('survey-show', ['survey' => $item->id])}}">
                            <li class="list-group-item @if($isset > 0) list-group-item-info @endif">
                                {{$item->name}}
                                <p class="text-default text-right">
                                    cree <strong>{{ $item->created_at->diffForHumans() }}</strong>
                                </p>
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>


                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
