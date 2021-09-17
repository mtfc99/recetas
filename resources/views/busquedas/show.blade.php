@extends ('layouts.app')

@section('content')
    <div class="container">
        <h2 class='titulo-categoria text-uppercase my-3'>Resultados para: {{$busqueda}}</h2>

        <div class="row">
            @foreach($recetas as $receta)
            <div class="col-md-4 my-4">
                <div class="card shadow">
                    <img class='card-img-top' src="/storage/{{$receta->imagen}}" alt="">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>{{ Str::title($receta->titulo)}}</h3>
                        </div>
                        <div class="card-text">
                            <p> <span class='text-primary'>Fecha de Creación: </span>
                                {{\Carbon\Carbon::parse($receta->created_at)->format('d/m/Y')}}</p>

                            <p><span class='text-primary'>Autor:</span> {{$receta->user->name}} </p>
                            <p class='text-muted'>
                                {{ Str::words(strip_tags($receta->preparacion), 10)}}
                            </p>
                            <div class="card-button">
                                <a href="/recetas/{{$receta->id}}" class='btn btn-primary font-weight-bold
                                        text-uppercase'>Ver Receta</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{$recetas->links()}}
        </div>
    </div>
@endsection