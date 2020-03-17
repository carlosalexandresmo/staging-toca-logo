<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table>

    </table>
    @foreach($show as $item)
        <p>{{$item->artistic_name}}</p>
    @endforeach
</body>
</html>
