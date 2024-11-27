<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
</head>
<body>
    <h1>Peminjaman Item</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Borrowed Items</h2>
<ul>
    @if(isset($borrowings) && $borrowings->isEmpty())
        <li>No borrowed items.</li>
    @elseif(isset($borrowings))
        @foreach($borrowings as $borrowing)
            <li>
                @if($borrowing->jenis_item === 'Buku')
                    {{ $borrowing->buku->judul }} - ID: {{ $borrowing->item_id }} (Borrowed until: {{ $borrowing->dipinjam_sampai }})
                @elseif($borrowing->jenis_item === 'CD')
                    {{ $borrowing->cd->judul }} - ID: {{ $borrowing->item_id }} (Borrowed until: {{ $borrowing->dipinjam_sampai }})
                @elseif($borrowing->jenis_item === 'Jurnal')
                    {{ $borrowing->jurnal->judul }} - ID: {{ $borrowing->item_id }} (Borrowed until: {{ $borrowing->dipinjam_sampai }})
                @else
                    Unknown item type.
                @endif
            </li>
        @endforeach
    @else
        <li>Error retrieving borrowed items.</li>
    @endif
</ul>

    <h2>Borrow an Item</h2>
    <form action="{{ route('peminjaman.borrow') }}" method="POST">
        @csrf
        <label for="item_id">Item ID:</label>
        <input type="text" name="item_id" id="item_id" required>

        <label for="jenis_item">Item Type:</label>
        <select name="jenis_item" id="jenis_item" required>
            <option value="Buku">Buku</option>
            <option value="CD">CD</option>
            <option value="Jurnal">Jurnal</option>
        </select>

        <button type="submit">Borrow</button>
    </form>
</body>
</html> 