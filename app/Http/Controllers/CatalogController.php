<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $product;
    protected $services;

    /**
     * @param Product $product
     * @param Service $services
     */
    public function __construct(Product $product, Service $services)
    {
        $this->product = $product;
        $this->services = $services;
    }

    public function index()
    {
        $products = $this->product->getSelected()->paginate();

        return view('catalog', ['products' => $products, 'categories' => $this->product::select('category')->distinct()->get()]);
    }

    /**
     * @param Request $request
     * @param Card    $card
     * @param int     $id
     */
    public function card(Request $request, Card $card, $id)
    {
        $product = $this->product->where('id', $id)->firstOrFail();
        $card->addProduct($product);
        $request->session()->put('card', $card);

        return view('card', [
            'card' => $card,
            'services' => $this->services->where('category', $product->category)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param int     $serviceId
     */
    public function addService($serviceId)
    {
        $card = session('card');
        $service = $this->services->where('id', $serviceId)->firstOrFail();
        $card->addService($service);

        return view('card', [
            'card' => $card,
            'services' => $this->services->where('category', $card->product->category)->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param int     $serviceId
     */
    public function removeService($serviceId)
    {
        $card = session('card');
        $service = $this->services->where('id', $serviceId)->firstOrFail();
        $card->removeService($service);

        return view('card', [
            'card' => $card,
            'services' => $this->services->where('category', $card->product->category)->get(),
        ]);
    }
}
