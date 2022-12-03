<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

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
        $filename = 'products_' . time() . '.csv';
        $sentStatus = $this->products->export($filename);
        if ($sentStatus) {
            Mail::send([], [], function ($message) use ($filename) {
                $message->to('admin@products.com')
                    ->subject('Bucket ' . env('AWS_BUCKET'))
                    ->from('task12@gmail.com')
                    ->text(sprintf(
                        'File %s was uploaded to the bucket',
                        $filename
                    ));
            });

            return redirect(route('admin.products.index'))->with(
                'success',
                sprintf(
                    'Export was successful. Stored in S3 bucket - %s, file name is: %s',
                    env('AWS_BUCKET'),
                    $filename
                )
            );
        }

        return redirect(route('admin.products.index'))->with(
            'error',
            'Export was not successful'
        );
    }
}
