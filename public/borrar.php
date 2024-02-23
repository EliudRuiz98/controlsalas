    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idSolicitud'])) {
        $solicitud_id = $_POST['idSolicitud'];
        
        // Realiza la eliminación en la base de datos 
        $mysqli = new mysqli("localhost", "root", "", "reservas");
        $consulta = "DELETE FROM solicitudes WHERE idSolicitud = ?";
        
        if ($stmt = $mysqli->prepare($consulta)) {
            $stmt->bind_param("i", $solicitud_id);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();

            
            $mensaje_exito = "La reserva de centro de cómputo ha sido eliminada con éxito.";

            // Redirecciona a la página de la tabla 
header('Location: ../public/dashboard?mensaje=' . urlencode($mensaje_exito));

        } else {
            echo "Error al preparar la consulta.";
        }
    } else {
        echo "Solicitud no válida.";
    }
    ?>
