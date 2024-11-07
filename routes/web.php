<?php

use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;



Route::middleware(RoleMiddleware::class)->group(function () {
    // siswa
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/daftar-buku', [PageController::class, 'bukuSiswa'])->name('buku.index.siswa');
    Route::get('/peminjaman', [PageController::class, 'peminjaman'])->name('peminjaman.siswa');
    Route::get('/pengaturan', [PageController::class, 'pengaturanSiswa'])->name('pengaturan.index');
    Route::get('/update_pengaturan_siswa', [PageController::class, 'updatepengaturanSiswa']);
    Route::get('/pinjam/{id}', [PeminjamanController::class, 'store'])->name('action.pinjam');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });

    Route::middleware(CheckAdminMiddleware::class)->group(function () {
        Route::patch('user/{id}/update_profile', [UsersController::class, 'upload_profile'])->name('action.upload_profile');
        Route::match(['get', 'post'], '/anggota', function () {
            return 'Hallo, aku membuat route anggota dengan beberapa method';
        });

        Route::redirect('/buku', '/dashboard');
        Route::get('/', [RequestController::class, 'store']);
        Route::get('/nama', function () {
            $nama = session('nama');
            return 'Halaman nama dengan nama ' . $nama;
        });
        Route::get('/array', function () {
            return [1, 'Perpustakaan', true];
        });
        Route::get('/tes', function () {
            return redirect('/hello');
        });
        Route::get('/hello', function () {
            return response($content = 'Hallo Laravel')
                ->withHeaders([
                    'Content-Type' => 'text/html',
                    'X-Header-One' => 'Header Value 1',
                    'X-Header-Two' => 'Header Value 2',
                ]);
        });
        Route::get('/tes', function () {
            return redirect('/hello');
        });

        Route::get('/tes', function () {
            return redirect()->action([RoutesController::class, 'Dashboard']);
        });
        // Route::get('/login', [LoginController::class, 'login']);
        Route::get('/perpustakaan', [RoutesController::class, 'perpustakaan']);
        Route::get(
            '/book/create',
            function () {
                return view('create');
            }
        );

        Route::post('/book', [BukuController::class, 'store'])->name('store');
        Route::get('/bootstrap', function () {
            return view('bootstrap');
        });
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/admin', [PagesController::class, 'dashboardAdmin'])->name('dashboardAdmin');

        //admin
        Route::get('/daftar-buku-admin', [PageController::class, 'bukuAdmin'])->name('buku.index');
        Route::get('/kategori', [PageController::class, 'kategoriAdmin'])->name('kategori.index');
        Route::get('/penulis', [PageController::class, 'penulisAdmin'])->name('penulis.index');
        Route::get('/penerbit', [PageController::class, 'penerbitAdmin'])->name('penerbit.index');
        Route::get('/peminjaman-admin', [PageController::class, 'peminjamanAdmin'])->name('peminjaman.index');
        Route::get('/pengaturan-admin', [PageController::class, 'pengaturanAdmin'])->name('pengaturan.index');
        Route::get('/rak', [PageController::class, 'Rak'])->name('rak.index');
        Route::get('/raktable', [PageController::class, 'tableRak'])->name('rak.index');


        Route::get('/test', function () {
            return "false";
        })->name('update_penerbit');

        //admin
        Route::get('/tambah-buku', [PageController::class, 'tambahBuku']);
        Route::get('/edit-buku', [PageController::class, 'editBuku']);

        Route::get('/tambah-kategori', [PageController::class, 'tambahKategori'])->name('create_kategori');
        Route::get('/edit-kategori', [PageController::class, 'editKategori']);

        Route::get('/tambah-penulis', [PageController::class, 'tambahPenulis'])->name('create_penulis');
        Route::get('/edit-penulis', [PageController::class, 'editPenulis']);

        Route::get('/tambah-penerbit', [PageController::class, 'tambahPenerbit']);
        Route::get('/edit-penerbit', [PageController::class, 'editPenerbit']);

        Route::get('/admin_denda', [PageController::class, 'dendaPeminjaman']);
        Route::get('/edit-peminjaman/{peminjaman_id}', [PageController::class, 'editPeminjaman'])->name('updatepeminjamanadmin');

        Route::get('/admin_update_pengaturan', [PageController::class, 'editPengaturan']);

        Route::post('/createpenerbit', [PenerbitController::class, 'create'])->name('action.createpenerbit');

        Route::get('/createpenerbit', [PageController::class, 'createPenerbit'])->name('create_penerbit');
        //penerbit
        Route::get('/update_penerbit/{penerbit_id}', [PageController::class, 'editPenerbit'])->name('update_penerbit');
        Route::patch('/penerbit/{penerbit_id}', [PenerbitController::class, 'update'])->name('penerbit.update');

        Route::delete('/penerbit/{penerbit_id}', [PenerbitController::class, 'delete'])->name('penerbit.delete');
        //penulis
        Route::get('/update_penulis/{id}', [PageController::class, 'editPenulis'])->name('update_penulis');
        Route::post('/createpenulis', [PenulisController::class, 'create'])->name('action.createpenulis');
        Route::patch('/penulis/{penulis_id}', [PenulisController::class, 'update'])->name('penulis.update');

        Route::delete('/penulis/{penulis_id}', [PenulisController::class, 'delete'])->name('penulis.delete');

        //kategori
        Route::get('/update_kategori/{id}', [PageController::class, 'editKategori'])->name('update_kategori');
        Route::post('/createkategori', [KategoriController::class, 'create'])->name('action.createkategori');
        Route::patch('/kategori/{kategori_id}', [KategoriController::class, 'update'])->name('kategori.update');

        Route::delete('/kategori/{kategori_id}', [KategoriController::class, 'delete'])->name('kategori.delete');

        //rak
        Route::post('/createrak', [RakController::class, 'createRak'])->name('action.createrak');
        Route::get('/createrak', [PageController::class, 'tambahRak'])->name('create_rak');
        Route::get('/admin_update_rak/{id}', [PageController::class, 'admin_update_rak'])->name('update_rak');
        Route::patch('/rak/{id}', [RakController::class, 'update'])->name('rak.update');
        Route::delete('/rak/{rak_id}', [RakController::class, 'delete'])->name('rak.delete');

        //buku
        Route::post('/createbuku', [BukuController::class, 'createBuku'])->name('action.createbuku');
        Route::get('/createbuku', [PageController::class, 'tambahBuku'])->name('create_buku');
        Route::get('/admin_update_buku/{id}', [PageController::class, 'admin_update_buku'])->name('update_buku');
        Route::patch('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{buku_id}', [BukuController::class, 'delete'])->name('buku.delete');

        //peminjaman
        Route::controller(PeminjamanController::class)->group(function () {
            Route::put('/peminjaman/{id}', 'update')->name('action.update_peminjaman');
            Route::delete('/hapus-peminjaman/{peminjaman_id}', 'destroy')->name('action.delete_peminjaman');
        });
    });
});

// public / autentikasi
Route::get('/login', [PagesController::class, 'loginPage'])->name('login');
Route::get('/register', [PagesController::class, 'registerPage'])->name('register');
Route::post('/user/login', [UsersController::class, 'login'])->name('user.login');
Route::post('/user/register', [UsersController::class, 'register'])->name('user.register');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
