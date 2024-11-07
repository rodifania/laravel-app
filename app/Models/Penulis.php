<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penulis

extends Model
{
    use HasFactory;
    protected $table = 'penulis';
    protected $primaryKey = 'penulis_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'penulis_id',
        'penulis_nama',
        'penulis_tmptlahir',
        'penulis_tgllahir',
    ];
    protected static function createPenulis($data)
    {
        return self::create($data);
    }
    protected static function readPenulis()
    {
        $data = DB::table('penulis')->paginate(5);

        return $data;
    }

    protected static function updatePenulis($id, $data)
    {
        $penulis = self::find($id);

        if ($penulis) {
            $penulis->update($data);
            return $penulis;
        }

        return null;
    }

    protected static function readPenulisById($id)
    {
        $penulis = self::find($id);

        return $penulis;
    }

    protected static function deletePenulis($id)
    {
        return self::destroy($id);
    }
}
