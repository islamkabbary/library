<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
</head>

<body>

    @foreach ($books as $book)
        <h1>{{ $books->title }}</h1>
        <p>{{ $books->decs }}</p>
    @endforeach


</body>

</html>
