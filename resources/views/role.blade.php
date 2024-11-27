<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role</title>
</head>
<body>
    <h1>Pilih Role Anda</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('role.store') }}" method="POST">
        @csrf
        @foreach($roles as $key => $role)
            <label>
                <input type="radio" name="role" value="{{ $key }}" required> {{ $role }}
            </label>
            <br>
        @endforeach
        <button type="submit">Pilih</button>
    </form>
</body>
</html>