@extends('layouts.main')
@section('content')
    <div class="w-auto mt-3 items-center justify-center flex flex-row">
        <div class="px-4 text-center text-xl">Admin panel Services</div>
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div><br>
    @include('partials.flash-message')
    <div class="flex flex-row justify-center items-top">
        <a href="{{ route('services.create') }}">
            <button
                class="text-l w-40 bg-green-500 hover:border-green-900 text-white font-bold p-2 mx-5 border-2 rounded">
                Create Service
            </button>
        </a>
        <a href="{{ route('admin') }}">
            <button
                class="text-l w-40 bg-gray-400 hover:border-gray-900 text-white font-bold p-2 mx-5 border-2 rounded">
                Main panel
            </button>
        </a>
    </div>
    <br>
    <div class="flex flex-row justify-center items-top">
        <div class="px-5">
            <table class="text-center align-center border border-2">
                <tr class="border border-2 bg-gray-300">
                    <th class="px-3 border border-1">Service Id</th>
                    <th class="px-3 border border-1">Type</th>
                    <th class="px-3 border border-1">Cost</th>
                    <th class="px-3 border border-1">Deadline</th>
                    <th class="px-3 border border-1">Category</th>
                    <th class="px-3 border border-1"></th>
                </tr>
                @foreach($services as $service)
                    <tr class="border border-1">
                        <td class="border border-1 px-3">{{ $service->id }}</td>
                        <td class="border border-1 px-3">{{ $service->type }}</td>
                        <td class="border border-1 px-3">{{ $service->cost }}</td>
                        <td class="border border-1 px-3">{{ $service->deadline }}</td>
                        <td class="border border-1 px-3">{{ $service->category }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id) }}">
                                <button
                                    class="text-xs w-12 bg-green-400 hover:border-green-900 text-white font-bold py-1 border-2 rounded">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ route('services.destroy', $service->id) }}" method="post">
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
