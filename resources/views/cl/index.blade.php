<!doctype html>
<html lang="en">
  <head>
    <title>Calculs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
  <body>
    <div class="container">
        <div class="card text-left">
        <img class="card-img-top" src="https://www.compta-facile.com/wp-content/uploads/2016/03/actif-net-comptable-definition-calcul-interet.jpg" alt="">
        <div class="card-body">
            <h4 class="card-title">Calculs</h4>
            <div class="card-text">
                <form action="/cal/result" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="">CC1</label>
                      <input type="text"
                        class="form-control" name="cc1" id="cc1" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">N cc1</small>
                    </div>
                    <div class="form-group">
                        <label for="">CC2</label>
                        <input type="text"
                          class="form-control" name="cc2" id="cc2" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">N cc2</small>
                      </div>
                    <div class="form-group">
                    <hr> or
                      </div>
                      <div class="form-group">
                        <label for="">RCC</label>
                        <input type="text"
                          class="form-control" name="rcc" id="rcc" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">N Rcc</small>
                      </div>
                      <div class="form-group">
                        <label for="">RTP</label>
                        <input type="text"
                          class="form-control" name="RTP" id="RTP" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">RTP</small>
                      </div>
                      <div class="form-group">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </form>
                @if (isset($result))
                 <h1>Result : {{$result}}</h1>
                @endif
            </div>
        </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
