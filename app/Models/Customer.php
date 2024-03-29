<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'email',
        'so_dien_thoai',
        'ho',
        'dem',
        'ten',
        'ngay_sinh',
        'hash_reset',
        'status',
        'ly_do_block',
        'password',
        'dia_chi',
    ];
}
