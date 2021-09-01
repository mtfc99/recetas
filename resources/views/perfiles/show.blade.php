@extends('layouts.app')

@section('botones')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            @if($perfil->imagen==false)
            <img src="https://assets.stickpng.com/thumbs/585e4bf3cb11b227491c339a.png" alt=""
                class='w-100 rounded-circle shadow' width="250px">

            @elseif($perfil->imagen)
            <img src="/storage/{{$perfil->imagen}}" alt="" class='w-100 rounded-circle shadow' width="250px">
            @endif
        </div>


        <div class="col-md-7">
            <h2 class='text-center my-2 text-primary'>{{$perfil->usuario->name}}</h2>
            <a href="{{$perfil->usuario->url}}">Visitar Sitio Web</a>
            <div class="biografia">
                {!!$perfil->biografia!!}
            </div>
        </div>
    </div>

    <div class="col-12 mt-5">
        <h2 class='text-center text-primary font-weight-bold mt-5'>Recetas creadas por este cocinero</h2>
        <div class="row">

            @foreach($recetas as $receta)
            <div class="col-6 col-lg-4 card p-4">
                <div class="row">
                    <img src="/storage/{{$receta->imagen}}" alt="" class='img-thumbnail' width="200px"></td>
                </div>
                <div class="row">
                    <p class='text-primary font-weight-bold'>{{$receta->titulo}}</p>
                </div>
                <div class="row">
                <p class='text-muted'>{{$receta->categoria->nombre}}</p>
                </div>
                <div class="row">
                   <span style='font-weight: bold;'>Fecha de Publicación: </span>
                <p>{{\Carbon\Carbon::parse($receta->created_at)->format('d/m/Y')}}</p>
                </div>
                <td><a target="_blank" href="{{action('RecetaController@show', [$receta->id])}}"
                        class='btn btn-outline-success'>Ver Receta</a></td>
            </div>
            @endforeach



        </div>


        <div class="text-center justify-content-center d-flex">
            {{$recetas->links()}}
        </div>
    </div>
</div>
</div>
@endsection