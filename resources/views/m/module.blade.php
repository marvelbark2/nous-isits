<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create modules</title>
</head>
<body>
    <form action="/m/create" method="post">
        @csrf
        <input type="text" name="module[]" id=""><br/>
        <input type="text" name="module[]" id=""><br/>
        <input type="text" name="module[]" id=""><br/>
        <input type="text" name="module[]" id=""><br/>
        <input type="text" name="module[]" id=""><br/>
        <input type="text" name="module[]" id=""><br/>
        <button type="submit">done</button>
    </form>
</body>
</html>
