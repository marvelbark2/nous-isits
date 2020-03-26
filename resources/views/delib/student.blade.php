<!doctype html>
<html lang="en">
  <head>
  <title>{{$stu->nom ?? 'Nom etu'}} {{$stu->prenom ?? 'Prenom etd'}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="container-fluid">
            <table class="table table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Module</th>
                        <th>Element</th>
                        <th>Note d'element</th>
                        <th>Statut d'element</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($mno as $item)
                            @php
                                $elem_code = \DB::connection('mysql2')->table('ac_element')->where('code_module', $item->module->code)->get();
                                $elem = \App\ExEnotes::wherein('code_element', $elem_code->code)->get();
                            @endphp
                        @foreach ($elem_code as $key=>$it)
                            @if ($key == '0')
                                <tr>
                                    <td class="align-middle" rowspan="{{count($elem)}}">{{$item->module->designation}}</td>
                                    <td>{{$it->designation}}</td>
                                    <td>{{$ne->where('code_element', $$it->code)->note}}</td>
                                    <td>{{$ne->where('code_element', $$it->code)->statut_def}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{$item->status->abreviation}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$it->designation}}</td>
                                    <td>{{$ne->where('code_element', $$it->code)->note}}</td>
                                    <td>{{$ne->where('code_element', $$it->code)->statut_def}}</td>
                                    <td>{{$item->note}}</td>
                                    <td>{{$item->status->abreviation}}</td>
                                </tr>
                            @endif
                            @endforeach

                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
