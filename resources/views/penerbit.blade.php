@extends('template.layout')

@section('title', 'Halaman Penerbit')

@section('header')
    @include('template.navbar_admin')
@endsection

@section('main')
    <div id="layoutSidenav">
        @include('template.sidebar_admin')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Penerbit</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Halaman Data Penerbit</li>
                    </ol>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('updated'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('updated') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <!-- </a> -->
                    @elseif (session('deleted'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('deleted') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <a href="/tambah-penerbit" class="btn btn-primary my-3">Tambah Penerbit</a>
                    <div class="table-responsive">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="row">No</th>
            <th scope="row">Nama Penerbit</th>
            <th scope="row">Alamat Penerbit</th>
            <th scope="row">No Telp Penerbit</th>
            <th scope="row">Email Penerbit</th>
            <th scope="row">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penerbits as $penerbit)    
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $penerbit->penerbit_nama }}</td>
            <td>{{ $penerbit->penerbit_alamat }}</td>
            <td>{{ $penerbit->penerbit_notelp }}</td>
            <td>{{ $penerbit->penerbit_email }}</td>
            <td class="d-flex align-items-center gap-2">
                <a href="{{ route('update_penerbit', ['penerbit_id' => $penerbit->penerbit_id]) }}">
                    <button class="btn btn-warning"><i class="fas fa-pencil"></i></button>
                </a>
                <form action="{{ route('penerbit.delete', ['penerbit_id' => $penerbit->penerbit_id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $penerbits->links() }}
                    </div>
                </div>
            </main>
            @include('template.footer')
        </div>
    </div>
@endsection
