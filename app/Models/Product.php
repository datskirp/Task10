<?php

namespace App\Models;

use App\Exports\ProductsExport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export(string $filename)
    {
        $productsCsv = Excel::download(new ProductsExport(), 'contents', \Maatwebsite\Excel\Excel::CSV);

        return Storage::disk('s3')->put($filename, $productsCsv->getFile()->getContent());
    }
}
