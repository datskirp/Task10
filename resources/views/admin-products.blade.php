@extends('layouts.main')
@section('content')
    <div><h1 class="text-center text-xl">Admin Panel Products</h1></div><br>
    @include('partials.flash-message')
    <div class="flex flex-row justify-center items-top">
        <a href="{{ route('products.create') }}">
            <button
                class="text-l w-40 bg-green-500 hover:border-green-900 text-white font-bold p-2 mx-5 border-2 rounded">
                Create Product
            </button>
        </a>
        <a href="{{ route('admin') }}">
            <button
                class="text-l w-40 bg-gray-400 hover:border-gray-900 text-white font-bold p-2 mx-5 border-2 rounded">
                Main panel
            </button>
        </a>
        <a href="{{ route('admin.products.export') }}">
            <button
                class="text-l w-40 bg-blue-500 hover:border-gray-900 text-white font-bold p-2 mx-5 border-2 rounded">
                Export products
            </button>
        </a>
    </div>
    <br>
    <div class="flex flex-row justify-center items-top">
        <div class="px-5">
            <table class="text-center align-center border border-2">
                <tr class="border border-2 bg-gray-300">
                    <th class="px-3 border border-1">Product Id</th>
                    <th class="px-3 border border-1">Product name</th>
                    <th class="px-3 border border-1">Manufacturer</th>
                    <th class="px-3 border border-1">Release</th>
                    <th class="px-3 border border-1">Category</th>
                    <th class="px-3 border border-1">Price</th>
                    <th class="px-3 border border-1"></th>
                </tr>
                @foreach($products as $product)
                    <tr class="border border-1">
                        <td class="border border-1 px-3">{{ $product->id }}</td>
                        <td class="border border-1 px-3">{{ $product->name }}</td>
                        <td class="border border-1 px-3">{{ $product->manufacturer }}</td>
                        <td class="border border-1 px-3">{{ $product->release }}</td>
                        <td class="border border-1 px-3">{{ $product->category }}</td>
                        <td class="border border-1 px-3">${{ $product->cost }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}">
                                <button
                                    class="text-xs w-12 bg-green-400 hover:border-green-900 text-white font-bold py-1 border-2 rounded">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="submit"
                                       class="text-xs w-12 bg-red-400 cursor-pointer hover:border-red-900 text-white font-bold py-1 border-2 rounded"
                                       value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
