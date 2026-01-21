<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListPesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'list_pesanan';

    protected $primaryKey = 'id';

    protected $fillable = [
         'userid','produkid','delearid','status','keterangan'
    ];


    public function datauser()
    {
        return $this->hasOne(DataUser::class, 'userid', 'id');
    }

    public function produk()
    {
        return $this->hasOne(ListProduk::class, 'produkid', 'id');
    }

    public function delear()
    {
        return $this->hasOne(ListDelea::class, 'delearid', 'id');
    }
}
