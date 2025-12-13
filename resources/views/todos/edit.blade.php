<!DOCTYPE html>
<html>
<head>
    <title>Edit Todo</title>
</head>
<body>

<h2>Edit Todo</h2>

<form method="POST" action="/todos/{{ $todo->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $todo->title }}" required>
    <button type="submit">Update</button>
</form>

<a href="/todos">Kembali</a>

</body>
</html>
