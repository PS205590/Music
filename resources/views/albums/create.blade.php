@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <p class="text-orange-500 text-3xl font-bold decoration-gray-400">
                        Add Album
                    </p>
                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="post" action="{{ route('albums.store') }}">
                        @csrf
                        <div>
                            <label class="block text-2xl font-bold" for="name">Name:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="name" />
                        </div>
                        <div>
                            <label class="block text-2xl font-bold" for="year">Year:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="year" />
                        </div>
                        <div>
                            <label class="block text-2xl font-bold" for="times_sold">Times sold:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="times_sold" />
                        </div>
                        <div class="flex items-center justify-start mt-4 gap-x-2">
                            <button type="submit" class="bt-edit">Add Album</button>
                        </div>
                    </form>
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('albums.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
