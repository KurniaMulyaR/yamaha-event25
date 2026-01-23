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
         'userid','produkid','delearid','status','keterangan','varianid','orderid','snaptoken'
    ];


    public function datauser()
    {
        return $this->hasOne(DataUser::class, 'userid', 'id');
    }

    public function produk()
    {
        return $this->hasOne(ListProduk::class, 'id', 'produkid');
    }

    public function varian()
    {
        return $this->hasOne(Varian::class, 'id', 'varianid');
    }

    public function delear()
    {
        return $this->hasOne(ListDelear::class, 'delearid', 'id');
    }
}
