@extends('layouts.app', ['title' => __('Matieres')])
@section('content')
@include('users.partials.header', [
        'title' => "Matiere",
        'description' => __('Selectionner une matiere pour creer QE'),
        'class' => 'col-lg-10'
    ])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class=""></h3>
                        </div>
                        <div class="col-4 text-left">
                        </div>
                    </div>
                </div>
        <div class="col-12"></div>
    <div class="col-md-12">
       <form method="post">
            <div class="form-group">
              <label for="">Module</label>
              <select class="form-control module" name="module" id="module">
                <option value="">select the module</option>
                @foreach ($module as $item)
                 <option value="{{$item->id}}">{{$item->module}}</option>
                @endforeach
              </select>
            </div>
            <input type="hidden" name="m_id" id="m_id" value="">
            <div class="form-group">
              <label for="">Matiere</label>
              <select class="form-control" name="matiere" id="matiere">

              </select>
            </div>
        </form>
                       <div class="card-footer py-4">
                </div>

    </div>
     </div>
    </div>
</div>
    @include('layouts.footers.auth')
</div>
@endsection
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @push('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
$(document).ready(function () {
    $('.module').select2({
        placeholder: "Select a module",
        allowClear: true
    });
    $('#matiere').select2({
        placeholder: "Select a matiere",
    });
    $('.module').on('change', function () {
            var value = $(this).val();
            if ($(this).val()) {
                $.ajax({
                    type: 'POST',
                    url: "../api/matiere/" + $(this).val(),
                    data: {id: $(this).val()},
                    success: function (result) {
                        let op=[];
                        var realArray = $.makeArray( result )
                        $.map( realArray, function( val, i ) {
                            op +='<option value="'+val.id+'">'+val.matiere+'</option>';
                        });
                        $('#matiere').html("<option >select the matiere</option>");
                        $('#matiere').append(op);
                    }
                });
            } else {
                $('.matiere').html('<option value="">Choix matiere</option>');
            }
        });
$("#matiere").on("select2:select", function (e) {
    window.open('qe/' + e.params.data.id);
});
});
    </script>
    @endpush
  </body>
</html>
