<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Buku</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Form Tambah Buku</h1>
    <form action="/book" method="POST">
        @csrf
        <div>
            <label for="kode_buku">Kode Buku:</label>
            <input type="text" id="kode_buku" name="kode_buku" value="{{ old('kode_buku') }}">
            @error('kode_buku')
                <div>{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="nama_buku">Nama Buku:</label>
            <input type="text" id="nama_buku" name="nama_buku" value="{{ old('nama_buku') }}">
            @error('nama_buku')
                <div>{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="penerbit_buku">Penerbit Buku:</label>
            <input type="text" id="penerbit_buku" name="penerbit_buku" value="{{ old('penerbit_buku') }}">
            @error('penerbit_buku')
                <div>{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="text" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
            @error('tahun_terbit')
                <div>{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label for="penulis_buku">Penulis Buku:</label>
            <input type="text" id="penulis_buku" name="penulis_buku" value="{{ old('penulis_buku') }}">
            @error('penulis_buku')
                <div>{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit">Simpan Buku</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
