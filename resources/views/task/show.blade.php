@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'liste des taches'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="media mt-0 m-b-30"><img class="d-flex mr-3 rounded-circle" alt="64x64" src="https://bootdey.com/img/Content/avatar/avatar2.png" style="width: 48px; height: 48px;">
                        <div class="media-body">
                            <h5 class="media-heading mb-0 mt-0">{{$tache->user->name}}</h5>
                            @if ($tache->priority == 3)
                            <span class="badge badge-danger">Urgent</span>
                            @elseif($tache->priority == 2)
                            <span class="badge badge-warning" style="background: #f8cb00; color:white;">Moyenne</span>
                            @else
                            <span class="badge badge-info">Basse</span>
                            @endif

                        </div>
                    </div>
                        <h4 class="card-title text-info"> {{$tache->title}}</h4>
                        <p style="text-align:left;">
                        <h6> DeadLine : <span class="text-seconde">{{$tache->deadline->formatLocalized('%A %d %B %Y')}}</span></h6>
                        </p>
                    </div>

                    <div class="card-body">
                        <h5 class="m-b-5">Description : </h5>
                        <div class="fr-view">
                            {!! $tache->description !!}
                        </div>
                        @if($tache->user_id == "0")
                    <form method="post" action="/tache/{{$tache->id}}" autocomplete="off"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Assignee Moi</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Je confirme de m'assigner dans cette tache
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                      <button type="submit" class="btn btn-primary">Confirmer</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                    </form>
                    @else
                    {{-- <button class="btn btn-primary disabled">Deja Assignee</button> --}}
                    <span class="d-inline-block" data-toggle="popover" data-placement="top" data-content="Deja Assignee">
                    {{-- <h5>Assignee pour: <span class="text-seconde">{{$tache->assigned->name}}</span> </h5> --}}
                    <h5 class="m-b-5">Assignee a : </h5>
                    <span class="text-seconde"><a><img class="rounded-circle thumb-sm" alt="64x64" src="https://bootdey.com/img/Content/avatar/avatar2.png"style="
                        width: 50px;"
                    > </a></span>
                    </span>
                    @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-info">Commentaires</h4>
                    </div>
                    <div class="card-body">
                        @comments(['model' => $tache])
                    </div>
                 </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
            $(document).ready(function(){
              $('[data-toggle="popover"]').popover();
            });
    </script>
    @endpush
    @push('style')
        <style>
            h6 span {
    color: #fff;
    background-color: #446688;
    padding: 1px 5px 3px 5px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
        </style>
        <style>
            h5 span {
        color: #fff;
        background-color: #51bcda;
        padding: 1px 5px 3px 5px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
            </style>
    @endpush
@endsection
