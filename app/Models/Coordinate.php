<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    use HasFactory;

    protected $table = 'coordinates';
    public $timestamps = false;


    protected $fillable = [
        'id_project',
        'location_utm',
        'location',
        'status'
    ];

    protected $hiden = [
        'id',
        'create_at'
    ];



}
