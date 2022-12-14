@extends('layouts.main')
@section('content')

    <div class="grid h-top place-items-center">
        <p class="text-lg font-semibold mb-5">Edit product's properties</p>
        <form  method="post" action="{{ route('products.update', $product->id) }}" novalidate
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @method('PUT')
            @csrf
            <div class="mb-2">
                <label class="font-semibold">Id </label><br>
                <input type="text" class="border" name="id" id="id" value="{{ $product->id }}" readonly>
            </div>
            <div class="mb-2">
                <label class="font-semibold">Name </label><br>
                <input type="text" class="border @error('name')  border-pink-500 @enderror" name="name" id="name" value="{{ $product->name }}">

                @error('name')
                <span class="text-pink-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="font-semibold">Manufacturer </label><br>
                <input type="text" class="border @error('manufacturer')  border-pink-500 @enderror "
                       name="manufacturer" id="manufacturer" value="{{ $product->manufacturer }}">

                @error('manufacturer')
                <span class="text-pink-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="font-semibold">Release </label><br>
                <input type="text" class="border @error('release')  border-pink-500 @enderror "
                       name="release" id="release" value="{{ $product->release }}">
                @error('release')
                <span class="text-pink-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="font-semibold">Cost </label><br>
                <input type="text" class="border @error('cost')  border-pink-500 @enderror "
                       name="cost" id="cost" value="{{ $product->cost }}">
                @error('cost')
                <span class="text-pink-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="font-semibold">Category </label><br>
                <input type="text" class="border @error('category')  border-pink-500 @enderror "
                       name="category" id="category" value="{{ $product->category }}">
                @error('category')
                <span class="text-pink-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-3">
                <input type="submit" name="send" value="Submit" class="bg-blue-500 hover:border-blue-900 text-white font-bold py-2 w-44 border-2 rounded">
            </div>
        </form>
    </div>

@endsection
