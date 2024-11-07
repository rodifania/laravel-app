<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penerbit extends Model
{
    use HasFactory;
    protected static function createPenerbit($data)
    {
        return DB::table('penerbit')->insert($data);
    }

    protected $table = 'penerbit';
    protected $primaryKey = 'penerbit_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'penerbit_id',
        'penerbit_nama',
        'penerbit_alamat',
        'penerbit_notelp',
        'penerbit_email',
    ];

    protected static function readPenerbit()
    {
        $data = self::paginate(5);

        return $data;
    }
    protected static function updatePenerbit($id, $data)
    {
        $penerbit = DB::table('penerbit')->where('penerbit_id', $id)->first();

        if ($penerbit) {
            DB::table('penerbit')->where('penerbit_id', $id)->update($data);
            return $data;
        }

        return null;
    }

    protected static function readPenerbitById($id)
    {
        $penerbit = DB::table('penerbit')->where('penerbit_id', $id)->first();

        return $penerbit;
    }

    protected static function deletePenerbit($id)
    {
        return DB::table('penerbit')->where('penerbit_id', $id)->delete();
    }
}
