@extends('base')

@section('main')
    <div>
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-800 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-2xl">
                <div class="mb-4">
                    <p class="text-orange-500 text-3xl font-bold decoration-gray-400">
                        Edit Song - {{ $song['id'] }}
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
                    <form method="post" action="{{ route('songs.update', $song->id) }}">
                        @method('PATCH')
                        @csrf
                        <div>
                            <label class="block text-2xl font-bold" for="title">Title:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="title"
                                value="{{ $song->title }}" />
                        </div>
                        <div>
                            <label class="block text-2xl font-bold" for="singer">Singer:</label>
                            <input class="block border-black rounded-md shadow-sm" type="text" name="singer"
                                value="{{ $song->singer }}" />
                        </div>
                        <div class="flex items-center justify-start mt-4 gap-x-2">
                            <button type="submit" class="bt-edit">Update Song</button>
                        </div>
                    </form>
                </div>
                <br>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <div class="my-2">
                        <table>
                            <thead>
                                <tr>
                                    <td class="font-bold text-2xl">Gekoppelde albums:</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($song->albums as $album)
                                    <tr>
                                        <form method="post"
                                            action="{{ route('song.album.detach', [$song->id, $album->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <td>
                                                <p class="mr-2">{{ $album->name }}</p>
                                            </td>
                                            <td>
                                                <button type="submit" class="bt-delete">Ontkoppel album</button>
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
                                    <td class="font-bold text-2xl">Niet gekoppelde albums:</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($albums as $album)
                                    <tr>
                                        <form method="post"
                                            action="{{ route('song.album.attach', [$song->id, $album->id]) }}">
                                            @csrf
                                            <td>
                                                <p class="mr-2">{{ $album->name }}</p>
                                            </td>
                                            <td>
                                                <button type="submit" class="bt-edit">Koppel album</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <button class="bt-nav" onclick="window.location='{{ route('songs.index') }}'">Return</button>
            </div>
        </div>
    </div>
@endsection
