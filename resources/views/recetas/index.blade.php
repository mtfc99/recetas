@extends('layouts.app')

@section('botones')

<a class='btn btn-outline-primary shadow-sm mt-5 mx-2' href="{{route('recetas.create')}}"><i class="fa fa-pencil"
        aria-hidden="true"></i> Crear Receta</a>
<a class='btn btn-outline-info shadow-sm mt-5 mx-2 ' href="{{route('perfiles.edit', ['perfil' =>Auth::user()->id])}}"><i
        class="fas fa-edit    "></i> Editar Perfil</a>
<a class='btn btn-outline-success shadow-sm mt-5 mx-2'
    href="{{route('perfiles.show', ['perfil' => Auth::user()->id])}}"><i class="fa fa-eye" aria-hidden="true"></i> Ver
    Perfil</a>
@endsection
@section('content')
<h2 class='text-center mb-5'>Administra tus Recetas</h2>

<div class='col-md-12 mx-auto bg-white p-3'>
    <table class="table">
        <thead class='bg-primary text-light'>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Titulo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recetas as $receta)
            <tr>
                <td><img src="/storage/{{$receta->imagen}}" alt="" class='img-thumbnail' width="200px"></td>
                <td>{{$receta->titulo}}</td>
                <!-- <td>{{$receta->categoria_id}}</td>-->
                <td>{{$receta->categoria->nombre}}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger w-100 shadow-sm" data-toggle="modal"
                        data-target="#exampleModal">
                        <i class="fas fa-trash-alt    "></i> Eliminar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar: {{$receta->titulo}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <form method="POST" action="{{action('RecetaController@destroy', [$receta->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class='btn btn-danger' value='Eliminar &times;'>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a target="_blank" href="{{action('RecetaController@edit', [$receta->id])}}"
                        class='btn shadow-sm w-100 btn-info my-2'><i class="fas fa-edit"></i> Editar</a>
                    <a target="_blank" href="{{action('RecetaController@show', [$receta->id])}}"
                        class='btn shadow-sm w-100 btn-success'><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12 justify-content-center d-flex my-4">
    {{$recetas->links()}}
</div>
</div>
@endsection