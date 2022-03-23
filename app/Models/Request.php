<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';
    public $timestamps = false;


    protected $fillable = [
        'id_user',
        'num_gral',
        'num_cite',
        'description',
        'date_register_request',
        'status'
    ];

    protected $hiden = [
        'id',
        'date_register'
    ];
}
