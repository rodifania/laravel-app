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
                <h1 class="mt-4">Pengaturan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Halaman Pengaturan Akun</li>
                </ol>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="d-flex items-center gap-4">
                    @if ($user->user_pict_url === '')
                    <img style="width: 160px; height: 160px;" scr="{{ asset('img/placeholder.png') }}" alt="..." class="rounded-circle img-profile img-thumbnail">
                    @else
                    <img style="width: 160px; height: 160px;" src="{{ asset('storage/profile_pictures/'.basename($user->user_pict_url)) }}" alt="..." class="rounded-circle img-profile img-thumbnail">
                    @endif
                    {{-- Upload Profile Form --}}
                    <form action="{{ route('action.upload_profile', ['id' => $user->user_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="profile" class="form-label">Upload Profile</label>
                            <input type="file" name="profile" id="profile" class="form-control">
                        </div>
                        <div class="form-group my-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        @include('template.footer')
    </div>
</div>
@endsection