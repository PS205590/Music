@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <h1 class="headline">Selected Song - {{ $song['id'] }}</h1>
                </div>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    @isset($song)
                        <p>The song's name is: {{ $song['title'] }}</p>
                        <p>The singer/band is: {{ $song['singer'] }}</p>
                    @endisset
                    <br>
                    @isset($song->albums)
                        <p>The song is included in the following albums:</p>
                        @foreach ($song->albums as $album)
                            <p>- {{ $album->name }}</p>
                        @endforeach
                    @endisset
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('songs.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
