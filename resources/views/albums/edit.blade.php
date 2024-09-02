@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <p class="text-orange-500 text-3xl font-bold decoration-gray-400">
                        Edit Album - {{ $album['id'] }}
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
                    <form method="post" action="{{ route('albums.update', $album->id) }}">
                        @method('PATCH')
                        @csrf
                        <div>
                            <label class="block text-2xl font-bold" for="name">Name:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="name"
                                value="{{ $album->name }}" />
                        </div>
                        <div>
                            <label class="block text-2xl font-bold" for="year">Year:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="year"
                                value="{{ $album->year }}" />
                        </div>
                        <div>
                            <label class="block text-2xl font-bold" for="times_sold">Times sold:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="times_sold"
                                value="{{ $album->times_sold }}" />
                        </div>
                        <div class="flex items-center justify-start mt-4 gap-x-2">
                            <button type="submit" class="bt-edit">Update Album</button>
                        </div>
                    </form>
                </div>
                <br>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <div class="my-2">
                        <table>
                            <thead>
                                <tr>
                                    <td class="font-bold text-2xl">Gekoppelde Songs:</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($album->songs as $song)
                                    <tr>
                                        <form method="post"
                                            action="{{ route('album.song.detach', [$album->id, $song->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <td>
                                                <p class="mr-2">{{ $song->title }}</p>
                                            </td>
                                            <td>
                                                <button type="submit" class="bt-delete">Ontkoppel Song</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <td class="font-bold text-2xl">Niet gekoppelde songs:</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($songs as $song)
                                    <tr>
                                        <form method="post"
                                            action="{{ route('album.song.attach', [$album->id, $song->id]) }}">
                                            @csrf
                                            <td>
                                                <p class="mr-2">{{ $song->title }}</p>
                                            </td>
                                            <td>
                                                <button type="submit" class="bt-edit">Koppel Song</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('albums.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
