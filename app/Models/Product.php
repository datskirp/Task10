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

    public function export()
    {
        $s3Key = 'products_' . time() . '.csv';
        $productsCsv = Excel::download(new ProductsExport(), 'contents', \Maatwebsite\Excel\Excel::CSV);
        $sentStatus = Storage::disk('s3')->put($s3Key, $productsCsv->getFile()->getContent());
        return $sentStatus ?
            redirect(route('admin.products.index'))->with(
                'success',
                sprintf(
                    'Export was successful. Stored in S3 bucket - %s, file name is: %s',
                    env('AWS_BUCKET'),
                    $s3Key
                )
            ) :
            redirect(route('admin.products.index'))->with(
                'error',
                'Export was not successful');
    }
}
