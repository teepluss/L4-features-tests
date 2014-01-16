<html>
    <head></head>
    <body>
        {{ Form::open(array('files' => true)) }}

        <p>{{ Form::file('userfile') }}</p>
        <p>{{ Form::submit() }}</p>

        {{ Form::close() }}
    </body>
</html>