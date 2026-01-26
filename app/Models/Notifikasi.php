<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'pesanan_notifikasis';
    
    protected $fillable = [
        'userid',
        'phone',
        'email',
        'post_data',
        'status',
        'sent_at'
    ];

    protected $casts = [
        'post_data' => 'array',
        'sent_at' => 'datetime',
    ];
}
