<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Agrega la biblioteca SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>Document</title>
</head>
<body>

<?php
// Conexion a la base de datos
require_once('bdd.php');
// Verificar que se han enviado los datos necesarios
if (isset($_POST['titulo']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
    $titulo = $_POST['titulo'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = $_POST['color'];
    $descripcion = $_POST['descripcion'];
    
    $usuarios_idUsuario= $_POST['usuarios_idUsuario'];
    $salas_idSala = $_POST['salas_idSala'];

    // Verificar si ya existe un registro con las mismas fechas y misma sala
    $sql_check = "SELECT COUNT(*) FROM solicitudes 
                  WHERE ((start <= '$start' AND end >= '$start') OR (start <= '$end' AND end >= '$end')) 
                  AND salas_idSala = '$salas_idSala'";
    
    $query_check = $bdd->prepare($sql_check);
    $query_check->execute();
    $result = $query_check->fetchColumn();

    if ($result > 0) {
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "La reserva del centro de cómputo coincide con una existente. INTENTE NUEVAMENTE"
        }).then(() => {
            // Redirecciona a calendario.php después de la confirmación de SweetAlert2
            window.location.href = "calendario";
        });
        </script>';
    } else {
        // No existe un registro con las mismas fechas y misma sala, puedes realizar la inserción.
        $sql = "INSERT INTO solicitudes (titulo, start, end, color, descripcion, usuarios_idUsuario, salas_idSala) 
                VALUES ('$titulo', '$start', '$end', '$color','$descripcion','$usuarios_idUsuario','$salas_idSala')";
        
        $query = $bdd->prepare($sql);
        
        if ($query == false) {
            print_r($bdd->errorInfo());
            die ('Error al preparar consulta');
        }
        
        $sth = $query->execute();

        if ($sth == true) {
            // Inserción exitosa, muestra el mensaje de éxito con SweetAlert
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "Éxito",
                text: "La reserva del centro de cómputo se ha realizado correctamente."
            }).then(() => {
                // Redirecciona a la página deseada después de la confirmación de SweetAlert2
                window.location.href = "calendario";
            });
            </script>';
        } else {
            print_r($query->errorInfo());
            die ('Error al ejecutar consulta SQL');
        }
    }
}
?>

    
</body>
</html>