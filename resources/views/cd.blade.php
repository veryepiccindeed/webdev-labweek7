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

    <!-- Form untuk menambah atau mengedit CD -->
    <h2>{{ isset($cd) ? 'Edit CD' : 'Tambah CD' }}</h2>
    <form action="{{ isset($cd) ? route('cd.update', $cd->id) : route('cd.store') }}" method="POST">
        @csrf
        @if(isset($cd))
            @method('PUT')
        @endif

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $cd->judul ?? '') }}" required>

        <label for="tahun_terbit">Tahun Terbit:</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $cd->tahun_terbit ?? '') }}" required>

        <label for="penerbit">Penerbit:</label>
        <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $cd->penerbit ?? '') }}" required>

        <button type="submit">{{ isset($cd) ? 'Update' : 'Simpan' }}</button>
    </form>

    <!-- Tabel Data CD -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun Terbit</th>
                <th>Penerbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cds->sortBy('tahun_terbit', SORT_REGULAR, $sort === 'desc') as $cd)
                <tr>
                    <td>{{ $cd->judul }}</td>
                    <td>{{ $cd->tahun_terbit }}</td>
                    <td>{{ $cd->penerbit }}</td>
                    <td>
                        <a href="{{ route('cd.edit', $cd->id) }}">Edit</a>
                        <form action="{{ route('cd.destroy', $cd->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus CD ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
