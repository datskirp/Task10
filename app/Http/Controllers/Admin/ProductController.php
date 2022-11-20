<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Exports\ProductsExport;
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
        return $this->products->export();
    }

}
