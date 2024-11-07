@extends('template.layout')

@if ($level == 'admin')
    @section('title', 'Daftar Buku - Admin Perpustakaan')
@elseif($level == 'siswa')
    @section('title', 'Daftar Buku - Perpustakaan')
@endif

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
    <div id="layoutSidenav">
        @include('template.sidebar_admin')
        <div id="layoutSidenav_content">
            <main>
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Kategori Buku</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Halaman Tambah Kategori Buku</li>
                        </ol>
                        <form action="{{ route('action.createkategori') }}" class="row my-4 gap-3" method="post">
                            @csrf
                            <div class="row gap-3">
                                <div class="col-12 col-md-4 form-group">
                                    <label for="judul_buku" class="form-label">Nama *</label>
                                    <input type="text" name="nama" id="judul_buku" class="form-control" placeholder="Masukkan nama">
                                </div>
    
                            </div>
                            <div class="row my-3">
                                <div class="col-12 col-md-4">
                                    <button class="btn btn-primary">Tambahkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Web Perpustakaan 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
@endsection