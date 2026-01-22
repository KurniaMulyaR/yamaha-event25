<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListProduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'list_produk';

    protected $primaryKey = 'id';

    protected $fillable = [
         'name','type','price','ttlunit','colour','img'
    ];

    public function varians()
{   
    return $this->hasMany(Varian::class, 'produkid');
}
}
