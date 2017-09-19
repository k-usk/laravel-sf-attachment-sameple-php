<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ファイル送信サンプル</title>

</head>
<body>

<div>
    {{ Form::open(['files' => true]) }}

    <p>{{ Form::label('title', 'タイトル') }}{{ Form::text('title') }}</p>
    <p>{{ Form::label('message', ' 本文') }}{{ Form::textarea('message') }}</p>

    <p>{{ Form::file('temp_file1') }}</p>
    <p>{{ Form::file('temp_file2') }}</p>
    <p>{{ Form::file('temp_file3') }}</p>
    <p>{{ Form::file('temp_file4') }}</p>
    <p>{{ Form::file('temp_file5') }}</p>

    <p>{{ Form::submit() }}</p>
    {{ Form::close() }}
</div>

</body>
</html>
