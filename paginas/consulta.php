    <?php

    session_start();
    require("conectar_DB.php");
  error_reporting(E_ALL ^ E_NOTICE);
  $fechaInicial = $_POST['fecha_inicial']. ' '.  $_POST['hora_inicial'];
  $fechaFinal = $_POST['fecha_final']. ' '.  $_POST['hora_final'];

  if ($_POST['tipo_medidor'] ==1){

  $sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";

  $query = $pdo->prepare($sql);
	$query->execute();
      if(!$query){
        echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
      }

  echo '<div><h2>Flujo Instantaneo Aire B</h2> </div>';
  echo '<div><table class="compare">';
  echo '<tr>';
	echo '<td>';
	echo 'Fecha y Hora';
  echo '</td>';
	echo '<td>';
	echo 'Cierra Premoldes B1';
  echo '</td>';
	echo '<td>';
	echo 'Op. Moldes B1';
  echo '</td>';
	echo '<td>';
	echo 'Op. Maquina B1';
  echo '</td>';
	echo '<td>';
	echo 'Aire Machos B1';
  echo '</td>';
	echo '<td>';
	echo 'Cierra Premoldes B2';
  echo '</td>';
  echo '<td>';
	echo 'Op. Moldes B2';
  echo '</td>';
	echo '<td>';
	echo 'Op. Maquina B2';
  echo '</td>';
	echo '<td>';
	echo 'Aire Machos B2';
  echo '</td>';
	echo '<td>';
	echo 'Cierra Premoldes B3';
  echo '</td>';
	echo '<td>';
	echo 'Op. Moldes B3';
  echo '</td>';
	echo '<td>';
	echo 'Op. Maquina B3';
  echo '</td>';
	echo '<td>';
	echo 'Aire Machos B3';
  echo '</td>';
	echo '<td>';
	echo 'Baja B1';
  echo '</td>';
	echo '<td>';
	echo 'Baja B2';
  echo '</td>';
	echo '<td>';
	echo 'Baja B3';
  echo '</td>';
	echo '<td>';
	echo 'Alta B1';
  echo '</td>';
	echo '<td>';
	echo 'Alta B2';
  echo '</td>';
	echo '<td>';
	echo 'Alta B3';
  echo '</td> </div>';

  $total1 =0;
  $total2 =0;
  $total3 =0;
  $contador =0;

     while ($fila = $query->fetch(PDO::FETCH_ASSOC)){

       echo '</tr>';
      echo '<tr>';
      echo '<td>';
      $date = date_create($fila['Time_Stamp']);
        echo date_format($date, "d-m-Y H:i");
       echo '</td>';
      echo '<td>';
      echo $fila['Flujo_1_1'];
      $total1+= $fila['Flujo_1_1'];
      echo '</td>';
      echo '<td>';
      echo $fila['Flujo_3_1'];
      $total3+= $fila['Flujo_3_1'];
      echo '</td>';

      echo '<td>';
      echo $fila['Flujo_12_1'];
      $total12+= $fila['Flujo_12_1'];
       echo '</td>';
       echo '<td>';
       echo $fila['Flujo_10_1'];
       $total10+= $fila['Flujo_10_1'];
        echo '</td>';
        echo '<td>';
        echo $fila['Flujo_5_1'];
        $total5+= $fila['Flujo_5_1'];
         echo '</td>';
         echo '<td>';
         echo $fila['Flujo_2_1'];
         $total2+= $fila['Flujo_2_1'];
          echo '</td>';
          echo '<td>';
          echo $fila['Flujo_11_1'];
          $total11+= $fila['Flujo_11_1'];
           echo '</td>';
           echo '<td>';
           echo $fila['Flujo_7_1'];
           $total7+= $fila['Flujo_7_1'];
            echo '</td>';
            echo '<td>';
            echo $fila['Flujo_4_1'];
            $total4+= $fila['Flujo_4_1'];
             echo '</td>';
             echo '<td>';
             echo $fila['Flujo_6_1'];
             $total6+= $fila['Flujo_6_1'];
              echo '</td>';
              echo '<td>';
              echo $fila['Flujo_8_1'];
              $total8+= $fila['Flujo_8_1'];
               echo '</td>';
               echo '<td>';
               echo $fila['Flujo_9_1'];
               $total9+= $fila['Flujo_9_1'];
                echo '</td>';
                echo '<td>';
                echo $fila['resta_Baja_B1'];
                $totalBajaB1+= $fila['resta_Baja_B1'];
                 echo '</td>';
                 echo '<td>';
                 echo $fila['resta_Baja_B2'];
                 $totalBajaB2+= $fila['resta_Baja_B2'];
                  echo '</td>';
                  echo '<td>';
                  echo $fila['Flujo_18_1'];
                  $total18+= $fila['Flujo_18_1'];
                   echo '</td>';
                   echo '<td>';
                   echo $fila['resta_Alta_B1'];
                   $totalAltaB1+= $fila['resta_Alta_B1'];
                    echo '</td>';
                    echo '<td>';
                    echo $fila['resta_Alta_B2'];
                    $totalAltaB2+= $fila['resta_Alta_B2'];
                     echo '</td>';
                     echo '<td>';
                     echo $fila['Flujo_17_1'];
                     $total17+= $fila['Flujo_17_1'];
                      echo '</td>';
      echo '</tr>';
    }
    // echo '<tr><td><b>Totales:</></td><td><b>'.$total1.'<b/></td><td><b>'.$total3.'<b></td><td><b>'.$total12.'</b></td>
    // <td><b>'.$total10.'<b/></td><td><b>'.$total5.'<b></td><td><b>'.$total2.'</b></td>
    // <td><b>'.$total11.'<b/></td><td><b>'.$total7.'<b></td><td><b>'.$total4.'</b></td>
    // <td><b>'.$total6.'<b/></td><td><b>'.$total8.'<b></td><td><b>'.$total9.'</b></td>
    // <td><b>'.$totalBajaB1.'<b/></td><td><b>'.$totalBajaB2.'<b></td><td><b>'.$total18.'</b></td>
    // <td><b>'.$totalAltaB1.'<b/></td><td><b>'.$totalAltaB2.'<b></td><td><b>'.$total17.'</b></td></tr>
    echo'</table>';

    $sumtotal= $total1+$total3+$total12+$total10+$total5+$total2+$total11+$total7+
    $total4+$total6+$total8+$total9+$totalBajaB1+$totalBajaB2+$total18+$totalAltaB1+$totalAltaB2+$total7;
    if($sumtotal!==0){
      //echo '<center><img src="generar_grafico.php" width="90%"/></center>';
    }
  $_SESSION["total1"]= $total1;
  $_SESSION["total3"]= $total3;
  $_SESSION["total12"]= $total12;
  $_SESSION["total10"]= $total10;
  $_SESSION["total5"]= $total5;
  $_SESSION["total2"]= $total2;
  $_SESSION["total11"]= $total11;
  $_SESSION["total7"]= $total7;
  $_SESSION["total4"]= $total4;
  $_SESSION["total6"]= $total6;
  $_SESSION["total8"]= $total8;
  $_SESSION["total9"]= $total9;
  $_SESSION["totalBajaB1"]= $totalBajaB1;
  $_SESSION["totalBajaB2"]= $totalBajaB2;
  $_SESSION["total18"]= $total18;
  $_SESSION["totalAltaB1"]= $totalAltaB1;
  $_SESSION["totalAltaB2"]= $totalAltaB2;
  $_SESSION["total17"]= $total17;
  }

//COMIENZO MEDIDOR CONSUMO AIRE C
  if ($_POST['tipo_medidor'] ==2){

  $sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
  //CONSULTA MEDIDOR 1
    $query = $pdo->prepare($sql);
	   $query->execute();
      if(!$query){
        echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
      }

  echo '<div><h2>Flujo Instantaneo Aire C</h2> </div>';
  echo '<div><table class="compare">';
  echo '<tr>';
  echo '<td>';
  echo 'Fecha y Hora';
  echo '</td>';
  echo '<td>';
  echo 'Baja C1';
  echo '</td>';
  echo '<td>';
  echo 'Baja C3';
  echo '</td>';
  echo '<td>';
  echo 'Alta C1';
  echo '</td>';
  echo '<td>';
  echo 'Alta C3';
  echo '</td>';
  echo '<td>';
  echo 'Cierre Moldes C3';
  echo '</td>';
  echo '<td>';
  echo 'Enfr. Macho C3';
  echo '</td>';
  echo '<td>';
  echo 'Blank Close C3';
  echo '</td>';
  echo '<td>';
  echo 'Op. Máquina C3';
  echo '</td>';
  echo '<td>';
  echo 'Invert Revert C3';
  echo '</td>';
  echo '<td>';
  echo 'Cierre Moldes C1';
  echo '</td>';
  echo '<td>';
  echo 'Blank Close C1';
  echo '</td>';
  echo '<td>';
  echo 'Enfr. Macho C1';
  echo '</td>';
  echo '<td>';
  echo 'Op. Máquina C1';
  echo '</td>';
  echo '<td>';
  echo 'Inverter Revert C1';
  echo '</td></div>';

  $total1 =0;
  $total2 =0;
  $total3 =0;
  $contador =0;

     while ($fila = $query->fetch(PDO::FETCH_ASSOC)){

       echo '</tr>';
      echo '<tr>';
      echo '<td>';
      $date = date_create($fila['Time_Stamp']);
        echo date_format($date, "d-m-Y H:i");
       echo '</td>';
      echo '<td>';
      echo $fila['Flujo_C_1'];
      $totalAltaC3+= $fila['Flujo_C_1'];
      echo '</td>';
      echo '<td>';
      echo $fila['Flujo_C_2'];
      $totalAltaC1+= $fila['Flujo_C_2'];
      echo '</td>';
      echo '<td>';
      echo $fila['Flujo_C_3'];
      $totalBajaC1+= $fila['Flujo_C_3'];
       echo '</td>';
       echo '<td>';
       echo $fila['Flujo_C_4'];
       $totalBajaC3+= $fila['Flujo_C_4'];
        echo '</td>';
        echo '<td>';
        echo $fila['Flujo_C_5'];
        $totalC5+= $fila['Flujo_C_5'];
        echo '</td>';
        echo '<td>';
        echo $fila['Flujo_C_6'];
        $totalC6+= $fila['Flujo_C_6'];
        echo '</td>';
        echo '<td>';
        echo $fila['Flujo_C_7'];
        $totalC7+= $fila['Flujo_C_7'];
         echo '</td>';
         echo '<td>';
         echo $fila['Flujo_C_8'];
         $totalC8+= $fila['Flujo_C_8'];
          echo '</td>';
         echo '<td>';
         echo $fila['Flujo_C_9'];
         $totalC9+= $fila['Flujo_C_9'];
          echo '</td>';
          echo '<td>';
          echo $fila['Flujo_C_10'];
          $totalC10+= $fila['Flujo_C_10'];
          echo '</td>';
          echo '<td>';
          echo $fila['Flujo_C_11'];
          $totalC11+= $fila['Flujo_C_11'];
          echo '</td>';
          echo '<td>';
          echo $fila['Flujo_C_12'];
          $totalC12+= $fila['Flujo_C_12'];
           echo '</td>';
           echo '<td>';
           echo $fila['Flujo_C_13'];
           $totalC13+= $fila['Flujo_C_13'];
            echo '</td>';
            echo '<td>';
            echo $fila['Flujo_C_14'];
            $totalC14+= $fila['Flujo_C_14'];
             echo '</td>';

      echo '</tr>';
    }
    // echo '<tr><td><b>Totales:</></td><td><b>'.$totalBajaC1.'<b/></td><td><b>'.$totalBajaC3.'<b></td><td><b>'.$totalAltaC1.'</b></td>
    // <td><b>'.$totalAltaC3.'</b></td><td><b>'.$totalC5.'</b></td><td><b>'.$totalC6.'</b></td><td><b>'.$totalC7.'</b></td>
    // <td><b>'.$totalC8.'</b></td><td><b>'.$totalC9.'</b></td><td><b>'.$totalC10.'</b></td><td><b>'.$totalC11.'</b></td>
    // <td><b>'.$totalC12.'</b></td><td><b>'.$totalC13.'</b></td><td><b>'.$totalC14.'</b></td></tr>
    echo '</table>';
    $sumtotal= $totalBajaC1+$totalBajaC3+$totalAltaC1+$totalAltaC3+$totalC5+$totalC6+$totalC7+$totalC8+$totalC9+$totalC10+$totalC11+$totalC12+$totalC13+$totalC14;

    if($sumtotal!==0){
      //echo '<center><img src="generar_grafico2.php" width="90%"/></center>';
    }
  $_SESSION["totalBajaC1"]= $totalBajaC1;
  $_SESSION["totalBajaC3"]= $totalBajaC3;
  $_SESSION["totalAltaC1"]= $totalAltaC1;
  $_SESSION["totalAltaC3"]= $totalAltaC3;
  $_SESSION["totalC5"]= $totalC5;
  $_SESSION["totalC6"]= $totalC6;
  $_SESSION["totalC7"]= $totalC7;
  $_SESSION["totalC8"]= $totalC8;
  $_SESSION["totalC9"]= $totalC9;
  $_SESSION["totalC10"]= $totalC10;
  $_SESSION["totalC11"]= $totalC11;
  $_SESSION["totalC12"]= $totalC12;
  $_SESSION["totalC13"]= $totalC13;
  $_SESSION["totalC14"]= $totalC14;
  }


//*********************************************
//TOTALIZADORES
//*********************************************


if ($_POST['tipo_medidor'] ==3){

$sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
//CONSULTA MEDIDOR 1
$query = $pdo->prepare($sql);
$query->execute();
    if(!$query){
      //echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
    }

echo '<div><h2>Consumo Aire B</h2> </div>';
echo '<div><table class="compare">';
echo '<tr>';
echo '<td>';
echo 'Fecha y Hora';
echo '</td>';
echo '<td>';
echo 'Cierra Premoldes B1';
echo '</td>';
echo '<td>';
echo 'Op. Moldes B1';
echo '</td>';
echo '<td>';
echo 'Op. Maquina B1';
echo '</td>';
echo '<td>';
echo 'Aire Machos B1';
echo '</td>';
echo '<td>';
echo 'Cierra Premoldes B2';
echo '</td>';
echo '<td>';
echo 'Op. Moldes B2';
echo '</td>';
echo '<td>';
echo 'Op. Maquina B2';
echo '</td>';
echo '<td>';
echo 'Aire Machos B2';
echo '</td>';
echo '<td>';
echo 'Cierra Premoldes B3';
echo '</td>';
echo '<td>';
echo 'Op. Moldes B3';
echo '</td>';
echo '<td>';
echo 'Op. Maquina B3';
echo '</td>';
echo '<td>';
echo 'Aire Machos B3';
echo '</td>';
echo '<td>';
echo 'Baja B1';
echo '</td>';
echo '<td>';
echo 'Baja B2';
echo '</td>';
echo '<td>';
echo 'Baja B3';
echo '</td>';
echo '<td>';
echo 'Alta B1';
echo '</td>';
echo '<td>';
echo 'Alta B2';
echo '</td>';
echo '<td>';
echo 'Alta B3';
echo '</td> </div>';

$total1 =0;
$total2 =0;
$total3 =0;
$contador =0;

   while ($fila = $query->fetch(PDO::FETCH_ASSOC)){

     echo '</tr>';
    echo '<tr>';
    echo '<td>';
    $date = date_create($fila['Time_Stamp']);
      echo date_format($date, "d-m-Y H:i");
     echo '</td>';
    echo '<td>';
    echo $fila['Res_Acum_B_1'];
    $total1+= $fila['Res_Acum_B_1'];
    echo '</td>';
    echo '<td>';
    echo $fila['Res_Acum_B_3'];
    $total3+= $fila['Res_Acum_B_3'];
    echo '</td>';

    echo '<td>';
    echo $fila['Res_Acum_B_12'];
    $total12+= $fila['Res_Acum_B_12'];
     echo '</td>';
     echo '<td>';
     echo $fila['Res_Acum_B_10'];
     $total10+= $fila['Res_Acum_B_10'];
      echo '</td>';
      echo '<td>';
      echo $fila['Res_Acum_B_5'];
      $total5+= $fila['Res_Acum_B_5'];
       echo '</td>';
       echo '<td>';
       echo $fila['Res_Acum_B_2'];
       $total2+= $fila['Res_Acum_B_2'];
        echo '</td>';
        echo '<td>';
        echo $fila['Res_Acum_B_11'];
        $total11+= $fila['Res_Acum_B_11'];
         echo '</td>';
         echo '<td>';
         echo $fila['Res_Acum_B_7'];
         $total7+= $fila['Res_Acum_B_7'];
          echo '</td>';
          echo '<td>';
          echo $fila['Res_Acum_B_4'];
          $total4+= $fila['Res_Acum_B_4'];
           echo '</td>';
           echo '<td>';
           echo $fila['Res_Acum_B_6'];
           $total6+= $fila['Res_Acum_B_6'];
            echo '</td>';
            echo '<td>';
            echo $fila['Res_Acum_B_8'];
            $total8+= $fila['Res_Acum_B_8'];
             echo '</td>';
             echo '<td>';
             echo $fila['Res_Acum_B_9'];
             $total9+= $fila['Res_Acum_B_9'];
              echo '</td>';
              echo '<td>';
              echo $fila['Res_Acum_Baja_B1'];
              $totalBajaB1+= $fila['Res_Acum_Baja_B1'];
               echo '</td>';
               echo '<td>';
               echo $fila['Res_Acum_Baja_B2'];
               $totalBajaB2+= $fila['Res_Acum_Baja_B2'];
                echo '</td>';
                echo '<td>';
                echo $fila['Flujo_18_1'];
                $total18+= $fila['Res_Acum_B_18'];
                 echo '</td>';
                 echo '<td>';
                 echo $fila['Res_Acum_Alta_B1'];
                 $totalAltaB1+= $fila['Res_Acum_Alta_B1'];
                  echo '</td>';
                  echo '<td>';
                  echo $fila['Res_Acum_Alta_B2'];
                  $totalAltaB2+= $fila['Res_Acum_Alta_B2'];
                   echo '</td>';
                   echo '<td>';
                   echo $fila['Res_Acum_B_17'];
                   $total17+= $fila['Res_Acum_B_17'];
                    echo '</td>';
    echo '</tr>';
  }
  echo '<tr><td><b>Totales:</></td><td><b>'.$total1.'<b/></td><td><b>'.$total3.'<b></td><td><b>'.$total12.'</b></td>
  <td><b>'.$total10.'<b/></td><td><b>'.$total5.'<b></td><td><b>'.$total2.'</b></td>
  <td><b>'.$total11.'<b/></td><td><b>'.$total7.'<b></td><td><b>'.$total4.'</b></td>
  <td><b>'.$total6.'<b/></td><td><b>'.$total8.'<b></td><td><b>'.$total9.'</b></td>
  <td><b>'.$totalBajaB1.'<b/></td><td><b>'.$totalBajaB2.'<b></td><td><b>'.$total18.'</b></td>
  <td><b>'.$totalAltaB1.'<b/></td><td><b>'.$totalAltaB2.'<b></td><td><b>'.$total17.'</b></td></tr></table>';

  $sumtotal= $total1+$total3+$total12+$total10+$total5+$total2+$total11+$total7+
  $total4+$total6+$total8+$total9+$totalBajaB1+$totalBajaB2+$total18+$totalAltaB1+$totalAltaB2+$total7;
  if($sumtotal!==0){
    //echo '<center><img src="generar_grafico3.php" width="90%"/></center>';
  }
$_SESSION["total1"]= $total1;
$_SESSION["total3"]= $total3;
$_SESSION["total12"]= $total12;
$_SESSION["total10"]= $total10;
$_SESSION["total5"]= $total5;
$_SESSION["total2"]= $total2;
$_SESSION["total11"]= $total11;
$_SESSION["total7"]= $total7;
$_SESSION["total4"]= $total4;
$_SESSION["total6"]= $total6;
$_SESSION["total8"]= $total8;
$_SESSION["total9"]= $total9;
$_SESSION["totalBajaB1"]= $totalBajaB1;
$_SESSION["totalBajaB2"]= $totalBajaB2;
$_SESSION["total18"]= $total18;
$_SESSION["totalAltaB1"]= $totalAltaB1;
$_SESSION["totalAltaB2"]= $totalAltaB2;
$_SESSION["total17"]= $total17;
}

//COMIENZO MEDIDOR consumo AIRE C
if ($_POST['tipo_medidor'] ==4){

$sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
//CONSULTA MEDIDOR 1
  $query = $pdo->prepare($sql);
   $query->execute();
    if(!$query){
      echo"<script> alert('ERROR! No se pudo consultar la base de datos');</script>";
    }

echo '<div><h2>Consumo Aire C</h2> </div>';
echo '<div><table class="compare">';
echo '<tr>';
echo '<td>';
echo 'Fecha y Hora';
echo '</td>';
echo '<td>';
echo 'Baja C1';
echo '</td>';
echo '<td>';
echo 'Baja C3';
echo '</td>';
echo '<td>';
echo 'Alta C1';
echo '</td>';
echo '<td>';
echo 'Alta C3';
echo '</td> </div>';

$total1 =0;
$total2 =0;
$total3 =0;
$contador =0;

   while ($fila = $query->fetch(PDO::FETCH_ASSOC)){

     echo '</tr>';
    echo '<tr>';
    echo '<td>';
    $date = date_create($fila['Time_Stamp']);
      echo date_format($date, "d-m-Y H:i");
     echo '</td>';
    echo '<td>';
    echo $fila['Res_Acum_C_1'];
    $totalAltaC3+= $fila['Res_Acum_C_1'];
    echo '</td>';
    echo '<td>';
    echo $fila['Res_Acum_C_2'];
    $totalAltaC1+= $fila['Res_Acum_C_2'];
    echo '</td>';

    echo '<td>';
    echo $fila['Res_Acum_C_3'];
    $totalBajaC1+= $fila['Res_Acum_C_3'];
     echo '</td>';
     echo '<td>';
     echo $fila['Res_Acum_C_4'];
     $totalBajaC3+= $fila['Res_Acum_C_4'];
      echo '</td>';

    echo '</tr>';
  }
  echo '<tr><td><b>Totales:</></td><td><b>'.$totalBajaC1.'<b/></td><td><b>'.$totalBajaC3.'<b></td><td><b>'.$totalAltaC1.'</b></td>
  <td><b>'.$totalAltaC3.'</b></td></tr></table>';
  $sumtotal= $totalBajaC1+$totalBajaC3+$totalAltaC1+$totalAltaC3;

  if($sumtotal!==0){
    echo '<center><img src="generar_grafico4.php" width="90%"/></center>';
  }
$_SESSION["totalBajaC1"]= $totalBajaC1;
$_SESSION["totalBajaC3"]= $totalBajaC3;
$_SESSION["totalAltaC1"]= $totalAltaC1;
$_SESSION["totalAltaC3"]= $totalAltaC3;

}

  ?>
