<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rak extends Model
{
    use HasFactory;
    protected $table = 'rak';
    protected $primaryKey = 'rak_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'rak_id',
        'rak_nama',
        'rak_lokasi',
        'rak_kapasitas',
    ];

    protected static function createRak($data)
    {
        return self::create($data);
    }

    protected static function readRak()
    {
        $data = DB::table('rak')->paginate(5);

        return $data;
    }

    public static function deleteRak($id)
    {
        Rak::where('rak_id', $id)->delete();
    }

    public static function editRak($id)
    {
        Rak::where('rak_id', $id)->delete();
    }

    protected static function readRakById ($id)
{
    $rak = self::find($id);

    return $rak;
}

protected static function updateRak ($id, $data)
{
    $rak = self::find($id);

    if ($rak) {
        $rak->update($data);
        return $rak;
    }

    return null;
}

}
