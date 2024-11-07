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
                    <h1 class="mt-4">Denda</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Halaman Denda</li>
                    </ol>
                    <form action="">
                        <div class="row gap-3">
                            <div class="col-12 col-md-4 form-group">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="catatan">Catatan:</label>
                                        <textarea class="form-control" id="catatan" name="catatan" rows="4" required></textarea>
                                    </div>
            
                                    <div class="form-group">
                                        <label for="denda">Denda (Rp):</label>
                                        <input type="number" class="form-control" id="denda" name="denda" min="0" step="1000" required>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-warning">Denda</button>
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