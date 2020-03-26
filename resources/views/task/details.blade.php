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
                        <h4 class="card-title text-info"> Info sur la tache</h4>
                    </div>
                    <div class="card-body">
                            <table style="width:100%">
                                    <tr>
                                      <th>Titre:</th>
                                      <td>
                                          {{$taches[0]->title}}
                                          &nbsp;
                                          @if ($taches[0]->priority == 3)
                                          <span class="badge badge-danger">Urgent</span>
                                          @elseif($taches[0]->priority == 2)
                                          <span class="badge badge-warning" style="background: #f8cb00; color:white;">Moyenne</span>
                                          @else
                                          <span class="badge badge-info">Basse</span>
                                          @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Deadline:</th>
                                    <td><h6><span class="text-seconde">
                                        {{$taches[0]->deadline->formatLocalized('%A %d %B %Y')}}
                                        </span></h6></td>
                                    </tr>
                                    <tr>
                                      <th>Cree par:</th>
                                      <td>{{$taches[0]->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Progression:</th>
                                        <td>
                                            {{$taches[0]->status}} %
                                        </td>
                                    </tr>
                                  </table>
                    </div>
                </div>
                {{-- second card --}}
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-info">Description de la tache</h4>
                        </div>
                        <div class="card-body">
                            <div class="fr-view">
                                {!! $taches[0]->description !!}
                            </div>
                        </div>
                </div>
                {{-- thrid card --}}
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-info">Traitement de tache</h4>
                        </div>
                        <div class="card-body">
                             <form method="post" action="/tache/{{$taches[0]->id}}/details" autocomplete="off"
                                enctype="multipart/form-data">
                    @csrf
 <div class="alert alert-info alert-with-icon alert-dismissible fade show"
                                            data-notify="container">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                <i class="nc-icon nc-simple-remove"></i>
                             </button>
                             <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                             <span data-notify="message">(<span style="color:brown;">*</span>) Ce champs est obligatoire
                            </span>
                            </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Titre <span style="color:brown;">*</span></label>
                      <input name="titre" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="form-group">
                            <label for="exampleFormControlSelect2">Traitement <span style="color:brown;">*</span></label>
                            <textarea id="froala-editor" name="details" style="width:100%;"></textarea>
                    </div>
                    <div class="form-group">
                            <label for="exampleFormControlSelect2">status <span style="color:brown;">*</span></label>
                            <select name="status" class="form-control js-example-basic-single" id="exampleFormControlSelect1">
                               <option value="{{$taches[0]->status}}">aucun changement</option>
                               <option value="0">Rien</option>
                               <option value="25">En cours</option>
                               <option value="50">50/50</option>
                               <option value="75">Avance</option>
                               <option value="90">proche a finir</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                            </form>
                            </div>
                        </div>
                </div>
                {{-- 4 card --}}
                        @if(count($details)>0)
                            <div class="card">
                                <div class="card-body">
                                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                                        <h4 class="card-title text-info">Liste des traitements</h4>
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
                <div class="card">
                     <div class="card-header">
                         <h4 class="card-title text-info">Commentaires</h4>
                     </div>
                     <div class="card-body">
                         @comments(['model' => $taches[0]])
                     </div>
                </div>
<!-- END Card -->
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-info">Terminer la tache</h4>
                        </div>
                        <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Terminer la tache
                                </button>
                                <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">La Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    Je confirme termination des la tache
                </div>
                <div class="modal-footer">
                <form method="post" action="/tache/{{$taches[0]->id}}/completed" autocomplete="off"
                            enctype="multipart/form-data">
                @method('PUT')
                @csrf
                  <button type="submit" class="btn btn-primary">Confirmer</button>
                </form>
                </div>
              </div>
            </div>
          </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/js/froala_editor.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.0.5/js/languages/fr.js" integrity="sha256-QE54n+OqIC4fUThAURIWHLFXK7AQ/1Nz0GH9P5lIqHk=" crossorigin="anonymous"></script>
<script>
//select2
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
//text editor
new FroalaEditor('textarea#froala-editor', {
    language: 'fr'
 })
//modal
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

$('#mModal').on('shown.bs.modal', function () {
  $('#mInput').trigger('focus')
})
</script>
@endpush
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

    <style>
        h6 span {
@if($taches[0]->status == 100 || $taches[0]->completed == 1)
color: #270;
background-color:#DFF2BF;
@elseif($taches[0]->deadline->formatLocalized('%A %d %B %Y') == \Carbon\Carbon::now()->formatLocalized('%A %d %B %Y'))
color: #9F6000;
background-color: #FEEFB3;
@elseif($taches[0]->deadline < \Carbon\Carbon::now())
background-color: #ff4444 !important;
color:white;
@else
color: #fff;
background-color: #446688;
@endif

padding: 1px 5px 3px 5px;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
}
    </style>
@endpush
@endsection
