<!-- resources/views/cd.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar CD</title>
</head>
<body>
    <h1>Daftar CD</h1>

    <!-- Form untuk tombol sorting -->
    <form action="/cd" method="GET">
        @php $sort = request('sort', 'asc'); @endphp <!-- Default ke 'asc' -->

        <button type="submit" name="sort" value="asc" {{ $sort === 'asc' ? 'disabled' : '' }}>Ascending Tahun Terbit</button>
        <button type="submit" name="sort" value="desc" {{ $sort === 'desc' ? 'disabled' : '' }}>Descending Tahun Terbit</button>
    </form>

    <!-- Tabel Data CD -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun Terbit</th>
                <th>Penerbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cds->sortBy('tahun_terbit', SORT_REGULAR, $sort === 'desc') as $cd)
                <tr>
                    <td>{{ $cd->judul }}</td>
                    <td>{{ $cd->tahun_terbit }}</td>
                    <td>{{ $cd->penerbit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
