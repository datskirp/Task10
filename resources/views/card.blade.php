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
    <div class="flex flex-row justify-center items-center ">
        <div class="mt-20 w-2/3 px-4 lg:px-0">
            <div class="p-3 bg-white rounded shadow-md">
                <div class="">
                    <div class="flex-auto p-2 justify-evenly">
                        <div class="flex flex-wrap ">
                            <div class="flex items-center justify-between w-full min-w-0 ">
                                <h2 class="mr-auto text-red-500 text-lg cursor-pointer hover:text-gray-900 ">
                                    {{ $card->product->name }}
                                </h2>
                                <span class="text-left">Category: {{ $card->product->category }}</span>
                            </div>
                        </div>
                        <div class="mt-1 text-sm">
                            {{ $card->product->manufacturer }}
                        </div>
                        <div class="mt-1 text-sm">
                            Release date: {{ $card->product->release }}
                        </div>
                        <div class="mt-1 text-lg font-semibold">
                            BYN {{ $card->product->cost }}
                        </div>
                        <br>
                        <div class="mt-1 text-lg">
                            Services available:
                        </div>
                        <div>
                        <table>
                            <tr class="bg-gray-200">
                                <th class="px-3">Type</th>
                                <th class="px-3">Deadline</th>
                                <th class="px-3">Cost</th>
                                <th class="px-3"></th>
                            </tr>
                            @foreach($services as $service)
                                <tr>
                                    <td class="px-3">{{ $service->type }}</td>
                                    <td class="px-3">{{ $service->deadline }}</td>
                                    <td class="px-3">BYN {{ $service->cost }}</td>
                                    <td class="px-3">
                                        @if(!isset($card->services[$service->id]))
                                            <a href="{{ route('catalog.add-service', $service->id) }}" class="text-blue-500">add</a>
                                        @else
                                            <a href="{{ route('catalog.remove-service', $service->id) }}" class="text-blue-500">remove</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                        <br>
                        <div>
                            <p class="text-2xl font-semibold" >Total: $<span>{{ $card->getTotalPrice() }}</span></p>
                        </div>
                        <div class="mt-1 flow-root">
                            <span class="float-right"><a class="text-blue-700" href="/">Back to catalog</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
