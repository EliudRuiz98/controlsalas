    <?php
    require('fpdf.php');


    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD

        //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
        //$dato_info = $consulta_info->fetch_object();
        $this->Image('tecnmLogo.png', 260, 10, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
        $this->Image('educLogo.png', 20, 14, 60);
        $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(40); // Movernos a la derecha
        $this->SetTextColor(0,200, 0); //color
        //creamos una celda o fila
        $this->Cell(220, 15, utf8_decode('Instituto Tecnológico del Altiplano de Tlaxcala'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
        $this->Ln(1); // Salto de línea
        $this->SetTextColor(103); //color
        

        /* UBICACION */
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Ubicación: San Martin-Tlaxcala Km 7.5, Centro, 90122 San Diego Xocoyucan, Tlax."), 0, 0, '', 0);
        $this->Ln(5);

        /* TELEFONO */
        $this->Cell(10);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Teléfono: 248 481 7247"), 0, 0, '', 0);
        $this->Ln(10);

         /* Oficina de C Cómputo */
         $this->Cell(10);  // mover a la derecha
         $this->SetFont('Arial', 'B', 10);
         $this->Cell(59, 1, utf8_decode("Oficina de Centro de Cómputo"), 0, 0, '', 0);
         $this->Ln(10);
        

        /* TITULO DE LA TABLA */
        //color

        
        $this->SetTextColor(49,176, 213);
        $this->Cell(50); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(190, 10, utf8_decode("REPORTE DE RESERVA DE CENTROS DE CÓMPUTO "), 0, 1, 'C', 0);
        $this->Ln(7);

        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    
    }
    }


    //conexión a bd
    $mysqli = new mysqli ("localhost","root","","reservas");

    //traer los datos a una variable
    $consulta = "SELECT solicitudes.*, usuarios.nombreUsuario,salas.*
    FROM solicitudes
    INNER JOIN usuarios ON solicitudes.usuarios_idUsuario = usuarios.idUsuario
    INNER JOIN salas ON solicitudes.salas_idSala = salas.idSala";
    



    $resultado = $mysqli->query($consulta);





    $pdf = new PDF('L');
    $pdf -> AliasNBPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',9);
    

    //campos predefinidos

    $pdf->Cell(45,10, 'Titulo',1,0,'C',0);
    $pdf->Cell(45,10, 'Inicio',1,0,'C',0);
    $pdf->Cell(45,10, 'Final',1,0,'C',0);
    $pdf->Cell(45,10, 'Descripcion',1,0,'C',0);
    $pdf->Cell(45,10, 'Usuario',1,0,'C',0);
    $pdf->Cell(50,10, 'Sala',1,1,'C',0);

   
   //campos de la bd
$pdf->SetFont('Arial','',8);
while($row = $resultado->fetch_assoc()){
    // Formatea la fecha y hora de inicio
    $fecha_inicio = date('d/m/Y', strtotime($row['start'])); // Solo la fecha de inicio
    $hora_inicio = date('H:i', strtotime($row['start'])); // Solo la hora de inicio
    $hora_inicio_format = $hora_inicio . ' horas'; // Formatea la hora de inicio

    // Formatea la fecha y hora de fin
    $fecha_fin = date('d/m/Y', strtotime($row['end'])); // Solo la fecha de fin
    $hora_fin = date('H:i', strtotime($row['end'])); // Solo la hora de fin
    $hora_fin_format = $hora_fin . ' horas'; // Formatea la hora de fin

    $pdf->Cell(45,10, utf8_decode($row['titulo']),1,0,'C',0);
    // Se muestra la fecha y hora de inicio formateada
    $pdf->Cell(45,10, $fecha_inicio . ' a las ' . $hora_inicio_format,1,0,'C',0);
    // Se muestra la fecha y hora de fin formateada
    $pdf->Cell(45,10, $fecha_fin . ' a las ' . $hora_fin_format,1,0,'C',0);
    $pdf->Cell(45,10, utf8_decode($row['descripcion']),1,0,'C',0);
    $pdf->Cell(45,10, utf8_decode($row['nombreUsuario']),1,0,'C',0);
    $pdf->Cell(50,10, utf8_decode($row['nombreSalaComputo']),1,1,'C',0);
}




    $pdf->Output();
    ?>