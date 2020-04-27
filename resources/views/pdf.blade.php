<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<table>
    <tr>
        <th>Artista</th>
        <th>Cache</th>
        <th>Início Evento</th>
        <th>Fim Evento</th>
        <th>Estilo Musical</th>
    </tr>
    @foreach($show as $item)
        <tr>
            <td>{{$item->artistic_name}}</td>
            <td>{{$item->cache}}</td>
            <td>{{date('d/m/Y', strtotime($item->start))}}</td>
            <td>{{date('d/m/Y', strtotime($item->end))}}</td>
            <td>{{$item->music_styles->name_style}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
