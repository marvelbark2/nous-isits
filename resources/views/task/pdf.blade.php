<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.css" media="screen">
    <link rel="stylesheet" href="https://bootswatch.com/_assets/css/custom.min.css">
    <style>
            body {
                font-family: 'examplefont', sans-serif;
            }
            @page {
                header: page-header;
                footer: page-footer;
            }
    </style>
</head>
<body>
        <htmlpageheader name="page-header">
                TEST HEADER
        </htmlpageheader>

        <htmlpagefooter name="page-footer">
                TEST FOOTER
        </htmlpagefooter>
        <table class="table">
                <tr>
                  <th>Titre:</th>
                  <td>{{$tache->title}}</td>
                </tr>
                <tr>
                  <th>Deadline:</th>
                <td><h6><span class="text-seconde">
                    {{$tache->deadline->formatLocalized('%A %d %B %Y')}}
                    </span></h6></td>
                </tr>
                <tr>
                  <th>Cree par:</th>
                  <td>{{$tache->user->name}}</td>
                </tr>
                <tr>
                  <th>Affectee a:</th>
                  <td>{{$tache->assigned['name']}}</td>
                </tr>
                <tr>
                    <th>Progression:</th>
                    <td>
                        {{$tache->status}} %
                    </td>
                </tr>
              </table>
</body>
</html>
