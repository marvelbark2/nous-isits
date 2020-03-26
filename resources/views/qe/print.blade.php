
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{$m_id->matiere}} - QE</title>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css'>
<style>
    .page-break {
    page-break-after: always;
}
     h1 span {
        color: #fff;
        background-color: #446688;
        padding: 1px 5px 3px 5px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .well-link {
    text-decoration: none;
}

</style>
</head>
<body translate="no">

<div class="container">
    <div class="row">

<h1>QE: <span>{{$m_id->matiere}}</span></h1>
<br>
<?php $i=0 ?>
@forelse ($m_id->qe as $qe)
<?php $i++ ?>
<div class="col-md-12">
<div class="well-link">
<div class="panel panel-default panel-shadow">
<div class="panel-heading">
<strong>{{$qe->questionn}}</strong>
</div>
<div class="panel-body">
    {!! $qe->content !!}
  </div>
</div>
</div>
</div>
<hr>
<?php
if( $i % 2 == 0 ){
    echo '<div class="page-break"></div>';
}
?>
@empty
<p class="text text-center"> No Qe in this matiere exist </p>
@endforelse
</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</body>
</html>
