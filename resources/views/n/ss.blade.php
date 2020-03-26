<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($sn as $i)
    <p>
        <ul>
        <li>{{$i->note}}</li>
        <li>{{$i->student->nom}}</li>
        <li>{{$i->student->prenom}}</li>
        <li>{{$i->status['designation']}}</li>
        <li>{{$i->module->designation}}</li>
        <li></li>
        </ul>
    </p>
    @endforeach
</body>
</html>
