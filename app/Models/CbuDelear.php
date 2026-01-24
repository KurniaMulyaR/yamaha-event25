<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbuDelear extends Model
{
    use HasFactory;

    protected $table = 'cbudealer';

    protected $primaryKey = 'id';

    protected $fillable = [
         'code','district_code','namedds','provinsi','kota','kecamatan','namedelear','code_kota','cansell'
    ];
    
    public function district()
    {
        return $this->hasMany(District::class, 'district_code', 'id');
    }
}
