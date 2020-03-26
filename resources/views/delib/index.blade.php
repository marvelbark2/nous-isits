<!doctype html>
<html lang="en">
  <head>
    <title>Deliberation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />

  </head>
  <body>
    <div class="container">
    <form id="delib" action="{{route('affichage')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="">Etablissement</label>
          <select class="etab form-control" name="etab" id="etab">
              <option value="">Select a Etablissement</option>
            @foreach ($etab as $item)
          <option value="{{$item->code}}">{{$item->designation}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="">Formation</label>
          <select class="forma form-control" name="forma" id="forma">
            <option></option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Promotion</label>
          <select class="promo form-control" name="promo" id="promo">
            <option></option>
          </select>
        </div>
         <div class="form-group">
          <label for="">Semestre</label>
          <select class="semestre form-control" name="semestre" id="semestre">
            <option></option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Resultat</h3>
                <table id="student_table" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Note</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function () {
        $("#delib").submit(function(event){
            event.preventDefault(); //prevent default action
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $("#delib").serialize(); //Encode form elements for submission
                var table = $("#student_table").DataTable({
                "pageLength": 50,
                "serverSide": true,
                "paging": false,
                "searching": false,
                "order": [[0, "desc"]],
                "ajax":{
                    url : post_url,
                    type: 'POST',
                    //processData: false,
                   // contentType: false,
                    data: function (d) {
                        d._token = $('input[name=_token]').val();
                        d.forma = $('select[name=forma]').val();
                        d.semestre = $('select[name=semestre]').val();
                    },
                    dataType: 'json',
                },
                "columns": [
                    { "data": "ins.nom" },
                    { "data": "ins.prenom" },
                    { "data": "note" },
                    { "data": "statuts.designation" },
                    { "defaultContent": "<button class='btn btn-dark'>Details</button>"}
                 ],

                 "oTableTools": {
                        "aButtons": [
                        "copy",
                        "print",
                        {
                        "sExtends": "collection",
                        "sButtonText": "Save",
                        "aButtons": [ "csv", "xls", "pdf" ]
                        }
                    ]
                },
                "columnDefs": [
                        { "orderable": false, "targets": [4] },
                    ],
                "processing": true,
            });

            $('#student_table tbody').on( 'click', 'button', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var win = window.open("/delib/student/"+data.id_inscription, '_blank');
                win.focus();
            } );
        });

        $('.etab').select2({
            placeholder: "Select a Etablissement",
            allowClear: true
        });
        $('.forma').select2({
            placeholder: "Select a formation",
        });
        $('.promo').select2({
            placeholder: "Select a promotion",
        });
        $('.semestre').select2({
            placeholder: "Select a Semestre",
        });
        $('.etab').on('change', function () {
            var value = $(this).val();
            if ($(this).val()) {
                $.ajax({
                    type: 'POST',
                    url: "../api/format/" + $(this).val(),
                    data: {id: $(this).val()},
                    success: function (result) {
                        let op=[];
                        var realArray = $.makeArray( result )
                        $.map( realArray, function( val, i ) {
                            op +='<option value="'+val.code+'">'+val.designation+'</option>';
                        });
                        $('#forma').html("<option >select the formation</option>");
                        $('#forma').append(op);
                    }
                });
            } else {
                $('.forma').html('<option value="">Choix matiere</option>');
            }
        });
        $('.forma').on('change', function () {
            var value = $(this).val();
            if ($(this).val()) {
                $.ajax({
                    type: 'POST',
                    url: "../api/promo/" + $(this).val(),
                    data: {id: $(this).val()},
                    success: function (result) {
                        let op=[];
                        var realArray = $.makeArray( result )
                        $.map( realArray, function( val, i ) {
                            op +='<option value="'+val.code+'">'+val.designation+'</option>';
                        });
                        $('#promo').html("<option >select the promotion</option>");
                        $('#promo').append(op);
                    }
                });
            } else {
                $('.promo').html('<option value="">Choix promotion</option>');
            }
        });
        $('.promo').on('change', function () {
            var value = $(this).val();
            if ($(this).val()) {
                $.ajax({
                    type: 'POST',
                    url: "../api/semestre/" + $(this).val(),
                    data: {id: $(this).val()},
                    success: function (result) {
                        let op=[];
                        var realArray = $.makeArray( result )
                        $.map( realArray, function( val, i ) {
                            op +='<option value="'+val.id_semestre+'">'+val.designation+'</option>';
                        });
                        $('#semestre').html("<option >select the semestre</option>");
                        $('#semestre').append(op);
                    }
                });
            } else {
                $('.semestre').html('<option value="">Choix semestre</option>');
            }
        });

    });
    </script>
  </body>
</html>
