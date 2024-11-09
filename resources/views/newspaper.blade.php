<!-- resources/views/final-year-projects.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Newspaper</title>
    <style>
        .sort-button {
            margin-right: 10px;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
        }
        .sort-button.active {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Daftar Newspaper</h1>

    <!-- Tombol Sorting -->
    <form action="/newspaper" method="GET">
        @php $sort = request('sort', 'asc'); @endphp <!-- Default ke 'asc' -->

        <button type="submit" name="sort" value="asc" {{ $sort === 'asc' ? 'disabled' : '' }}>Ascending Tahun Terbit</button>
        <button type="submit" name="sort" value="desc" {{ $sort === 'desc' ? 'disabled' : '' }}>Descending Tahun Terbit</button>
    </form>

    <!-- Tabel Data Final Year Project -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun Terbit</th>
                <th>Penerbit</th>
                <th>Penulis</th>
                <th>Halaman</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($newspapers->sortBy('tahun_terbit', SORT_REGULAR, $sort === 'desc') as $newspaper)
                <tr>
                    <td>{{ $newspaper->judul }}</td>
                    <td>{{ $newspaper->tahun_terbit }}</td>
                    <td>{{ $newspaper->penerbit }}</td>
                    <td>{{ $newspaper->penulis }}</td>
                    <td>{{ $newspaper->jumlah_halaman }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
