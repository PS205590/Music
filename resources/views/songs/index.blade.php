@extends('base')

@section('main')
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
                <div class="overflow-hidden">
                    <div class="flex flex-row justify-center">
                        <h1 class="headline">Songs</h1>
                        @auth
                            <button class="bt-create" onclick="window.location='{{ route('songs.create') }}'">Add Song</button>
                        @endauth
                        <button class="bt-nav mx-2" onclick="window.location='{{ route('bands.index') }}'">Go to
                            Bands</button>
                        <button class="bt-nav" onclick="window.location='{{ route('albums.index') }}'">Go to Albums</button>
                        <button class="bt-nav mx-2" onclick="window.location='{{ route('dashboard') }}'">Go to Dashboard</button>
                    </div>
                    <div class="flex justify-center">
                        @if (session()->get('success'))
                            <div class="block mx-2 my-2">
                                <h3>{{ session()->get('success') }}</h3>
                            </div>
                        @endif
                    </div>
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th scope="col" class="tablehead">ID</th>
                                <th scope="col" class="tablehead">Title</th>
                                <th scope="col" class="tablehead">Singer</th>
                                @auth
                                    <th scope="col" class="tablehead">Actions</th>
                                @endauth
                            </tr>
                        </thead class="border-b">
                        <tbody>
                            @foreach ($songs as $song)
                                <tr class="border-b">
                                    <td class="tablecell">
                                        {{ $song->id }}</td>
                                    <td class="tablecell"><a style="text-decoration: none"
                                            href="{{ route('songs.show', $song->id) }}">{{ $song->title }}</a></td>
                                    <td class="tablecell">
                                        {{ $song->singer }}</td>
                                    @auth
                                        <td class="actionscell">
                                            <button class="bt-edit"
                                                onclick="window.location='{{ route('songs.edit', $song->id) }}'">Edit</button>
                                            <form action="{{ route('songs.destroy', $song->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bt-delete" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
