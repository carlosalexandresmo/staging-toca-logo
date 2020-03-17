<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<table>
    <tr>
        <th>Nome</th>
    </tr>
    @foreach($show as $item)
        <tr>
            <td>{{$item->artistic_name}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
