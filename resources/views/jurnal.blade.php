<!-- resources/views/jurnal.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar jurnal</title>
</head>
<body>
    <h1>Daftar jurnal</h1>

    <!-- Form untuk tombol sorting -->
    <form action="/jurnal" method="GET">
        @php $sort = request('sort', 'asc'); @endphp <!-- Default ke 'asc' -->

        <button type="submit" name="sort" value="asc" {{ $sort === 'asc' ? 'disabled' : '' }}>Ascending Tahun Terbit</button>
        <button type="submit" name="sort" value="desc" {{ $sort === 'desc' ? 'disabled' : '' }}>Descending Tahun Terbit</button>
    </form>

     <!-- Form untuk menambah atau mengedit Jurnal -->
     <h2>{{ isset($jurnal) ? 'Edit Jurnal' : 'Tambah Jurnal' }}</h2>
    <form action="{{ isset($jurnal) ? route('jurnal.update', $jurnal->id) : route('jurnal.store') }}" method="POST">
        @csrf
        @if(isset($jurnal))
            @method('PUT')
        @endif

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $jurnal->judul ?? '') }}" required>

        <label for="tahun_terbit">Tahun Terbit:</label>
        <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit', $jurnal->tahun_terbit ?? '') }}" required min="1900" max="{{ date('Y') }}">

        <label for="penerbit">Penerbit:</label>
        <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit', $jurnal->penerbit ?? '') }}" required>

        <label for="penulis">Penulis:</label>
        <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $jurnal->penulis ?? '') }}" required>

        <label for="jumlah_halaman">Jumlah Halaman:</label>
        <input type="number" name="jumlah_halaman" id="jumlah_halaman" value="{{ old('jumlah_halaman', $jurnal->jumlah_halaman ?? '') }}" required min="1">

        <button type="submit">{{ isset($jurnal) ? 'Update' : 'Simpan' }}</button>
    </form>

    <!-- Tabel Data jurnal -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun Terbit</th>
                <th>Penerbit</th>
                <th>Penulis</th>
                <th>Halaman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurnals->sortBy('tahun_terbit', SORT_REGULAR, $sort === 'desc') as $jurnal)
                <tr>
                    <td>{{ $jurnal->judul }}</td>
                    <td>{{ $jurnal->tahun_terbit }}</td>
                    <td>{{ $jurnal->penerbit }}</td>
                    <td>{{ $jurnal->penulis}}</td>
                    <td>{{ $jurnal->jumlah_halaman}}</td>
                    <td>
                        <a href="{{ route('jurnal.edit', $jurnal->id) }}">Edit</a>
                        <form action="{{ route('jurnal.destroy', $jurnal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus jurnal ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
