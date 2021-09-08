@extends('layouts.app')

@section('styles')
    
@endsection

@section('content')
    <div class="container nuevas-recetas">
        <h2 class='titulo-categoria text-uppercase my-4'>
            Últimas Recetas
        </h2>

        <div class="row">
            @foreach($nuevas as $nueva)
            <div class="col-md-4">

                <div class="card my-3 p-4">
                    <img src="/storage/{{$nueva->imagen}}" 
                    class='card-img-top'
                    alt="receta">

                    <div class="card-body">
                        <h3 class='mb-3'>{{ Str::title($nueva->titulo)}}</h3>
                        <!--El helper "title" pone mayúsculas en cada 
                        palabra del string que estemos indicando
                    
                        El helper "words", muestra en pantalla la cantidad
                        de palabras que indiquemos del string que pasemos como 
                    parámetro.-->
                        <p> {{ Str::words(strip_tags($nueva->preparacion), 20)}} </p>

                        <a href="/recetas/{{$nueva->id}}" class='btn btn-primary font-weight-bold
                        text-uppercase'>Ver Receta</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection