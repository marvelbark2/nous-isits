@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'Cree une tache'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Nouvelle Tache</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('tache.store') }}" autocomplete="off"
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
                                    <label for="exampleFormControlSelect1">Priorite <span style="color:brown;">*</span></label>
                                    <select name="priority" class="form-control priority" id="exampleFormControlSelect1">
                                      <option value="1" data-icon="fa-volume-down">Basse</option>
                                      <option value="2" data-icon="fa-medium">Moyenne</option>
                                      <option value="3" data-icon="fa-volume-up">Urgent</option>
                                    </select>
                            </div>
                            {{-- <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="1">
                                        Basse
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="2">
                                        Moyene
                                         <span class="form-check-sign">
                                            <span class="check"></span>
                                         </span>
                                    </label>
                                </div> --}}
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Assigné à</label>
                              <select name="user" class="form-control users" id="exampleFormControlSelect1">
                                <option value="0" data-icon="fa-volume-down">Personne</option>
                                @foreach ($users as $i)
                              <option value="{{$i->id}}" data-icon="fa-volume-down">{{$i->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">DeadLine<span style="color:brown;">*</span></label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                        </div>
                                        <input name="deadline" class="form-control datepicker" placeholder="choisissez le deadline" type="text">
                                    </div>
                                </div>
                            <div class="form-group">
                             <label for="exampleFormControlSelect2">Description <span style="color:brown;">*</span></label>
                             <textarea id="froala-editor" name="description" style="width:100%;"></textarea>
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
<script type="text/javascript" src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
$(".users").select2();
});
</script>
<script>
new FroalaEditor('textarea#froala-editor', {
    language: 'fr',
    documentReady: true
     })
 </script>
 <script>

 $(document).ready(function() {
    // $('.users').select2();
    function iformat(icon) {
    var originalOption = icon.element;
    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
}
$('.priority').select2({
    width: "100%",
    templateSelection: iformat,
    templateResult: iformat,
    allowHtml: true
});
// $('.js-example-basic-single').select2({
//     width: "100%",
//     templateSelection: iformat,
//     templateResult: iformat,
//     allowHtml: true
// });
});
 </script>
@endpush

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.5/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

@endpush
@endsection
