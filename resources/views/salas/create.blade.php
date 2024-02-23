<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Agrega la referencia a los archivos de Bootstrap CSS y JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Instituto Tecnológico del Altiplano de Tlaxcala</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Centros de cómputo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/home')}}">Otros módulos</a>

                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ url('/home')}}" class="list-group-item list-group-item-action">Inicio</a>
                <a href="{{ url('/dashboard')}}" class="list-group-item list-group-item-action">Panel</a>
                <a href="{{ url('/salas')}}" class="list-group-item list-group-item-action active">Lista de Centros de cómputo</a>
                <a href="{{ url('/calendario')}}" class="list-group-item list-group-item-action">Reservar un Centro de cómputo</a>

            </div>
        </div>
        <div class="col-md-9">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<h1>Registrar centro de cómputo</h1>




@if ($errors->any())

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
</div>


@endif
<form action="{{ url ('salas') }}" method="post">
    @csrf

    <div class="mb-3-row">
        <label for="numeroDeSalaComputo" class="col-sm-5 col-form-label">Número de centro de cómputo</label>
        <div class="col-sm-2">
            <input type="number" class="form-control" name="numeroDeSalaComputo" id="numeroDeSalaComputo" value="{{ old('numeroDeSalaComputo')}}">
        </div>
    </div>


    <div class="mb-3-row">
        <label for="matricula" class="col-sm-5 col-form-label">Nombre de centro de cómputo</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="nombreSalaComputo" id="nombreSalaComputo" value="{{ old('nombreSalaComputo')}}" required>
        </div>
    </div>


    <div class="mb-3-row">
        <label for="matricula" class="col-sm-5 col-form-label">Ubicación de centro de cómputo</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="ubicacionCentroComputo" id="ubicacionCentroComputo" value="{{ old('ubicacionCentroComputo')}}" required>
        </div>
    </div>


    <div class="mb-3-row">
        <label for="matricula" class="col-sm-5 col-form-label">Descripción de centro de cómputo</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="descripcionCentroComputo" id="descripcionCentroComputo" value="{{ old('descripcionCentroComputo')}}" required>
        </div>
    </div>

<!-- El campo ESTADO no es visible para el usuario. -->

    <div class="mb-3-row">
        <label for="matricula" class="col-sm-5 col-form-label"></label>
        <div class="col-sm-5">
            <input type="hidden" class="form-control" name="estadoOcupado" id="estadoOcupado" value="0">
        </div>
    </div>


    <div class="mb-3-row">
        <label for="matricula" class="col-sm-5 col-form-label">Fecha de agregado del centro de cómputo</label>
        <div class="col-sm-5">
            <input type="date" class="form-control" name="fechaDeAgregadoComputo" id="fechaDeAgregadoComputo" value="{{ old('fechaDeAgregadoComputo')}}" required>
        </div>
    </div>
<a href="{{ url('salas')}}" class="btn btn-secondary">Regresar</a>

<button type="submit" class="btn btn-success">Guardar</button>
</form>


<!-- Agrega la referencia a los archivos de Bootstrap JS al final del cuerpo -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
