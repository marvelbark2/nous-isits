@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'Modifier une tache'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Modifier Tache</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tache.updating', $tache->id) }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @method('PUT')
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
                            <input name="titre" type="text" class="form-control" id="exampleFormControlInput1" value="{{ old('Titre', $tache->title) }}">
                            </div>
                            <div class="form-group">
                             <label for="exampleFormControlSelect2">Description <span style="color:brown;">*</span></label>
                             <textarea id="froala-editor" name="description" style="width:100%;">
                                    {{old('Description', $tache->description)}}
                             </textarea>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Assigné à</label>
                              <select name="user" class="form-control icons_select2-multiple" id="exampleFormControlSelect1">
                                @if($tache->assigned)
                                <option selected data-image="mike.jpg">
                                    {{$tache->assigned->name}}</option>
                                @endif
                                <option value="0" data-icon="fa-tumblr">Personne</option>
                                @foreach ($users as $i)
                              <option value="{{$i->id}}" data-image="mike.jpg">{{$i->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">DeadLine<span style="color:brown;">*</span></label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                        </div>
                                        <input name="deadline" class="form-control datepicker" value="{{ old('Deadline', $tache->deadline) }}" type="text">
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-info">Soumettre</button>
                          </form>
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
function iformat(image) {
    var originalOption = image.element;
    return $('<img style="width: 25px;height: 25px;overflow: hidden;border-radius: 50%;margin-bottom: 15px;margin-top: 10px;" src="http://localhost:8000/paper/img/' + $(originalOption).data('image') + '" alt="..." > &nbsp;' + image.text + '</span>');
}
$('.icons_select2-multiple').select2({
    width: "100%",
    height: "100px",
    templateSelection: iformat,
    templateResult: iformat,
    allowHtml: true
});

new FroalaEditor('textarea#froala-editor', {
    language: 'fr'
 })
 </script>
@endpush

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<style>
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 45px;
    user-select: none;
    -webkit-user-select: none;
}
</style>
@endpush
@endsection
