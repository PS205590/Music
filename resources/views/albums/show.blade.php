@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <h1 class="headline">Selected Album - {{ $album['id'] }}</h1>
                </div>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    @isset($album)
                        <p>The albums name is: {{ $album['name'] }}</p>
                        <p>It was released in: {{ $album['year'] }}</p>
                        <p>It has sold {{ $album['times_sold'] }} copies</p>
                        @isset($album->band)
                            <p>The album is owned by: {{ $album->band->name }}</p>
                        @endisset
                        <br>
                        @isset($album->songs)
                            <p>The album contains the following songs:</p>
                            @foreach ($album->songs as $song)
                                <p>- {{ $song->title }}</p>
                            @endforeach
                        @endisset
                    @endisset
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('albums.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
