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
                <a href="#" class="list-group-item list-group-item-action active">Inicio</a>
                <a href="{{ url('/dashboard')}}" class="list-group-item list-group-item-action">Panel</a>
                <a href="{{ url('/salas')}}" class="list-group-item list-group-item-action">Lista de Centros de cómputo</a>
                <a href="{{ url('/calendario')}}" class="list-group-item list-group-item-action">Reservar un Centro de cómputo</a>

            </div>
        </div>
        <div class="col-md-9">
            <h1>Bienvenido</h1>
            <!-- Contenido del panel de administración aquí -->


            
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>



    <style>
        
    </style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<!------ Cargar hoja CSS con estilo de las tarjetas ---------->
<link rel="stylesheet" href="css/stylehome.css">


<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Consulta SQL para contar los registros en la tabla 'salas'
$sql = "SELECT COUNT(*) as count FROM salas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $count = $row["count"];
    }
} else {
    $count = 0; // No se encontraron registros
}


//contador de solicitudes
$sql2 = "SELECT COUNT(*) as count FROM solicitudes";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $count2 = $row2["count"];
    }
} else {
    $count2 = 0; // No se encontraron registros
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card-counter info">
                <a href="{{ url('/salas') }}" class="card-link custom-link">
                    <i class="fa fa-desktop"></i>
                    <span class="count-numbers"><?php echo $count; ?></span>
                    <span class="count-name">Centros de Cómputo</span>
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-counter success">
                <a href="{{ url('/dashboard') }}" class="card-link custom-link">
                    <i class="fa fa-calendar"></i>
                    <span class="count-numbers"><?php echo $count2; ?></span>
                    <span class="count-name">Total de reservas</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-link {
        color: #ffffff; /* Cambiamos el color del enlace a blanco */
        text-decoration: none; /* Quitamos la decoración de texto (subrayado) */
    }

    .custom-link:hover {
        color: #ddd; /* Mantenemos el color del enlace blanco al pasar el mouse */
    }
</style>









<!-- Agrega la referencia a los archivos de Bootstrap JS al final del cuerpo -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
