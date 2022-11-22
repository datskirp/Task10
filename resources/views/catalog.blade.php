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
    <div class="flex flex-row justify-center items-center">
        <div class="w-auto px-8 py-4 mt-4 text-left bg-white shadow-lg">
            <div class="flex flex-row justify-center">
                <table class="text-center align-center border border-2">
                    <tr class="border border-2 bg-gray-300">
                        <th class="px-3 border border-1">Product name</th>
                        <th class="px-3 border border-1">Manufacturer</th>
                        <th class="px-3 border border-1">Category</th>
                        <th class="px-3 border border-1">Price (BYN)</th>
                        <th class="px-3 border border-1">Price (USD) {{ $usdRate }}</th>
                    </tr>
                    @foreach($products as $product)
                        <tr class="border border-1">
                            <td class="border border-1 px-3 text-red-500"><a href="{{ route('catalog.card', $product->id) }}">{{$product->name}}</a></td>
                            <td class="border border-1 px-3">{{ $product->manufacturer }}</td>
                            <td class="border border-1 px-3">{{ $product->category }}</td>
                            <td class="border border-1 px-3">{{ $product->cost }}</td>
                            <td class="border border-1 px-3">
                                @if($usdRate == 0) {{ 'N/A' }}
                                @else {{ round($product->cost / $usdRate, 2) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
