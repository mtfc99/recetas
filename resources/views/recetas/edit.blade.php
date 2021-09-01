@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
    integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')

<a class='btn btn-primary mt-5 text-white' href="{{route('recetas.index')}}">Ver Recetas</a>

<!--{{$receta}};
{{$categorias}};-->


@endsection
@section('content')
<h2 class='text-center mb-5'>Editar Receta: {{$receta->titulo}}</h2>
<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <form class='form-action' method="POST" enctype="multipart/form-data" action="{{route('recetas.update', ['receta'=>$receta->id])}}" novalidate>
            <!--el action dice que cuando le demos submit al formulario, se va a ejecutar el método STORE-->
            @csrf
            <!--El csrf es un método de seguridad. Debemos ponerlo en cada formulario-->

            @method('PUT')
            <div class="form-group">
                <div class="row"><label for="titulo">Nombre</label></div>
                <!--La clase @error('name') is-invalid @enderror va a resaltar el campo
en el caso de que no se cumplan los requerimientos de la validación-->
                <div class="row"><input type="text" name='titulo' class='form-control @error('titulo') is-invalid
                        @enderror' placeholder="Nombre de la Receta" value={{$receta->titulo}}></div>
                <!--el value {{old ('titulo')}} es para que en el caso de que no se cumplan
los requerimientos de la validación, el campo no se vacíe nuevamente al tener
que arreglarlo-->
                @error('titulo')
                <span class='invalid-feedback d-block' role='alert'>
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="categoria">Categoría</label>
                </div>
                <div class="row">
                    <select name="categoria" id="categoria"
                        class="form-control  @error('categoria') is-invalid @enderror">
                        <option value="">--Seleccione--</option>
                        @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}" {{$receta->categoria_id===$categoria->id ? 'selected' : "" }}>{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                    <span class='invalid-feedback d-block' role='alert'>
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group mt-4">
                    <label for="preparacion">Preparación</label>
                    <input  type="hidden"  id='preparacion' name='preparacion' value='{{$receta->preparacion}}'>
                    <trix-editor style='height: auto !important;' class='form-control @error('preparacion') is-invalid @enderror' input='preparacion'></trix-editor>
                    @error('preparacion')
                    <span class='invalid-feedback d-block' role='alert'>
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            
            
                <div class="form-group mt-4">
                    <label for="ingredientes">Ingredientes</label>
                    <input  type="hidden"  id='ingredientes' name='ingredientes' value='{{$receta->ingredientes}}'>
                    <trix-editor style='height: auto !important;' class='form-control @error('ingredientes') is-invalid @enderror, height: auto !important;' input='ingredientes'></trix-editor>
                    @error('ingredientes')
                    <span class='invalid-feedback d-block' role='alert'>
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="imagen">Elige la imagen</label>
                <input type="file"
                id='imagen'
                name='imagen'
                class='form-control @error('imagen') is-invalid @enderror'
                value='{{old('imagen')}}'>
            </div>
            @error('imagen')
                    <span class='invalid-feedback d-block' role='alert'>
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
            
            <div class='container my-4'>
                <p>Imagen Actual</p>
                <img src="/storage/{{$receta->imagen}}" alt="" width="250px">
            </div>

            <div class="form-group">
                <input type="submit" class='btn btn-primary' value='Agregar Receta'>
            </div>
    </div>
    
    </form>
</div>
</div>

</div>
@endsection

@push('other-scripts') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
    integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endpush