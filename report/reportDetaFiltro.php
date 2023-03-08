<?php
//Definir concepto horaria
date_default_timezone_set("America/Lima");
$diassemana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fechHoraActual = $diassemana[date('w')] . " " . date('d') . " de " .
    $meses[date('n') - 1] . " del " . date('Y') . " " . date("h:i a");

session_start();

if (!isset($_SESSION['S_IDUSUARIO_SC'])) {
    header('Location: ../index.php');
}


$fechActual = date('d_m_Y');
$NomDocumento = "R_DETALLE_$fechActual";
// $NomPdf=x;
ob_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $NomDocumento ?></title>
    <link rel="icon" type="image" href="img/logoMuni.jpg">

    <style>
        /* Cabecera */
        header {
            position: fixed;
            /* background: #008080; */
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        div.menu {
            display: inline;
            width: 100%;
        }

        div.menu img.LogoNomMuni {
            float: right;
            margin-top: 5px;
            margin-right: 15px;
        }

        div.menu h4.txtCabePag {
            text-align: right;
            vertical-align: bottom;
            margin-right: 15px;
            font-weight: normal;
            font-size: 15px;
        }

        /* Pied Pag */
        footer {
            position: fixed;
            /* background: #00FFFF; */
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1.5cm;
        }

        div.menuPie {
            display: inline;
            width: 100%;
        }

        div.menuPie img.LogoMuni {
            float: left;
            margin-left: 92%;
        }

        div.menuPie h4.txtPiePag {
            text-align: left;
            margin-left: 25px;
            font-weight: normal;
            font-size: 15px;
        }

        /* div.menuPie h4.NumPag{
        text-align: left;
        margin-left: 85%;

    } */
        /* .footer .page-number:after { content: counter(page); } */

        /* Contenido Principal - Body */
        body {
            margin-top: 2cm;
            margin-left: 0cm;
            margin-right: 0.5cm;
            margin-bottom: 2.5cm;
            /* background: #7fff00; */
        }

        .linea1 {
            border-top: 1px solid black;
            height: 2px;
            max-width: 100%;
            padding: 0;
            /* Arriba | Derecha | Abajo | Izquierda */
            margin: 5px 0 5px 0;
        }

        .linea2 {
            border-top: 1px solid black;
            height: 2px;
            max-width: 100%;
            padding: 0;
            /* Arriba | Derecha | Abajo | Izquierda */
            margin: 5px 0 15px 0;
        }

        .titulo1 {
            text-align: center;
            font-style: bold;
            /* background: #7fff00; */
            /* padding: 90%; */
        }

        .descrip1 {
            text-align: left;
            font-style: italic;
            font-size: 14px;

        }

        main.contenido {
            /* background: #a52a2a; */
            margin-top: 0cm;
        }

        h2,
        h3 {
            text-align: center;
            vertical-align: middle;
        }

        /* Diseño tabla */
        table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
        }



        th,
        td {
            width: 25%;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 0.3em;
            caption-side: bottom;
            font-size: 14px;
        }

        th {
            background: #F9F9F4;
            color: black;
        }
    </style>

</head>

<body>

    <!-- Cabecera de pag -->
    <header>
        <div class="menu">
            <img class="LogoNomMuni" src="img/logo.png" alt="" width="22%" />
            <h4 class="txtCabePag"> <i> <?php echo  $fechHoraActual; ?></i></h4>
        </div>
    </header>
    <!-- Pie de pag -->
    <footer>
        <div class="menuPie">
            <!-- <img class="LogoMuni" src="img/logoMuni.jpg" width="7.5%"/> -->
            <h4 class="txtPiePag"> &copy; Copyright UNPRG - Todos los derechos reservados.</h4>
            <!-- <h4 class="NumPag"> Página 2 de 4 </h4> -->
            <!-- <span class="page-number">Page </span> -->

        </div>
    </footer>
    <!-- Contenido de pag -->
    <main class="contenido">
        <div class="contenido-primario">
            <div class="linea1"></div>
            <!-- <span class="titulo1">REPORTE DE: </span> -->
            <section class="titulo1"> REPORTE DE DETALLE DE ASIENTOS</section>
            <div class="linea1"></div>

            <div class="linea2"></div>
            <?php

            require('../models/reporteModelo.php');
            $MR =  new reporteModelo();

            $consulta = $MR->Listar_Deta_Reporte();

            ?>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">



                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla_equipo" class="display">
                                        <thead>

                                            <tr>
                                                <th>#</th>
                                                <th>DEBE</th>
                                                <th>HABER</th>
                                                <th>IMPORTE SOLES</th>
                                                <th>IMPORTE DOLARES</th>
                                                <th>ESTADO</th>
                                                <th>CUENTA CONTABLE</th>
                                                <th>DOCUMENTO</th>


                                        </thead>
                                        <tbody>

                                            <?php $contador = 1;
                                            foreach ($consulta as $data) { ?>

                                                <tr>
                                                    <td style="width:10px"> <?php echo $contador ?> </td>
                                                    <td style="width:90px"> <?php echo $data['da_debe']; ?> </td>
                                                    <td style="width:40px"> <?php echo $data['da_haber']; ?> </td>
                                                    <td style="width:90px"> <?php echo $data['da_importesol']; ?> </td>
                                                    <td style="width:58px"> <?php echo $data['da_importedol']; ?> </td>
                                                    <td style="width:90px"> <?php echo $data['ac_estado']; ?> </td>
                                                    <td style="width:85px"> <?php echo $data['ccontable']; ?> </td>
                                                    <td style="width:85px"> <?php echo $data['do_tipo']; ?> </td>
                                                </tr>
                                            <?php $contador++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </main>

</body>

</html>

<?php

$html = ob_get_clean();

require_once '../library/dompdf/autoload.inc.php';

use Dompdf\Dompdf; //para incluir el namespace de la librería
$dompdf = new Dompdf(); //crear el objeto de la clase Dompdf

//para datos e img
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

// Añadir el HTML a dompdf
$dompdf->loadHtml($html);

//Establecer el tamaño de hoja en DOMPDF
// $dompdf->setPaper('A4', 'portrait'); //vertical
$dompdf->set_paper('letter', 'landscape'); //esta es una forma de ponerlo horizontal


// Renderizar el PDF
$dompdf->render();

// Parameters
$x          = 688;
$y          = 551;
$text       = "Página {PAGE_NUM} de {PAGE_COUNT}";
$font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'blod');
$size       = 11;
$color      = array(0, 0, 0);
$word_space = 0.0;
$char_space = 0.0;
$angle      = 0.0;

$dompdf->getCanvas()->page_text(
    $x,
    $y,
    $text,
    $font,
    $size,
    $color,
    $word_space,
    $char_space,
    $angle
);


// Forzar descarga del PDF true si no false
$dompdf->stream("$NomDocumento.pdf", ["Attachment" => false]);
?>