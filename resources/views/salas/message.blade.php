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
                    <a class="nav-link" href="{{ url('/home')}}">link de prueba</a>

                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Inicio</a>
                <a href="#" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ url('/salas')}}" class="list-group-item list-group-item-action">Lista de Centros de cómputo</a>
                <a href="#" class="list-group-item list-group-item-action">Reservar un Centro de cómputo</a>

            </div>
        </div>
        <div class="col-md-9">
            <h1>Bienvenido</h1>
            <!-- Contenido del panel de administración aquí -->

<main>
    <div class="container py-4">
        <h2>{{$msg}}</h2>

        <a href="{{ url('salas')}}" class="btn btn-secondary">Regresar</a>
    </div>
</main>

            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <style>
        
    </style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<!------ Cargar hoja CSS con estilo de las tarjetas ---------->
<link rel="stylesheet" href="css/stylehome.css">


    </div>
  </div>
</div>

        </div>
    </div>
</div>



<!-- Agrega la referencia a los archivos de Bootstrap JS al final del cuerpo -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
