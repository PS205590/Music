@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <h1 class="headline">Selected Band - {{ $band['id'] }}</h1>
                </div>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    @isset($band)
                        <p>The band's name is: {{ $band['name'] }}</p>
                        <p>Their main genre of music is: {{ $band['genre'] }}</p>
                        <p>The band was founded in: {{ $band['founded'] }}</p>
                        <p>The band has been active till: {{ $band['active_till'] }}</p>
                        <br>
                        @isset($band->albums)
                            <p>The band owns the following albums:</p>
                            @foreach ($band->albums as $album)
                                <p>- {{ $album->name }}</p>
                            @endforeach
                        @endisset
                    @endisset
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('bands.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
