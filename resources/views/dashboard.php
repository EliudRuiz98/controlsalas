<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

      <!-- Carga de Sweetalert a través de CDN --> 
      <!-- CSS de SweetAlert2 desde CDN -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
      <!-- JS de SweetAlert2 desde CDN -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

      <title></title>


      <!-- Carga de Bootstrap y jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Instituto Tecnológico del Altiplano de Tlaxcala</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="ruta_a_tu_inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ruta_a_tus_centros.php">Centros de cómputo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ruta_a_tus_modulos.php">Otros módulos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

      
      <div class="container mt-4">
         <div class="row">
            <div class="col-md-3">
               <div class="list-group">
                  <a href="../public/home" class="list-group-item list-group-item-action">Inicio</a>
                  <a href="#" class="list-group-item list-group-item-action active">Panel</a>
                  <a href="../public/salas" class="list-group-item list-group-item-action">Lista de Centros de cómputo</a>
                  <a href="../public/calendario" class="list-group-item list-group-item-action">Reservar un Centro de cómputo</a>
               </div>
            </div>
            <div class="col-md-9">
               <h1>Bienvenido</h1>

               <!-- Contenido del panel de administración aquí -->

               
               <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

               <div class="container-fluid">
                  <div class="row">
                     <div class="col-6"></div>
                     <div class="col-6 text-right">
                        <!-- Enlace "Imprimir" ubicado en la parte superior derecha -->
                        <a href="fpdf/reporte.php" class="btn btn-success">Imprimir</a>
                     </div>
                  </div>
               </div>

               <?php
// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "reservas");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Consulta SQL
$consulta = "SELECT solicitudes.*, usuarios.nombreUsuario,salas.*
              FROM solicitudes
              INNER JOIN usuarios ON solicitudes.usuarios_idUsuario = usuarios.idUsuario
              INNER JOIN salas ON solicitudes.salas_idSala = salas.idSala";
$resultado = $mysqli->query($consulta);

if ($resultado->num_rows > 0) {
    echo '<div class="table-responsive"><table class="table table-bordered">
                 <thead>
                 <tr>
                 <th>Titulo</th>
                 <th>Inicio</th>
                 <th>Final</th>
                 <th>Descripción</th>
                 <th>Usuario</th>
                 <th>Sala</th>
                 </tr>
                 </thead>
                 <tbody>';

    while ($fila = $resultado->fetch_assoc()) {
        // Formatear la fecha y hora
        $inicio_formateado = date("d/m/Y", strtotime($fila['start'])) . " a las " . date("H:i", strtotime($fila['start'])) . " horas";
        $final_formateado = date("d/m/Y", strtotime($fila['end'])) . " a las " . date("H:i", strtotime($fila['end'])) . " horas";

        echo '<tr>
                    <td>' . $fila['titulo'] . '</td>
                    <td>' . $inicio_formateado . '</td>
                    <td>' . $final_formateado . '</td>
                    <td>' . $fila['descripcion'] . '</td>
                    <td>' . $fila['nombreUsuario'] . '</td>
                    <td>' . $fila['nombreSalaComputo'] . '</td>
                    <td>
                        <form id="formBorrar' . $fila['idSolicitud'] . '" class="form-horizontal" method="POST" action="borrar.php" onsubmit="return confirmarBorrado(' . $fila['idSolicitud'] . ')">
                            <input type="hidden" name="idSolicitud" value="' . $fila['idSolicitud'] . '">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>';
    }

    echo '</tbody>
                 </table> </div>';
} else {
    echo "No se encontraron registros.";
}

// Cerrar la conexión
$mysqli->close();
?>


               

<script>
    function confirmarBorrado(idSolicitud) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede revertir',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                // Agrega el ID al formulario antes de submitir
                document.querySelector('input[name="idSolicitud"]').value = idSolicitud;
                // Dispara manualmente el evento submit del formulario
                document.getElementById('formBorrar' + idSolicitud).submit();
            }
        });
        return false; // Evita que el formulario se envíe automáticamente después de la confirmación
    }
</script>

<?php


// Verifica si hay un mensaje y lo muestra
if (isset($_GET['mensaje'])) {
    echo '<script>
              Swal.fire({
                  icon: "success",
                  title: "Éxito",
                  text: "' . htmlspecialchars($_GET['mensaje']) . '",
              });
          </script>';
}
?>

       
            </div>
         </div>
      </div>
   </body>
</html>
