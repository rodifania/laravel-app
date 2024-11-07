<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\PeminjamanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function bukuAdmin()
    {
        $buku_all = DB::table('buku')
            ->join('penulis', 'buku.buku_penulis_id', '=', 'penulis.penulis_id')
            ->join('kategori', 'buku.buku_kategori_id', '=', 'kategori.kategori_id')
            ->join('rak', 'buku.buku_rak_id', '=', 'rak.rak_id')
            ->join('penerbit', 'buku.buku_penerbit_id', '=', 'penerbit.penerbit_id')
            ->select('buku.*', 'penulis.penulis_nama', 'kategori.kategori_nama', 'rak.rak_nama', 'rak.rak_lokasi', 'penerbit.penerbit_nama')
            ->paginate(3);

        // return $buku_all;
        // $buku_all = Buku::with(['penulis', 'kategori', 'penerbit', 'rak'])->get();
        // $buku_fk = $buku_all->map(function ($buku) {
        //     return [
        //         'buku_id' => $buku->buku_id,
        //         'buku_judul' => $buku->buku_judul,
        //         'buku_isbn' => $buku->buku_isbn,
        //         'buku_thnterbit' => $buku->buku_thnterbit,
        //         'buku_penulis' => $buku->penulis->penulis_nama,
        //         'buku_kategori' => $buku->kategori->kategori_nama,
        //         'buku_penerbit' => $buku->penerbit->penerbit_nama,
        //         'buku_rak' => $buku->rak->rak_lokasi,
        //     ];
        // });

        // return $buku_fk;
        return view('buku', ['level' => 'admin', 'buku_data' => $buku_all]);
    }

    public function kategoriAdmin()
    {
        $data = Kategori::readKategori();
        return view('kategori', [
            'level' => 'admin',
            'kategoris' => $data,
        ]);
    }

    public function penulisAdmin()
    {
        $data = Penulis::readPenulis();
        return view('penulis', [
            'level' => 'admin',
            'penulis_data' => $data,
        ]);
    }

    public function penerbitAdmin()
    {
        $data = Penerbit::readPenerbit();

        return view('penerbit', [
            'level' => 'admin',
            'penerbits' => $data,
        ]);
    }

    public function peminjamanAdmin()
    {
        $peminjaman_all = Peminjaman::with(['user', 'peminjamanDetail', 'buku'])->get();

        // return $peminjaman_all;
        return view('peminjaman', ['level' => 'admin', 'peminjaman' => $peminjaman_all]);
    }

    public function pengaturanAdmin()
    {
        $user = Auth::user();
        return view('pengaturan_admin', ['level' => 'admin', 'user' => $user]);
    }

    //siswa
    public function bukuSiswa()
    {
        $buku = Buku::with(['penulis'])->get();

        // return $buku;

        return view('buku_siswa', ['level' => 'siswa', 'buku' => $buku]);
    }

    public function peminjaman()
    {
        $user_id = "user123";

        $peminjaman = PeminjamanDetail::with(['peminjaman_content', 'buku_content'])
            ->whereHas(
                'peminjaman_content',
                function ($query) use ($user_id) { // use adalah menggunakan variabel $user_id di atas karena di function ini tertutup
                    return $query->where('peminjaman_user_id', $user_id);
                }
            )->get();

        // return $peminjaman;

        return view('peminjaman_siswa', [
            'level' => 'siswa',
            'peminjaman' => $peminjaman
        ]);
    }

    public function pengaturanSiswa()
    {
        return view('pengaturan_siswa', ['level' => 'siswa']);
    }

    public function updatepengaturanSiswa()
    {
        return view('update_pengaturan_siswa', ['level' => 'siswa']);
    }

    public function tambahBuku()
    {
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $rak = Rak::all();
        return view('admin_tambah_buku', ['level' => 'admin', 'penulis' => $penulis, 'penerbit' => $penerbit, 'kategori' => $kategori, 'rak' => $rak]);
    }
    public function admin_update_buku($id)
    {
        $buku = Buku::with('penulis', 'kategori', 'penerbit', 'rak')->where('buku_id', $id)->first();
        // dd($buku->toArray());
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $rak = Rak::all();
        return view('admin_update_buku', ['level' => 'admin', 'penulis' => $penulis, 'penerbit' => $penerbit, 'kategori' => $kategori, 'rak' => $rak, 'buku' => $buku]);
    }
    public function tambahKategori()
    {
        return view('admin_tambah_kategori', ['level' => 'admin']);
    }

    public function editKategori($id)
    {

        $data = Kategori::readKategoriById($id);

        // return $data;
        return view('admin_update_kategori', [
            'level' => 'admin',
            'kategori' => $data,
        ]);
    }

    public function tambahPenulis()
    {
        return view('admin_tambah_penulis', ['level' => 'admin']);
    }

    public function editPenulis()
    {
        return view('admin_update_penulis', ['level' => 'admin']);
    }

    public function tambahPenerbit()
    {
        return view('admin_tambah_penerbit', ['level' => 'admin']);
    }

    public function editPenerbit($id)
    {
        $data = Penerbit::where('penerbit_id', $id)->first();

        // return $data;


        return view('admin_update_penerbit', [
            'level' => 'admin',
            'penerbit' => $data
        ]);
    }

    public function dendaPeminjaman()
    {
        return view('admin_denda', ['level' => 'admin']);
    }

    public function editPeminjaman($peminjaman_id)
    {
        $peminjaman_edit = Peminjaman::with(['user', 'peminjamanDetail', 'buku'])->where('peminjaman_id', $peminjaman_id)->first();

        // return $peminjaman_edit;

        return view('admin_update_peminjaman', ['level' => 'admin', 'peminjaman' => $peminjaman_edit]);
    }

    public function editPengaturan()
    {
        return view('admin_update_pengaturan', ['level' => 'admin']);
    }

    public function penerbit()
    {
        $data = Penerbit::readPenerbit();

        return view('pages.penerbit', [
            'level' => 'admin',
            'data' => $data
        ]);
    }

    public function update_penerbit($id)
    {
        $penerbit = Penerbit::readPenerbitById($id);

        return view('actions.penerbit.update_penerbit', ['level' => 'admin'])->with('penerbit', $penerbit);
    }

    public function penulis()
    {
        $data = Penerbit::readPenulis();

        return view('pages.penulis', [
            'level' => 'admin',
            'data' => $data
        ]);
    }

    public function update_penulis($id)
    {
        $penulis = Penulis::readPenerbitById($id);

        return view('actions.penulis.update_penulis', ['level' => 'admin'])->with('penulis', $penulis);
    }

    public function Kategori()
    {
        $data = Kategori::all();

        // return $data;

        return view('pages.kategori', [
            'level' => 'admin',
            'kategori' => $data
        ]);
    }

    public function update_kategori($id)
    {
        $kategori = Kategori::readkategoriById($id);

        return view('actions.kategori.update_kategori', ['level' => 'admin'])->with('kategori', $kategori);
    }


    public function Rak()
    {
        // $data = Rak::all();

        // return $data;

        return view('create_rak', [
            'level' => 'admin',
        ]);
    }

    public function tableRak()
    {
        $data = Rak::readRak();

        return view('rak', ['level' => 'admin', 'rak_data' => $data]);
    }

    public function tambahrak()
    {
        return view('create_rak', ['level' => 'admin']);
    }

    public function admin_update_rak($id)
    {

        $rak = Rak::readRakById($id);
        return view('update_rak', ['level' => 'admin', 'rak' => $rak]);
    }
}

$user_id = "user123";

$peminjaman = PeminjamanDetail::with(['peminjaman_content', 'buku_content'])
    ->whereHas(
        'peminjaman_content',
        function ($query) use ($user_id) { // use adalah menggunakan variabel $user_id di atas karena di function ini tertutup
            return $query->where('peminjaman_user_id', $user_id);
        }
    )->get();

// return $peminjaman;

return view('peminjaman', [
    'level' => 'siswa',
    'data' => $peminjaman
]);
