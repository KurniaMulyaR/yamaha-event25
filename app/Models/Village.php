<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'indonesia_villages';

    protected $fillable = [
         'code','district_code','name','meta'
    ];

    public function districts()
    {
        return $this->BelongsTo(District::class, 'district_code', 'code');
    }
}
