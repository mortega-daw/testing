@extends('layouts.app')

@section('titulo')
    Crear Post
@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" id="dropzone" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input id="titulo" type="text" name="titulo" placeholder="Titulo de la publicación"
                        class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <input type="submit" value="Crear Publicación"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white">
            </form>
        </div>
    </div>
    <script>
        // Initialize Dropzone
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("#dropzone", {
          acceptedFiles: '.jpg, .png, .jpeg, .gif',
          addRemoveLinks: true,
          dictRemoveFile: 'Eliminar Imagen',
          maxFiles: 1,
          uploadMultiple: false,
          dictDefaultMessage: 'Arrastra tus imágenes aquí para subirlas',
          init: function() {
            if (document.querySelector('[name="imagen"]').value.trim()) {
              let imagenPublicada = {};
              imagenPublicada.size = 1234;
              imagenPublicada.name = document.querySelector('[name="imagen"]').value;

              this.options.addedfile.call(this, imagenPublicada);
              this.options.thumbnail.call(this, imagenPublicada, `/images/${imagenPublicada.name}`);

              imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
          },
          success: function(file, response) {
            document.querySelector('[name="imagen"]').value = response.image;
          },
          removedfile: function() {
            const imagenInput = document.querySelector('[name="imagen"]').value = "";
          }
        });
    </script>
@endsection
