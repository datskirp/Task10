<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'manufacturer',
        'release',
        'cost',
        'category',
    ];
}
