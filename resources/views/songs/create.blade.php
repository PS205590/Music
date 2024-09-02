@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <p class="text-orange-500 text-3xl font-bold decoration-gray-400">
                        Add Song
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
                    <form method="post" action="{{ route('songs.store') }}">
                        @csrf
                        <div>
                            <label class="block text-2xl font-bold" for="title">Title:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="title" />
                        </div>
                        <div>
                            <label class="block text-2xl font-bold" for="singer">Singer:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="singer" />
                        </div>
                        <div class="flex items-center justify-start mt-4 gap-x-2">
                            <button type="submit" class="bt-edit">Add Song</button>
                        </div>
                    </form>
                    <br>
                    <form>
                        <div>
                            <label class="block text-2xl font-bold">Find Song from API</label>
                            <div class="flex flex-row">
                                <input class="block border-black rounded-md shadow-sm" type="text" name="title" />
                                <button type="submit" class="bt-edit">Find Song</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    @isset($songsFromAPI)
                        <div>
                            @foreach ($songsFromAPI as $song)
                                <form method="post" action="{{ route('songs.store') }}">
                                    @csrf
                                    <div class="flex flex-row">
                                        <label class="block text-2xl font-bold" for="title">Title:</label>
                                        <input class="ml-2 block border-black rounded-md shadow-sm" type="text"
                                            name="title" value="{{ $song['name'] }}" />
                                    </div>
                                    <div class="flex flex-row">
                                        <label class="block text-2xl font-bold" for="singer">Singer:</label>
                                        <input class="ml-2 block border-black rounded-md shadow-sm" type="text"
                                            name="singer" value="{{ $song['artist'] }}" />
                                    </div>
                                    <div class="flex items-center justify-start mt-4 gap-x-2">
                                        <button type="submit" class="bt-edit">Add Song</button>
                                    </div>
                                    <br>
                                </form>
                            @endforeach
                        </div>
                    @endisset
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('songs.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
