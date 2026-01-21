<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Varian extends Model
{
     use HasFactory, SoftDeletes;

    protected $table = 'varianproduk';

    protected $primaryKey = 'id';

    protected $fillable = [
         'name','produkid'
    ];
}
