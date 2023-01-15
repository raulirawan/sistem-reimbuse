<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (json_decode($reimbuse->bukti_nota) != null)
        @foreach (json_decode($reimbuse->bukti_nota) as $value)
            <img src="{{ asset($value) }}">
        @endforeach
    @else
        <img src="{{ asset($reimbuse->bukti_nota) }}">

    @endif

</body>

</html>
