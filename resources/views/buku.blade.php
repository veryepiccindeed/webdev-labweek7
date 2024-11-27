<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
</head>
<body>
    <h1>Manajemen Buku</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form untuk tombol sorting -->
    <form action="/buku" method="GET">
        @php $sort = request('sort', 'asc'); @endphp <!-- Default ke 'asc' -->

        <button type="submit" name="sort" value="asc" {{ $sort === 'asc' ? 'disabled' : '' }}>Ascending Tahun Terbit</button>
        <button type="submit" name="sort" value="desc" {{ $sort === 'desc' ? 'disabled' : '' }}>Descending Tahun Terbit</button>
    </form>

    <!-- Form untuk menambah atau mengedit Buku -->
    <h2>{{ isset($editBuku) ? 'Edit Buku' : 'Tambah Buku' }}</h2>
    <form action="{{ isset($editBuku) ? route('buku.update', $editBuku->id) : route('buku.store') }}" method="POST">
        @csrf
        @if(isset($editBuku))
            @method('PUT')
        @endif

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $editBuku->judul ?? '') }}" required>

        <label for="tahun_terbit">Tahun Terbit:</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $editBuku->tahun_terbit ?? '') }}" required min="1900" max="{{ date('Y') }}">

        <label for="penerbit">Penerbit:</label>
        <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $editBuku->penerbit ?? '') }}" required>

        <label for="penulis">Penulis:</label>
        <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $editBuku->penulis ?? '') }}" required>

        <label for="jumlah_halaman">Jumlah Halaman:</label>
        <input type="number" name="jumlah_halaman" id="jumlah_halaman" value="{{ old('jumlah_halaman', $editBuku->jumlah_halaman ?? '') }}" required min="1">

        <button type="submit">{{ isset($editBuku) ? 'Update' : 'Simpan' }}</button>
    </form>

    <!-- Tabel Data Buku -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun Terbit</th>
                <th>Penerbit</th>
                <th>Penulis</th>
                <th>Jumlah Halaman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus->sortBy('tahun_terbit', SORT_REGULAR, $sort === 'desc') as $buku)
                <tr>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->tahun_terbit }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->jumlah_halaman }}</td>
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>