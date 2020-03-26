<!doctype html>
<html lang="en">
  <head>
    <title>MES NOTES</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.0/dist/sweetalert2.min.css">
    <style>
        html,
body {
	height: 100%;
}

body {
	margin: 0;
	background: linear-gradient(45deg, #49a09d, #5f2c82);
	font-family: sans-serif;
	font-weight: 100;
}
.elimi {
	margin: 0;
	background: linear-gradient(45deg, #a04984, #822c4d);
	font-family: sans-serif;
	font-weight: 100;

}
.betww {
    margin: 0;
	background: linear-gradient(45deg, #a09649, #78822c);
	font-family: sans-serif;
	font-weight: 100;
}

.container {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

table {
	width: 800px;
	border-collapse: collapse;
	overflow: hidden;
	box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

th,
td {
	padding: 15px;
	background-color: rgba(255,255,255,0.2);
	color: #fff;
}

th {
	text-align: left;
}

thead {
	th {
		background-color: #55608f;
	}
}

tbody {
	tr {
		&:hover {
			background-color: rgba(255,255,255,0.3);
		}
	}
	td {
		position: relative;
		&:hover {
			&:before {
				content: "";
				position: absolute;
				left: 0;
				right: 0;
				top: -9999px;
				bottom: -9999px;
				background-color: rgba(255,255,255,0.2);
				z-index: -1;
			}
		}
	}
}
.dataTables_length {
color: white;
}

.dataTables_filter {
color: white;
}
.dataTables_info{
    color: white;
}
      </style>
  </head>
  <body>
      <div class="container">
        <div class="col-md-12 text-center">
        <button type="button" id="upd" class="btn btn-primary pull-center">Check for updates</button>
        </div>
        <table id="notes" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>epreuve</th>
                    <th>ELEMENT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gnote as $key => $note)
                <tr>
                    <td>{{$note['date_creation']}}</td>
                    @if(! empty($note['note']))
                    <td>{{$note['note']}}</td>
                    @else
                    <td>ABS</td>
                    @endif
                    <td>{{$note['ac_epreuve_id']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.0/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
  // DataTable initialisation
  $('#notes').DataTable({
    "paging": true,
    "autoWidth": true,
    "createdRow": function( row, data, dataIndex){
                if( data[4] >=  10){
                    $(row).addClass();
                } else if( data[4] >=  7){
                    $(row).addClass('betww');
                }else if( data[4] < 7){
                    $(row).addClass('elimi');
                }
            },
    "columnDefs": [
      {
        "targets": 3,
        "render": function(data, type, full, meta) {
          var cellText = $(data).text(); //Stripping html tags !!!
          if (type === 'display' &&  (cellText == "Done" || data=='Done')) {
            var rowIndex = meta.row+1;
            var colIndex = meta.col+1;
            $('#notes tbody tr:nth-child('+rowIndex+')').addClass('lightRed');
            $('#notes tbody tr:nth-child('+rowIndex+') td:nth-child('+colIndex+')').addClass('red');
            return data;
          } else {
            return data;
          }
        }
      }
    ]
  });
});
    </script>
  </body>
</html>
