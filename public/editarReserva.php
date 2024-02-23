<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- Carga de Sweetalert a través de CDN --> 
      <!-- CSS de SweetAlert2 desde CDN -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
      <!-- JS de SweetAlert2 desde CDN -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
</head>
<body>
	

<?php
// Conexion a la base de datos
require_once('bdd.php');

if (isset($_POST['delete']) && isset($_POST['idSolicitud'])){
    // eliminar un registro recuperado por el id
    $idSolicitud = $_POST['idSolicitud'];
    
    $sql = "DELETE FROM solicitudes WHERE idSolicitud = :idSolicitud";
    $query = $bdd->prepare($sql);
    $query->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);
    
    if ($query == false) {
        print_r($bdd->errorInfo());
        die ('Error al eliminar');
    }

    $res = $query->execute();

    if ($res == false) {
        print_r($query->errorInfo());
        die ('Error al ejecutar');
    }


    //una vez eliminado, redireccionar al calendario
    header("Location: calendario");
    die();
} elseif (isset($_POST['titulo']) && isset($_POST['color']) && isset($_POST['idSolicitud'])){
    $idSolicitud = $_POST['idSolicitud'];
    $titulo = $_POST['titulo'];
    $color = $_POST['color'];
    // nuevos campos
    $descripcion = $_POST['descripcion'];
    $usuarios_idUsuario = $_POST['usuarios_idUsuario'];
    $salas_idSala = $_POST['salas_idSala'];
    
    // campos fecha
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Verificar duplicidad
    $sql_check = "SELECT COUNT(*) FROM solicitudes 
                  WHERE ((start <= :start AND end >= :start) OR (start <= :end AND end >= :end)) 
                  AND salas_idSala = :salas_idSala AND idSolicitud <> :idSolicitud";
    
    $query_check = $bdd->prepare($sql_check);
    $query_check->bindParam(':start', $start, PDO::PARAM_STR);
    $query_check->bindParam(':end', $end, PDO::PARAM_STR);
    $query_check->bindParam(':salas_idSala', $salas_idSala, PDO::PARAM_INT);
    $query_check->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);
    
    $query_check->execute();
    $result = $query_check->fetchColumn();

    if ($result > 0) {
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "La reserva del centro de cómputo coincide con una existente. INTENTE NUEVAMENTE"
        }).then(() => {
            window.location.href = "calendario";
        });
        </script>';
    } else {
        // Actualización
        $sql = "UPDATE solicitudes 
                SET titulo = :titulo, color = :color, start = :start, end = :end, descripcion = :descripcion, 
                usuarios_idUsuario = :usuarios_idUsuario, salas_idSala = :salas_idSala
                WHERE idSolicitud = :idSolicitud ";

        $query = $bdd->prepare($sql);

        $query->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $query->bindParam(':color', $color, PDO::PARAM_STR);
        $query->bindParam(':start', $start, PDO::PARAM_STR);
        $query->bindParam(':end', $end, PDO::PARAM_STR);
        $query->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $query->bindParam(':usuarios_idUsuario', $usuarios_idUsuario, PDO::PARAM_INT);
        $query->bindParam(':salas_idSala', $salas_idSala, PDO::PARAM_INT);
        $query->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);

        $sth = $query->execute();

        if ($sth == true) {
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "La reserva del centro de cómputo se ha actualizado correctamente"
            }).then(() => {
                window.location.href = "calendario";
            });
            </script>
        ';
        } else {
            print_r($query->errorInfo());
            die ('Error al ejecutar SQL');
        }
    }
}

?>



	
</body>
</html>