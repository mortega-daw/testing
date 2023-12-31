@extends('layouts.app')

@section('titulo')
    Perfil {{$user->username}}
@endsection


@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/user.png') }}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center py-10 md:py-10 md:items-start md:justify-center">
                <p class="text-gray-700 text-xl">{{$user->username}}</p>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal"> Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        @if ($posts->isEmpty())
            <p class="text-center text-gray-700 text-sm font-bold">No hay publicaciones</p>
        @else
            <div class="grid md:grid-cols lg:grid-cols-4 xl:grid-col-4 gap-6">
                @foreach ($posts as $post)
                <div>
                    <a>
                        <img src="{{ asset('images') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
                @endforeach
                <div class="my-10">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </section>
@endsection
