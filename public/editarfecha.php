<?php

// Conexion a la base de datos
require_once('bdd.php');

/* Maneja la actualización de eventos en la base de datos
cuando se recibe una solicitud POST con valores
para 'id', 'start', y 'end' en una matriz llamada 'Event'.*/

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {

    $idSolicitud = $_POST['Event'][0];
    $start = $_POST['Event'][1];
    $end = $_POST['Event'][2];

    // Obtener la sala asociada a la solicitud
    $sql_get_sala = "SELECT salas_idSala FROM solicitudes WHERE idSolicitud = :idSolicitud";
    $query_get_sala = $bdd->prepare($sql_get_sala);
    $query_get_sala->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);
    $query_get_sala->execute();
    $result_sala = $query_get_sala->fetch(PDO::FETCH_ASSOC);

    $salas_idSala = $result_sala['salas_idSala'];

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
        echo 'Error: La reserva del centro de cómputo coincide con una existente. INTENTE NUEVAMENTE';
    } else {
        // Actualización
        $sql = "UPDATE solicitudes SET start = :start, end = :end WHERE idSolicitud = :idSolicitud ";

        $query = $bdd->prepare($sql);

        $query->bindParam(':start', $start, PDO::PARAM_STR);
        $query->bindParam(':end', $end, PDO::PARAM_STR);
        $query->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);

        $sth = $query->execute();

        if ($sth == true) {
            echo 'OK';
        } else {
            print_r($query->errorInfo());
            echo 'Error: No se pudo actualizar la reserva del centro de cómputo.';
        }
    }
}
?>