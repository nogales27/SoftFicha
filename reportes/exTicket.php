<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['ficha']==1)
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

//Incluímos la clase ficha
require_once "../modelos/Ficha.php";
//Instanaciamos a la clase con el objeto venta
$ficha = new Ficha();
//En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
$rspta = $ficha->fichacabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
$reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$empresa = "Hospital Señor de malta";
$direccion = "Calle Malta,Vallegrande";
$telefono = "931742904";
$email = "senordemarta@gmail.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        .::<strong> <?php echo $empresa; ?></strong>::.<br>
       
        <?php echo $direccion .' - '.'Telef:'.' '.$telefono; ?><br>
        </td>
    </tr>
    
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del en el documento HTML -->
        <td><b>Paciente:</b> <?php echo $reg->paciente."  ".$reg->apellidos; ?></td>
        
    </tr>
    <tr>
        <!-- Mostramos los datos del en el documento HTML -->
        <td><b>CI:</b><?php echo $reg->ci; ?></td>
        
    </tr>
    <tr>
        <!-- Mostramos los datos del  en el documento HTML -->
        <
        <td><b>Especialidad:</b> <?php echo $reg->especialidad; ?></td>
    </tr>
    <tr>
        
    </tr>
    <tr>
        <td><b>N° Ficha:</b><?php echo $reg->nroficha; ?></td>
    </tr>  
    <tr>
        <!-- Mostramos los datos del en el documento HTML -->
        <td><b>Turno: </b><?php echo $reg->turno; ?></td>
     
    </tr>
    <tr>
        <!-- Mostramos los datos del  en el documento HTML -->
        <td><b>Fecha Atención: </b><?php echo $reg->fecha; ?></td>
      
    </tr>  
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td><b>Usuario</b><?php echo $reg->usuario; ?></td>
       
    </tr>
</table>
<br>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="300px">
        
    <tr>
      <td colspan="3" align="center">¡Gracias!</td>
    </tr>
    <tr>
      <td colspan="3" align="center">SoftFicha</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Vallegrande  - Bolivia</td>
    </tr>
    
</table>
<br>
</div>
<p>&nbsp;</p>

</body>
</html>
<?php 
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>