<!-- resources/views/mails/test.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Correo de Prueba</title>
</head>
<body>
    @if ($url)
        <p><a href="{{ $url }}">Click me</a></p>
    @else
        <p><a href="{{ route('mails.signed') }}">Click me</a></p>
    @endif
</body>
</html>
