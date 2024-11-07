<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorebookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'kode_buku' => 'required|max:4',
            'nama_buku' => 'required|min:10|max:40',
            'penerbit_buku' => 'required|min:10|max:40',
            'tahun_terbit' => 'nullable|digits:4',
            'penulis_buku' => 'required|min:10|max:40',
        ];
    }
    
    public function messages()
    {
        return [
            'kode_buku.required' => 'Kode Buku wajib diisi.',
            'kode_buku.max' => 'Kode Buku maksimal 4 huruf.',
            'nama_buku.required' => 'Nama Buku wajib diisi.',
            'nama_buku.min' => 'Nama Buku minimal 10 huruf.',
            'nama_buku.max' => 'Nama Buku maksimal 40 huruf.',
            'penerbit_buku.required' => 'Penerbit Buku wajib diisi.',
            'penerbit_buku.min' => 'Penerbit Buku minimal 10 huruf.',
            'penerbit_buku.max' => 'Penerbit Buku maksimal 40 huruf.',
            'tahun_terbit.digits' => 'Tahun Terbit harus 4 angka.',
            'penulis_buku.required' => 'Penulis Buku wajib diisi.',
            'penulis_buku.min' => 'Penulis Buku minimal 10 huruf.',
            'penulis_buku.max' => 'Penulis Buku maksimal 40 huruf.',
        ];
    }
    

}
