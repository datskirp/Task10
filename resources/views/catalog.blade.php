<!DOCTYPE html>

<html>
<head>
    <title>Laravel Product Catalog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div><h1 class="text-center text-xl">Catalog</h1></div>
    <div class="flex flex-row justify-center items-start">
        <div class="mt-6 mx-2  text-left">
            <p class="text-xl font-semibold underline">Filtering and Sorting options</p><br>
            <p><a class="text-blue-500 underline" href="{{ route('catalog.index') }}">
                    RESET ALL
                </a> </p>
            <form action="{{ route('catalog.index') }}" method="get">
                <p>Search product name:</p>
                <div>
                    <input class="border border-2" type="text" name="filter[name]">
                </div>
                <p>Search manufacturer name:</p>
                <div>
                    <input class="border border-2" type="text" name="filter[manufacturer]">
                </div>
                <hr><br>
                <p>Select category:</p>
                <div>
                    @foreach($categories as $category)
                        <input type="checkbox" name="filter[category][]" value="{{ $category['category'] }}">&nbsp;{{ $category['category'] }}<br>
                    @endforeach
                </div>
                <hr><br>
                <input class="button bg-gray-300 py-1 px-2" type="submit" value="Show">
            </form>
        </div>
        <div class="w-2/3 px-8 py-4 mt-4 text-left bg-white shadow-lg">
            <div class="flex flex-row w-full justify-center">
                <table class="w-full text-center align-center border border-2">
                    <tr class="border border-2">
                        <td class="px-3 border border-1">
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=name' }}">Asc</a>
                            |
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=-name' }}">Desc</a>
                        </td>
                        <td class="px-3 border border-1">
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=manufacturer' }}">Asc</a>
                            |
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=-manufacturer' }}">Desc</a>
                        </td>
                        <td class="px-3 border border-1">
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=category' }}">Asc</a>
                            |
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=-category' }}">Desc</a>
                        </td>
                        <td class="px-3 border border-1">
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=cost' }}">Low</a>
                            |
                            <a class="text-blue-500 underline" href="{{ route('catalog.index'). '?' . request()->getQueryString() . '&' . 'sort=-cost' }}">High</a>
                        </td>
                    </tr>
                    <tr class="border border-2 bg-gray-300">
                        <th class="px-3 border border-1">Product name</th>
                        <th class="px-3 border border-1">Manufacturer</th>
                        <th class="px-3 border border-1">Category</th>
                        <th class="px-3 border border-1">Price</th>
                    </tr>
                    @foreach($products as $product)
                        <tr class="border border-1">
                            <td class="border border-1 px-3 text-red-500"><a href="{{ route('catalog.card', $product->id) }}">{{$product->name}}</a></td>
                            <td class="border border-1 px-3">{{ $product->manufacturer }}</td>
                            <td class="border border-1 px-3">{{ $product->category }}</td>
                            <td class="border border-1 px-3">${{ $product->cost }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            {{ $products->links() }}
        </div>
    </div>
</div>
</body>
</html>
