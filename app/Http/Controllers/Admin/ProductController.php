<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use ProductExport;
use Aws\S3\S3Client;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $products;

    /**
     * @param $products
     */
    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        return view('admin-products', ['products' => $this->products->all()]);
    }

    public function export()
    {
        $s3Key = 'products_' . time() . '.csv';
        $productsCsv = Excel::download(new ProductExport($this->product), 'contents', \Maatwebsite\Excel\Excel::CSV);
        Storage::disk('s3')->put($s3Key, $productsCsv->getFile()->getContent());

    }

}
