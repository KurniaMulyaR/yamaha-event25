<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListDelear extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'listdelear';

    protected $primaryKey = 'id';

    protected $fillable = [
         'code','district_code','namedds','provinsi','kota','kecamatan','namedelear'
    ];
    
    public function district()
    {
        return $this->hasMany(District::class, 'district_code', 'id');
    }
}
