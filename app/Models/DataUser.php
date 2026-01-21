<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dataUser';

    protected $primaryKey = 'id';

    protected $fillable = [
         'userid','nama_pembeli','no_ktp_pembeli','tempat_lahir_pembeli','tanggal_lahir_pembeli','alamat_pembeli','provinsi','kota','kecamatan','kelurahan','no_telepon_pembeli','no_handphone_pembeli','email_pembeli','dealer','metode_pembayaran','stnk_nama_pemakai','stnk_no_ktp','stnk_tempat_lahir','stnk_tanggal_lahir','stnk_alamat','stnk_provinsi','stnk_kecamatan','stnk_kelurahan','stnk_no_telepon','stnk_no_handphone','stnk_email'
    ];

    /**
     * Get the user that owns the userSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->hasOne(User::class, 'userid', 'id');
    }
    public function village()
    {
        return $this->BelongsTo(Village::class, 'kelurahan', 'code');
    }
    public function dealer()
    {
        return $this->hasMany(ListDelear::class, 'dealer', 'id');
    }
}
