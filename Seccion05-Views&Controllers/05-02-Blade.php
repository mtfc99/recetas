Blade es un nuevo modelo de escribir código PHP.

Los archivos blade, tienen extension .blade.php y son LAS VISTAS del proyecto laravel 

al llamar al arhcivo blade desde las rutas se hace así:

Route::get('/', function () {
    return view('welcome');
});

en vez de ECHO se utiliza {{$variable}};

Tiene DIRECTIVAS que facilitan la escritura de PHP 
antes había que poner <?php //CODIGO ?>

ahora, con las directivas, se hace del siguiente modo 

@php  
    @if

    @endif
@endphp

