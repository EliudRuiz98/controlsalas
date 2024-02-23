<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FullCalendar -->
    <link href='css/fullcalendar.css' rel='stylesheet' />

    <!-- Carga de Sweetalert a través de CDN --> 
      <!-- CSS de SweetAlert2 desde CDN -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
      <!-- JS de SweetAlert2 desde CDN -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <!-- CSS -->
    <style>
        body {
            padding-top: 0px;
        }

        #calendar {
            max-width: 800px;
        }

        .col-centered {
            float: none;
            margin: 0 auto;
        }
    </style>
</head>
<?php
require_once('bdd.php');

$sql = "SELECT idSolicitud, titulo, start, end, color, descripcion, usuarios_idUsuario, salas_idSala FROM solicitudes";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();

// Seleccionar los datos de la tabla 'usuarios' para el formulario
$sqlUsuario = "SELECT idUsuario, nombreUsuario FROM usuarios";
$resultado = $bdd->query($sqlUsuario);

// Seleccionar los datos de la tabla 'salas' para el formulario
$sqlSalas = "SELECT idSala, nombreSalaComputo FROM salas";
$resultadoSala = $bdd->query($sqlSalas);

// Inicializar arrays para las listas de usuarios y salas
$listaUsuario = array();
$listaSala = array();

// Iterar sobre los resultados y llenar las listas
while ($filaUsuario = $resultado->fetch()) {
    $valorUsuario = $filaUsuario["idUsuario"];
    $nUsuario = $filaUsuario["nombreUsuario"];
    $listaUsuario[$valorUsuario] = $nUsuario;
}

while ($filaSala = $resultadoSala->fetch()) {
    $valorSala = $filaSala["idSala"];
    $nSala = $filaSala["nombreSalaComputo"];
    $listaSala[$valorSala] = $nSala;
}

// Cerrar la conexión a la base de datos
$bdd = null;
?>


<body>
    






    <!-- Contenido de página -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Control de centros de cómputo</h1>
                <div id="calendar" class="col-centered"></div>
            </div>
        </div>
        
        <!-- /.row -->

        <!-- Ventana Modal para crear evento-->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="addEvent.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar Reserva</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="titulo" class="form-control" id="titulo"
                                        placeholder="Titulo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar</option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                        <option style="color:#000;" value="#000">&#9724; Negro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="start" class="form-control" id="start"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="end" class="form-control" id="end"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <input type="text" name="descripcion" class="form-control" id="descripcion"
                                        placeholder="Descripción">
                                </div>
                            </div>
                            


                            
<?php


//Campos del formulario donde se elige el centro de computo y la persona que lo reserva
echo '<div class="form-group">
    <label for="usuarios_idUsuario" class="col-sm-2 control-label">Nombre de Usuario</label>
    <div class="col-sm-10">'; // Agrega un div con clase "col-sm-10"


// Para las opciones de usuario
    echo "<select name='usuarios_idUsuario' id='usuarios_idUsuario' class='form-control'>";
    foreach ($listaUsuario as $valorUsuario => $nUsuario) {
        echo "<option value='$valorUsuario'>$nUsuario</option>";
    }
    echo "</select>";
echo '</div>
</div>';

echo '<div class="form-group">
    <label for="salas_idSala" class="col-sm-2 control-label">Nombre Sala</label>
    <div class="col-sm-10">'; // Agrega un div con clase "col-sm-10"

// Generar el HTML de la lista
// Para las opciones de sala
echo "<select name='salas_idSala' id='salas_idSala' class='form-control'>";
foreach ($listaSala as $valorSala => $nSala) {
    echo "<option value='$valorSala'>$nSala</option>";
}
echo "</select>";

echo '</div>
</div>';

?>



                            <div class="form-group">

                            </div>
                            <input type="hidden" name="idSolicitud" class="form-control" id="idSolicitud">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Ventana modal para editar evento -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="editarReserva.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modificar Reserva</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="titulo" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="titulo" class="form-control" id="titulo"
                                        placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar</option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                        <option style="color:#000;" value="#000">&#9724; Negro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="start" class="form-control" id="start"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="end" class="form-control" id="end"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-10">
                                    <input type="text" name="descripcion" class="form-control" id="descripcion"
                                        placeholder="Descripción">
                                </div>
                            </div>
                            


                            
                            <?php


//Campos del formulario donde se elige el centro de computo y la persona que lo reserva
echo '<div class="form-group">
    <label for="usuarios_idUsuario" class="col-sm-2 control-label">Nombre de Usuario</label>
    <div class="col-sm-10">'; // Agrega un div con clase "col-sm-10"


// Para las opciones de usuario
    echo "<select name='usuarios_idUsuario' id='usuarios_idUsuario' class='form-control'>";
    foreach ($listaUsuario as $valorUsuario => $nUsuario) {
        echo "<option value='$valorUsuario'>$nUsuario</option>";
    }
    echo "</select>";
echo '</div>
</div>';

echo '<div class="form-group">
    <label for="salas_idSala" class="col-sm-2 control-label">Nombre Sala</label>
    <div class="col-sm-10">'; // Agrega un div con clase "col-sm-10"

// Generar el HTML de la lista
// Para las opciones de sala
echo "<select name='salas_idSala' id='salas_idSala' class='form-control'>";
foreach ($listaSala as $valorSala => $nSala) {
    echo "<option value='$valorSala'>$nSala</option>";
}
echo "</select>";

echo '</div>
</div>';

?>



<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="eliminarEventoCheckbox" name="delete">
      <label class="form-check-label" for="eliminarEventoCheckbox">
        <span class="text-dark" id="labelEliminarEvento">Eliminar Evento</span>
      </label>
    </div>
  </div>
</div>

<!-- SCRIPT PARA ELIMINAR UN REGISTRO, AL MARCAR EL CHECHBBOX, ESTE CAMBIA DE COLOR A ROJO-->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('eliminarEventoCheckbox');
    const spanLabel = document.getElementById('labelEliminarEvento');

    checkbox.addEventListener('change', function () {
      if (checkbox.checked) {
        spanLabel.classList.add('text-danger'); // Agrega la clase de texto rojo de Bootstrap
      } else {
        spanLabel.classList.remove('text-danger'); // Remueve la clase de texto rojo
      }
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('eliminarEventoCheckbox');
    const spanLabel = document.getElementById('labelEliminarEvento');

    checkbox.addEventListener('change', function () {
      if (checkbox.checked) {
        spanLabel.classList.add('text-danger'); // Agrega la clase de texto rojo de Bootstrap
        // Muestra un mensaje de advertencia usando SweetAlert2
        Swal.fire({
          title: '¡Atención!',
          text: 'Esta acción no se puede deshacer. ¿Estás seguro de que quieres eliminar este evento?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Continuar'
        }).then((result) => {
          if (result.isConfirmed) {
            // Aquí puedes agregar la lógica para eliminar el evento
            // Puedes usar AJAX o enviar el formulario, según cómo estés manejando las operaciones en tu aplicación
            // Ejemplo: eliminaEvento();
          } else {
            checkbox.checked = false; // Desmarca la casilla si el usuario cancela la acción
            spanLabel.classList.remove('text-danger'); // Remueve la clase de texto rojo
          }
        });
      } else {
        spanLabel.classList.remove('text-danger'); // Remueve la clase de texto rojo si la casilla está desmarcada
      }
    });
  });
</script>

                            <input type="hidden" name="idSolicitud" class="form-control" id="idSolicitud">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container aquí finaliza la ventana modal -->



    
    

    <!-- jQuery, este podía eliminarse
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>-->
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- FullCalendar -->
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.js'></script>
    <script src='js/fullcalendar/locale/es.js'></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        $(document).ready(function () {
            //formatear la fecha recogida del formulario HTML5.
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();
            //inicializar el calendario
            $('#calendar').fullCalendar({
                header: {

                    
                    language: 'es', //lenguaje español
                    left: 'prev,next, today', //botones arr izq
                    center: 'title',
                    right: 'month,basicWeek,basicDay',
                     //botonez arrder
                },
                defaultDate: yyyy + "-" + mm + "-" + dd, //fecha predeterminda al cargar el calendario
                editable: true, //permite que sean  arrastrables
                eventLimit: true, // link + cuando son muchos eventos
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function (event, element) {
                    //cargar 1 evento en la ventana modal
                    element.bind('click', function () {
                        $('#ModalEdit #idSolicitud').val(event.idSolicitud);
                        $('#ModalEdit #titulo').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        
                        $('#ModalEdit #start').val(event.start.format('YYYY-MM-DD HH:mm:ss'));
                        if (event.end) {
                            $('#ModalEdit #end').val(event.end.format('YYYY-MM-DD HH:mm:ss'));
                            
                        } else {
                            $('#ModalEdit #end').val(event.start.format('YYYY-MM-DD HH:mm:ss'));
                        }
                        $('#ModalEdit #descripcion').val(event.descripcion); //este no lo he podido recuperar
                        $('#ModalEdit #salas_idSala').val(event.salas_idSala);
                        $('#ModalEdit #usuarios_idUsuario').val(event.usuarios_idUsuario);
                        $('#ModalEdit').modal('show');
                    });
                },
                eventDrop: function (event, delta, revertFunc) { // si se arrastra evento
                    edit(event);
                },
                eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si se redimenciona
                    edit(event);
                },
                /*EVENTS:
                Aquí se definen los eventos que se mostrarán en el calendario. Se utiliza un bucle foreach en PHP para
                recorrer los eventos obtenidos de la base de datos
                y se los formatea en el formato esperado por FullCalendar*/
                events: [
                    <?php foreach ($events as $event) :
                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);
                        if ($start[1] == '00:00:00') {
                            $start = $start[0];
                        } else {
                            $start = $event['start'];
                        }
                        if ($end[1] == '00:00:00') {
                            $end = $end[0];
                        } else {
                            $end = $event['end'];
                        }
                    ?>
                    {
                        //este script primero recoge toodos los datos del calendario
                        //y despues podran ser editados 1 x 1, se requiere de la SQL del principio
                        idSolicitud: '<?php echo $event['idSolicitud']; ?>',
                        title: '<?php echo $event['titulo']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        color: '<?php echo $event['color']; ?>',
                        descripcion: '<?php echo $event['descripcion']; ?>',
                        usuarios_idUsuario: '<?php echo $event['usuarios_idUsuario']; ?>',
                        salas_idSala: '<?php echo $event['salas_idSala']; ?>',
                        


                        
                    },
                    <?php endforeach; ?>
                ]
            });

            function edit(event) {
                /* start =event.star.format----
                Esta línea obtiene la fecha de
                inicio del evento que se está editando y la formatea
                en una cadena con el formato "YYYY-MM-DD HH:mm:ss*/
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                } else {
                    end = start;
                }
                idSolicitud = event.idSolicitud;
                Event = [];
                Event[0] = idSolicitud;
                Event[1] = start;
                Event[2] = end;
                $.ajax({
                    url: 'editarfecha.php',
                    type: "POST",
                    data: { Event: Event },
                    success: function (rep) {
                        if (rep == 'OK') {
                            Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La reserva del centro de cómputo se ha actualizado correctamente',
                });
                        } else {
    // SweetAlert para mensajes de error
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La reserva del centro de cómputo coincide con una ya existente',
    }).then(function () {
        location.reload();
    });
}

                    }
                });
            }
			
        });
    </script>



<div class="container-fluid">
  <div class="row">
    <div class="col-6 text-center">
      <!-- Enlace "Regresar" ubicado en la parte superior izquierda -->
      <a href="../public/home" class="btn btn-primary">Regresar</a>
    </div>
  </div>
</div>

</body>




   </body>
</html>