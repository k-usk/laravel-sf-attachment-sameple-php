<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ファイル取得サンプル</title>
    </head>
    <body>
    <div>
        @foreach($result['files'] as $file)
            <a href="/downloadfile?id={{ $file['id'] }}">{{ $file['name'] }} をダウンロード</a> ({{ $file['size'] }} byte : {{ $file['type'] }})<br>
        @endforeach
    </div>
    </body>
</html>
