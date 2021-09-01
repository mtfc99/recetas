@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
    integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')

<a class='btn btn-primary mt-5 text-white' href="/perfiles/{{$perfil->usuario->id}}">Ver Perfil Público</a>

{{--$receta}};
{{$categorias--}}


@endsection

@section('content')
<h1 class='text-center'>Editar Perfil</h1>
<div class="row justify-content-center my-5">
    <div class="col-md-10 m-3 p-4">
                                                                                    <!--Este 'perfil', debe ser el mismo que está entre llaves en la ruta-->
        <form enctype="multipart/form-data" method="POST" action="{{route('perfiles.update', ['perfil'=>$perfil->id])}}" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="row"><label for="nombre">Nombre</label></div>
                <!--La clase @error('nombre') is-invalid @enderror va a resaltar el campo
en el caso de que no se cumplan los requerimientos de la validación-->
                <div class="row"><input type="text" name='nombre' class='form-control @error('nombre') is-invalid
                        @enderror' placeholder="Tu nombre" value={{$perfil->usuario->name}}></div>
                <!--el value {{old ('nombre')}} es para que en el caso de que no se cumplan
los requerimientos de la validación, el campo no se vacíe nuevamente al tener
que arreglarlo-->
                @error('nombre')
                <span class='invalid-feedback d-block' role='alert'>
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="row"><label for="url">Sitio Web</label></div>
                <!--La clase @error('name') is-invalid @enderror va a resaltar el campo
en el caso de que no se cumplan los requerimientos de la validación-->
                <div class="row"><input type="text" name='url' class='form-control @error('url') is-invalid @enderror'
                        placeholder="Tu sitio web" value={{$perfil->usuario->url}}></div>
                <!--el value {{old ('url')}} es para que en el caso de que no se cumplan
los requerimientos de la validación, el campo no se vacíe nuevamente al tener
que arreglarlo-->
                @error('url')
                <span class='invalid-feedback d-block' role='alert'>
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="biografia">Sobre mí...</label>
                <input type="hidden" id='biografia' name='biografia' value='{{$perfil->biografia}}'>
                <trix-editor style='height: auto !important;'
                 class='form-control @error('biografia') is-invalid @enderror' input='biografia'>
                </trix-editor>
                @error('biografia')
                <span class='invalid-feedback d-block' role='alert'>
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">Elige la imagen</label>
                <input type="file" id='imagen' name='imagen' class='form-control @error(' imagen') is-invalid @enderror'
                    value='{{--old('imagen')--}}'>
            </div>
            @error('imagen')
            <span class='invalid-feedback d-block' role='alert'>
                <strong>{{$message}}</strong>
            </span>
            @enderror

            @if($perfil->imagen)
            <div class='container my-4'>
                <p>Imagen Actual</p>
                <img src="/storage/{{--$receta->imagen--}}" alt="" width="250px">
            </div>
            @endif
            <div class='container my-4'>
                <p>Imagen Actual</p>
                <img src="/storage/{{$perfil->imagen}}" alt="" width="250px">
            </div>

            <div class="form-group">
                <input type="submit" class='btn btn-primary' value='Confirmar cambios'>
            </div>
        </form>
    </div>
</div>

@endsection

@push('other-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
    integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endpush