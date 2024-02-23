<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Agrega la referencia a los archivos de Bootstrap CSS y JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- CSS de SweetAlert2 desde CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">

<!-- JS de SweetAlert2 desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

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
            <h1>Bienvenido</h1>
            <!-- Contenido del panel de administración aquí -->


            <main>
                <div class="container py-4">
    <h2>Listado de Centros de Cómputo</h2>
                
            <a href="{{ url('salas/create')}}" class="btn btn-primary">Registrar nuevo centro de cómputo</a>

                </div>
            </main>

            

            <div class="table-responsive">
  <table class="table">
 



    <thead>
        <tr>
            <th>Numero de sala de cómputo</th>
            <th>Nombre de sala de cómputo</th>
            <th>Ubicación</th>
            <th>Descripción</th>
            <th>Fecha de agregado</th>
        </tr>
    </thead>

    <tbody>
        @foreach($salas as $sala)
            <tr>
                <td>{{ $sala->numeroDeSalaComputo}}</td>
                <td>{{ $sala->nombreSalaComputo}}</td>
                <td>{{ $sala->ubicacionCentroComputo}}</td>
                <td>{{ $sala->descripcionCentroComputo}}</td>
              
                <td>{{ $sala->fechaDeAgregadoComputo}}</td>
                <td><a href="{{ url('salas/'.$sala->idSala.'/edit' ) }}" class="btn btn-warning btn-sm">Editar</a></td>
                <td>
                    <form action="{{  url('salas/'.$sala->idSala) }}" method="post">
                        @method("DELETE")
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
             </tr>
        @endforeach
    </tbody>
</table>



<!-- Script para la confirmación de eliminación con SweetAlertJS -->
<!-- Script para la confirmación de eliminación con SweetAlert2 -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Verificar si hay un mensaje de éxito o error en la sesión
        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ session('error') }}";

        // Solo ejecutar SweetAlert si hay un mensaje de éxito o error
        if (successMessage || errorMessage) {
            Swal.fire({
                position: "center",
                icon: successMessage ? 'success' : 'error',
                title: successMessage || errorMessage,
                showConfirmButton: true,
                timer: 15000
            });
        }

        // Resto del script para el manejo del botón eliminar
        var deleteButtons = document.querySelectorAll('.btn-danger');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede revertir',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.closest('form').submit();
                    }
                });
            });
        });
    });
</script>





</div>


            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->



        </div>
    </div>
</div>

<!-- Agrega la referencia a los archivos de Bootstrap JS al final del cuerpo -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
