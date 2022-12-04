<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->fill($validated)->save();

        return redirect('/admin')->with('success', 'Product was created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $products
     */
    public function edit(Product $products, $id)
    {
        $product = $products->where('id', $id)->firstOrFail();

        return view('edit-product', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->where('id', $validated['id'])->update($validated);

        return redirect(route('admin.products.index'))->with(
            'success',
            sprintf(
                'Product with id: %s was updated',
                $request->input('id')
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $products, $id)
    {
        $products->where('id', $id)->firstOrFail()->delete();

        return back()->with(
            'success',
            sprintf(
                'Product with id: %s was deleted',
                $id)
        );
    }
}
