<!doctype html>
<html lang="en">
  <head>
    <title>Create a module & matiere</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.min.css" integrity="sha256-xs2k744k81ISIOyl14txiKpaRncakLx29JiAve4063w=" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  </head>
  <body>

  <div class="card">
    <div class="" id="form-messages"></div>
      <div class="card-body">
          <h4 class="card-title">Module & Matiere</h4>
          @if(session('message'))
          <div class="alert alert-success" role="alert">
              <strong>{{ session('message') }}</strong>
          </div>
          @endif
          <div class="card-text">
            <form id="mod_mat">
                @csrf
                <div class="form-group">
                  <label for="">Module</label>
                  <input type="text"
                    class="form-control" name="module" id="module" aria-describedby="helpId" placeholder="Module">
                  <small id="helpId" class="form-text text-muted">Add a module</small>
                </div>
                <div id="matiere_field" class="form-group">
                    <label for="">Matiere</label>
                    <input type="text"
                      class="form-control" name="matiere[]" id="matiere" aria-describedby="helpId" placeholder="Matiere">
                    <small id="helpId" class="form-text text-muted">Add a matiere</small>
                </div>
                <div class="form-group">
                    <a href="#" id="add">Add matiere fill</a>
                </div>
                  <button class="btn btn-primary btn-submit" >create</button>
              </form>
            </div>
      </div>
  </div>
    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>

    <script type="text/javascript">
var i=1;
$('#add').click(function(){
    i++;
     $('#matiere_field').append('<input type="text" class="form-control" name="matiere[]" id="matiere" aria-describedby="helpId" placeholder="Matiere"> <small id="helpId" class="form-text text-muted">Add a matiere '+i+'</small>');
});

$(".btn-submit").click(function(event) {
  event.preventDefault();
  var modl = $("input[name=module]").val();
  var matiere = $("input[id=matiere").val();
  var token = $("input[name=_token]").val();
  var values = $('#mod_mat').serialize();
  $.ajax({
    type : "POST",
    url : "/create",
    data : values,
    success : function(data) {
        toastr["success"](data.success,"Confirmation")

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
$(this).closest('form').find("input[type=text]").val("");
    }
  });

});
    </script>

</body>
</html>
