<!DOCTYPE html>
<html>
<head>
    <title>Import Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Importing products's data from CSV <i class="fas fa-file-csv"></i> file
        </div>
        <div class="card-body">
            <form action="{{ route('prod-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <button type="submit" class="btn btn-primary">Submit</button>
                <br>
            </form>
        </div>
    </div>
</div>
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
</body>
</html>
