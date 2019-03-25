<?php
session_start();
require_once("conectar_DB.php");

$fechaInicial = $_POST['fecha_inicial']. ' '.  $_POST['hora_inicial'];
$fechaFinal = $_POST['fecha_final']. ' '.  $_POST['hora_final'];

if ($_POST['tipo_medidor'] ==1){

	$sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
	$query = $pdo->prepare($sql);
	$query->execute();
	if ($query->fetchColumn() > 0) {
		date_default_timezone_set('America/Lima');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../PHPExcel/Classes/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("") //Autor
							 ->setLastModifiedBy("") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel")
							 ->setSubject("Reporte Excel")
							 ->setDescription("Reporte de Energía")
							 ->setKeywords("")
							 ->setCategory("Reporte Energía");

							 $tituloReporte = "Reporte de Energía";
					 		$titulosColumnas = array("Fecha y Hora","Cierra Premoldes B1","Op. Moldes B1","Op. Maquina B1","Aire Machos B1","Cierra Premoldes B2","Op. Moldes B2","Op. Maquina B2","Aire Machos B2","Cierra Premoldes B3","Op. Moldes B3","Op. Maquina B3","Aire Machos B3","Baja B1","Baja B2","Baja B3","Alta B1","Alta B2","Alta B3");
					 		// Se agrega la cantidad de celdas que ocupará tituloReporte
					 		// $objPHPExcel->setActiveSheetIndex(0)
					     //     		    ->mergeCells('A1:I1');
					 		// Se agregan los titulos del reporte por columna
					 		$objPHPExcel->setActiveSheetIndex(0)
					 					->setCellValue('A1',  $tituloReporte)
					         		    ->setCellValue('A3',  $titulosColumnas[0])
					 		            ->setCellValue('B3',  $titulosColumnas[1])
					         		    ->setCellValue('C3',  $titulosColumnas[2])
					             		->setCellValue('D3',  $titulosColumnas[3])
					 								->setCellValue('E3',  $titulosColumnas[4])
					 								->setCellValue('F3',  $titulosColumnas[5])
					 		            ->setCellValue('G3',  $titulosColumnas[6])
					         		    ->setCellValue('H3',  $titulosColumnas[7])
					             		->setCellValue('I3',  $titulosColumnas[8])
					 								->setCellValue('J3',  $titulosColumnas[9])
					 								->setCellValue('K3',  $titulosColumnas[10])
					 		            ->setCellValue('L3',  $titulosColumnas[11])
					         		    ->setCellValue('M3',  $titulosColumnas[12])
					             		->setCellValue('N3',  $titulosColumnas[13])
					 								->setCellValue('O3',  $titulosColumnas[14])
					 								->setCellValue('P3',  $titulosColumnas[15])
					 		            ->setCellValue('Q3',  $titulosColumnas[16])
					         		    ->setCellValue('R3',  $titulosColumnas[17])
					 								->setCellValue('S3',  $titulosColumnas[18]);

					 								$total1 =0;
					 	              $total3 =0;
					 	              $total12 =0;
					 	              $total10 =0;
					 	              $total5 =0;
					 	              $total2 =0;
					 	              $total11 =0;
					 	              $total7 =0;
					 	              $total4 =0;
					 	              $total6 =0;
					 	              $total8 =0;
					 	              $total9 =0;
					 	              $totalBajaB1 =0;
					 	              $totalBajaB2 =0;
					 	              $total18 =0;
					 	              $totalAltaB1 =0;
					 	              $totalAltaB2 =0;
					 	              $total17 =0;
					 		//Se agregan los datos extraids de la DB
					 		$i = 4; //Comienza en la fila 4
					 		while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
					 			$date = date_create($fila['Time_Stamp']);
					 			$formato_fecha = date_format($date, "d-m-Y H:i");

					 				$total1+= $fila['Flujo_1_1'];
					         $total3+= $fila['Flujo_3_1'];
					         $total12+= $fila['Flujo_12_1'];
					         $total10+= $fila['Flujo_10_1'];
					         $total5+= $fila['Flujo_5_1'];
					         $total2+= $fila['Flujo_2_1'];
					         $total11+= $fila['Flujo_11_1'];
					         $total7+= $fila['Flujo_7_1'];
					         $total4+= $fila['Flujo_4_1'];
					         $total6+= $fila['Flujo_6_1'];
					         $total8+= $fila['Flujo_8_1'];
					         $total9+= $fila['Flujo_9_1'];
					         $totalBajaB1+= $fila['resta_Baja_B1'];
					         $totalBajaB2+= $fila['resta_Baja_B2'];
					         $total18+= $fila['Flujo_18_1'];
					         $totalAltaB1+= $fila['resta_Alta_B1'];
					         $totalAltaB2+= $fila['resta_Alta_B2'];
					         $total17+= $fila['Flujo_17_1'];

					 			$objPHPExcel->setActiveSheetIndex(0)
					 								->setCellValue('A'.$i,  $formato_fecha)
					         		    ->setCellValue('B'.$i,  $fila['Flujo_1_1'])
					 		            ->setCellValue('C'.$i,  $fila['Flujo_3_1'])
					         		    ->setCellValue('D'.$i,  $fila['Flujo_12_1'])
					             		->setCellValue('E'.$i,  $fila['Flujo_10_1'])
					 								->setCellValue('F'.$i,  $fila['Flujo_5_1'])
					 								->setCellValue('G'.$i,  $fila['Flujo_2_1'])
					 		            ->setCellValue('H'.$i,  $fila['Flujo_11_1'])
					         		    ->setCellValue('I'.$i,  $fila['Flujo_7_1'])
					 								->setCellValue('J'.$i,  $fila['Flujo_4_1'])
					 		            ->setCellValue('K'.$i,  $fila['Flujo_6_1'])
					         		    ->setCellValue('L'.$i,  $fila['Flujo_8_1'])
					 								->setCellValue('M'.$i,  $fila['Flujo_9_1'])
					 		            ->setCellValue('N'.$i,  $fila['resta_Baja_B1'])
					         		    ->setCellValue('O'.$i,  $fila['resta_Baja_B2'])
					 								->setCellValue('P'.$i,  $fila['Flujo_18_1'])
					 		            ->setCellValue('Q'.$i,  $fila['resta_Alta_B1'])
					         		    ->setCellValue('R'.$i,  $fila['resta_Alta_B2'])
					 								->setCellValue('S'.$i,  $fila['Flujo_17_1']);


					 					$i++;

					 		}
					 			//Aqui se agregan los totales

							// $tituloTotal = array('Total',$total1,$total3,$total12,$total10,$total5,$total2,$total11,$total7,$total4,$total6,$total8,$total9,$totalBajaB1,$totalBajaB2,$total18,$totalAltaB1,$totalAltaB2,$total17);
					 		// 	$objPHPExcel->setActiveSheetIndex(0)
					 		// 		->setCellValue('A'.$i, $tituloTotal[0])
					 		// 		->setCellValue('B'.$i, $tituloTotal[1])
					 		// 		->setCellValue('C'.$i, $tituloTotal[2])
					 		// 		->setCellValue('D'.$i, $tituloTotal[3])
					 		// 		->setCellValue('E'.$i, $tituloTotal[4])
					 		// 		->setCellValue('F'.$i, $tituloTotal[5])
					 		// 		->setCellValue('G'.$i, $tituloTotal[6])
					 		// 		->setCellValue('H'.$i, $tituloTotal[7])
					 		// 		->setCellValue('I'.$i, $tituloTotal[8])
					 		// 		->setCellValue('J'.$i, $tituloTotal[9])
					 		// 		->setCellValue('K'.$i, $tituloTotal[10])
					 		// 		->setCellValue('L'.$i, $tituloTotal[11])
					 		// 		->setCellValue('M'.$i, $tituloTotal[12])
					 		// 		->setCellValue('N'.$i, $tituloTotal[13])
					 		// 		->setCellValue('O'.$i, $tituloTotal[14])
					 		// 		->setCellValue('P'.$i, $tituloTotal[15])
					 		// 		->setCellValue('Q'.$i, $tituloTotal[16])
					 		// 		->setCellValue('R'.$i, $tituloTotal[17])
					 		// 		->setCellValue('S'.$i, $tituloTotal[18]);

					 				//Estilo titulo Reporte
					 $estiloTituloReporte = array(
					 			'font' => array(
					 				'name'      => 'Arial',
					 					'bold'      => true,
					 					'italic'    => false,
					 						'strike'    => false,
					 						'size' =>16,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 							)
					 				),
					 			'fill' => array(
					 		'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'	=> array('argb' => 'FFfa8236')//Color del fondo del titulo
					 	),
					 				'borders' => array(
					 						'allborders' => array(
					 							'style' => PHPExcel_Style_Border::BORDER_NONE
					 						)
					 				),
					 				'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'rotation'   => 0,
					 					'wrap'       => TRUE
					 		)
					 	);
					 	//Estilo titulo columnas
					 $estiloTituloColumnas = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 						'rgb' => 'fa8236'
					 				)
					 //				,
					 //        		'endcolor'   => array(
					 //            		'argb' => 'FF431a5d'
					 //        		)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'          => TRUE
					 		));

					 	//Estilo totales
					 	$estiloTituloTotales = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		 => PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 							 'rgb' => 'fa8236'
					 				)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'       => TRUE
					 		));
					 	//Estilo de los datos mostrados
					 $estiloInformacion = new PHPExcel_Style();
					 $estiloInformacion->applyFromArray(
					 	array(
					 					'font' => array(
					 						'name'      => 'Arial',
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'		=> array('argb' => '91bdde')
					 	),
					 		'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
					 			),
					 				'borders' => array(
					 						'left'     => array(
					 								'style' => PHPExcel_Style_Border::BORDER_THIN ,
					 							'color' => array(
					 								'rgb' => '3a2a47'
					 								)
					 						)
					 				)
					 		));
					 	//Rango de estilo de titulo reporte
					 //  $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
					 	// Rango de estilo titulos de columnas
					 $objPHPExcel->getActiveSheet()->getStyle('A3:S3')->applyFromArray($estiloTituloColumnas);
					 	// Rango de estilo titulos de totales
					 $objPHPExcel->getActiveSheet()->getStyle('A'.($i).':S'.($i))->applyFromArray($estiloTituloTotales);
					 	//Rango de estilos en los datos
					 $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:S".($i-1));

					 //Rango de las columnas que aplica autoresize
					 for($i = 'A'; $i <= 'Z'; $i++){
					 	$objPHPExcel->setActiveSheetIndex(0)
					 		->getColumnDimension($i)->setAutoSize(TRUE);
					 }

					 // Se asigna el nombre a la hoja
					 $objPHPExcel->getActiveSheet()->setTitle('Reporte');

					 // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
					 $objPHPExcel->setActiveSheetIndex(0);
					 // Inmovilizar paneles
					 $objPHPExcel->getActiveSheet(0)->freezePane('A2');
					 //$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,20);

					 // Se envía el archivo al navegador web, con el nombre que se indica (Excel2007)
					 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					 header("Content-Disposition: attachment; filename=reporte_".date('d-m-Y_h').".xls");
					 header('Cache-Control: max-age=0');

					 // Formato o versiòn de Excel a elegir: Excel5, Excel2007, otros.
					 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					 $objWriter->save('php://output');
					 exit;

}
else{
echo"<script> alert('No hay datos para mostrar')
window.self.location='../';</script>";
}
}



//************************************************************+
//Medidor 3
//************************************************************
if ($_POST['tipo_medidor'] ==3){

	$sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
	$query = $pdo->prepare($sql);
	$query->execute();
	if ($query->fetchColumn() > 0) {
		date_default_timezone_set('America/Lima');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../PHPExcel/Classes/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("") //Autor
							 ->setLastModifiedBy("") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel")
							 ->setSubject("Reporte Excel")
							 ->setDescription("Reporte de Energía")
							 ->setKeywords("")
							 ->setCategory("Reporte Energía");

							 $tituloReporte = "Reporte de Energía";
					 		$titulosColumnas = array("Fecha y Hora","Cierra Premoldes B1","Op. Moldes B1","Op. Maquina B1","Aire Machos B1","Cierra Premoldes B2","Op. Moldes B2","Op. Maquina B2","Aire Machos B2","Cierra Premoldes B3","Op. Moldes B3","Op. Maquina B3","Aire Machos B3","Baja B1","Baja B2","Baja B3","Alta B1","Alta B2","Alta B3");
					 		// Se agrega la cantidad de celdas que ocupará tituloReporte
					 		// $objPHPExcel->setActiveSheetIndex(0)
					     //     		    ->mergeCells('A1:I1');
					 		// Se agregan los titulos del reporte por columna
					 		$objPHPExcel->setActiveSheetIndex(0)
					 					->setCellValue('A1',  $tituloReporte)
					         		    ->setCellValue('A3',  $titulosColumnas[0])
					 		            ->setCellValue('B3',  $titulosColumnas[1])
					         		    ->setCellValue('C3',  $titulosColumnas[2])
					             		->setCellValue('D3',  $titulosColumnas[3])
					 								->setCellValue('E3',  $titulosColumnas[4])
					 								->setCellValue('F3',  $titulosColumnas[5])
					 		            ->setCellValue('G3',  $titulosColumnas[6])
					         		    ->setCellValue('H3',  $titulosColumnas[7])
					             		->setCellValue('I3',  $titulosColumnas[8])
					 								->setCellValue('J3',  $titulosColumnas[9])
					 								->setCellValue('K3',  $titulosColumnas[10])
					 		            ->setCellValue('L3',  $titulosColumnas[11])
					         		    ->setCellValue('M3',  $titulosColumnas[12])
					             		->setCellValue('N3',  $titulosColumnas[13])
					 								->setCellValue('O3',  $titulosColumnas[14])
					 								->setCellValue('P3',  $titulosColumnas[15])
					 		            ->setCellValue('Q3',  $titulosColumnas[16])
					         		    ->setCellValue('R3',  $titulosColumnas[17])
					 								->setCellValue('S3',  $titulosColumnas[18]);

					 								$total1 =0;
					 	              $total3 =0;
					 	              $total12 =0;
					 	              $total10 =0;
					 	              $total5 =0;
					 	              $total2 =0;
					 	              $total11 =0;
					 	              $total7 =0;
					 	              $total4 =0;
					 	              $total6 =0;
					 	              $total8 =0;
					 	              $total9 =0;
					 	              $totalBajaB1 =0;
					 	              $totalBajaB2 =0;
					 	              $total18 =0;
					 	              $totalAltaB1 =0;
					 	              $totalAltaB2 =0;
					 	              $total17 =0;
					 		//Se agregan los datos extraids de la DB
					 		$i = 4; //Comienza en la fila 4
					 		while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
					 			$date = date_create($fila['Time_Stamp']);
					 			$formato_fecha = date_format($date, "d-m-Y H:i");

					 				$total1+= $fila['Res_Acum_B_1'];
					         $total3+= $fila['Res_Acum_B_3'];
					         $total12+= $fila['Res_Acum_B_12'];
					         $total10+= $fila['Res_Acum_B_10'];
					         $total5+= $fila['Res_Acum_B_5'];
					         $total2+= $fila['Res_Acum_B_2'];
					         $total11+= $fila['Res_Acum_B_11'];
					         $total7+= $fila['Res_Acum_B_7'];
					         $total4+= $fila['Res_Acum_B_4'];
					         $total6+= $fila['Res_Acum_B_6'];
					         $total8+= $fila['Res_Acum_B_8'];
					         $total9+= $fila['Res_Acum_B_9'];
					         $totalBajaB1+= $fila['Res_Acum_Baja_B1'];
					         $totalBajaB2+= $fila['Res_Acum_Baja_B2'];
					         $total18+= $fila['Res_Acum_B_18'];
					         $totalAltaB1+= $fila['Res_Acum_Alta_B1'];
					         $totalAltaB2+= $fila['Res_Acum_Alta_B2'];
					         $total17+= $fila['Res_Acum_B_17'];

					 			$objPHPExcel->setActiveSheetIndex(0)
					 								->setCellValue('A'.$i,  $formato_fecha)
					         		    ->setCellValue('B'.$i,  $fila['Res_Acum_B_1'])
					 		            ->setCellValue('C'.$i,  $fila['Res_Acum_B_3'])
					         		    ->setCellValue('D'.$i,  $fila['Res_Acum_B_12'])
					             		->setCellValue('E'.$i,  $fila['Res_Acum_B_10'])
					 								->setCellValue('F'.$i,  $fila['Res_Acum_B_5'])
					 								->setCellValue('G'.$i,  $fila['Res_Acum_B_2'])
					 		            ->setCellValue('H'.$i,  $fila['Res_Acum_B_11'])
					         		    ->setCellValue('I'.$i,  $fila['Res_Acum_B_7'])
					 								->setCellValue('J'.$i,  $fila['Res_Acum_B_4'])
					 		            ->setCellValue('K'.$i,  $fila['Res_Acum_B_6'])
					         		    ->setCellValue('L'.$i,  $fila['Res_Acum_B_8'])
					 								->setCellValue('M'.$i,  $fila['Res_Acum_B_9'])
					 		            ->setCellValue('N'.$i,  $fila['Res_Acum_Baja_B1'])
					         		    ->setCellValue('O'.$i,  $fila['Res_Acum_Baja_B2'])
					 								->setCellValue('P'.$i,  $fila['Res_Acum_B_18'])
					 		            ->setCellValue('Q'.$i,  $fila['Res_Acum_Alta_B1'])
					         		    ->setCellValue('R'.$i,  $fila['Res_Acum_Alta_B2'])
					 								->setCellValue('S'.$i,  $fila['Res_Acum_B_17']);


					 					$i++;

					 		}
					 			//Aqui se agregan los totales
					 		$tituloTotal = array('Total',$total1,$total3,$total12,$total10,$total5,$total2,$total11,$total7,$total4,$total6,$total8,$total9,$totalBajaB1,$totalBajaB2,$total18,$totalAltaB1,$totalAltaB2,$total17);
					 			$objPHPExcel->setActiveSheetIndex(0)
					 				->setCellValue('A'.$i, $tituloTotal[0])
					 				->setCellValue('B'.$i, $tituloTotal[1])
					 				->setCellValue('C'.$i, $tituloTotal[2])
					 				->setCellValue('D'.$i, $tituloTotal[3])
					 				->setCellValue('E'.$i, $tituloTotal[4])
					 				->setCellValue('F'.$i, $tituloTotal[5])
					 				->setCellValue('G'.$i, $tituloTotal[6])
					 				->setCellValue('H'.$i, $tituloTotal[7])
					 				->setCellValue('I'.$i, $tituloTotal[8])
					 				->setCellValue('J'.$i, $tituloTotal[9])
					 				->setCellValue('K'.$i, $tituloTotal[10])
					 				->setCellValue('L'.$i, $tituloTotal[11])
					 				->setCellValue('M'.$i, $tituloTotal[12])
					 				->setCellValue('N'.$i, $tituloTotal[13])
					 				->setCellValue('O'.$i, $tituloTotal[14])
					 				->setCellValue('P'.$i, $tituloTotal[15])
					 				->setCellValue('Q'.$i, $tituloTotal[16])
					 				->setCellValue('R'.$i, $tituloTotal[17])
					 				->setCellValue('S'.$i, $tituloTotal[18]);

					 				//Estilo titulo Reporte
					 $estiloTituloReporte = array(
					 			'font' => array(
					 				'name'      => 'Arial',
					 					'bold'      => true,
					 					'italic'    => false,
					 						'strike'    => false,
					 						'size' =>16,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 							)
					 				),
					 			'fill' => array(
					 		'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'	=> array('argb' => 'FFfa8236')//Color del fondo del titulo
					 	),
					 				'borders' => array(
					 						'allborders' => array(
					 							'style' => PHPExcel_Style_Border::BORDER_NONE
					 						)
					 				),
					 				'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'rotation'   => 0,
					 					'wrap'       => TRUE
					 		)
					 	);
					 	//Estilo titulo columnas
					 $estiloTituloColumnas = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 						'rgb' => 'fa8236'
					 				)
					 //				,
					 //        		'endcolor'   => array(
					 //            		'argb' => 'FF431a5d'
					 //        		)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'          => TRUE
					 		));

					 	//Estilo totales
					 	$estiloTituloTotales = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		 => PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 							 'rgb' => 'fa8236'
					 				)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'       => TRUE
					 		));
					 	//Estilo de los datos mostrados
					 $estiloInformacion = new PHPExcel_Style();
					 $estiloInformacion->applyFromArray(
					 	array(
					 					'font' => array(
					 						'name'      => 'Arial',
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'		=> array('argb' => '91bdde')
					 	),
					 		'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
					 			),
					 				'borders' => array(
					 						'left'     => array(
					 								'style' => PHPExcel_Style_Border::BORDER_THIN ,
					 							'color' => array(
					 								'rgb' => '3a2a47'
					 								)
					 						)
					 				)
					 		));
					 	//Rango de estilo de titulo reporte
					 //  $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
					 	// Rango de estilo titulos de columnas
					 $objPHPExcel->getActiveSheet()->getStyle('A3:S3')->applyFromArray($estiloTituloColumnas);
					 	// Rango de estilo titulos de totales
					 $objPHPExcel->getActiveSheet()->getStyle('A'.($i).':S'.($i))->applyFromArray($estiloTituloTotales);
					 	//Rango de estilos en los datos
					 $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:S".($i-1));

					 //Rango de las columnas que aplica autoresize
					 for($i = 'A'; $i <= 'Z'; $i++){
					 	$objPHPExcel->setActiveSheetIndex(0)
					 		->getColumnDimension($i)->setAutoSize(TRUE);
					 }

					 // Se asigna el nombre a la hoja
					 $objPHPExcel->getActiveSheet()->setTitle('Reporte');

					 // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
					 $objPHPExcel->setActiveSheetIndex(0);
					 // Inmovilizar paneles
					 $objPHPExcel->getActiveSheet(0)->freezePane('A2');
					 //$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,20);

					 // Se envía el archivo al navegador web, con el nombre que se indica (Excel2007)
					 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					 header("Content-Disposition: attachment; filename=reporte_".date('d-m-Y_h').".xls");
					 header('Cache-Control: max-age=0');

					 // Formato o versiòn de Excel a elegir: Excel5, Excel2007, otros.
					 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					 $objWriter->save('php://output');
					 exit;

}
else{
echo"<script> alert('No hay datos para mostrar')
window.self.location='../';</script>";
}
}



//********************************************
//Medidor 2
//*******************************************
if ($_POST['tipo_medidor'] ==2){

	$sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
	$query = $pdo->prepare($sql);
	$query->execute();
	if ($query->fetchColumn() > 0) {
		date_default_timezone_set('America/Lima');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../PHPExcel/Classes/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("") //Autor
							 ->setLastModifiedBy("") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel")
							 ->setSubject("Reporte Excel")
							 ->setDescription("Reporte de Energía")
							 ->setKeywords("")
							 ->setCategory("Reporte Energía");

							 $tituloReporte = "Reporte de Energía";
					 		$titulosColumnas = array("Fecha y Hora","Baja C1","Baja C3","Alta C1","Alta C3","Cierre Moldes C3",
							"Enfr. Macho C3","Blank Close C3","Op. Máquina C3","Invert Revert C3","Cierre Moldes C1","Blank Close C1","Enfr. Macho C1","Op. Máquina C1","Inverter Revert C1");
					 		// Se agrega la cantidad de celdas que ocupará tituloReporte
					 		// $objPHPExcel->setActiveSheetIndex(0)
					     //     		    ->mergeCells('A1:I1');
					 		// Se agregan los titulos del reporte por columna
					 		$objPHPExcel->setActiveSheetIndex(0)
					 					->setCellValue('A1',  $tituloReporte)
					         		    ->setCellValue('A3',  $titulosColumnas[0])
					 		            ->setCellValue('B3',  $titulosColumnas[1])
					         		    ->setCellValue('C3',  $titulosColumnas[2])
					             		->setCellValue('D3',  $titulosColumnas[3])
					 								->setCellValue('E3',  $titulosColumnas[4])
													->setCellValue('F3',  $titulosColumnas[5])
													->setCellValue('G3',  $titulosColumnas[6])
													->setCellValue('H3',  $titulosColumnas[7])
													->setCellValue('I3',  $titulosColumnas[8])
													->setCellValue('J3',  $titulosColumnas[9])
													->setCellValue('K3',  $titulosColumnas[10])
													->setCellValue('L3',  $titulosColumnas[11])
													->setCellValue('M3',  $titulosColumnas[12])
													->setCellValue('N3',  $titulosColumnas[13])
													->setCellValue('O3',  $titulosColumnas[14]);



					 								$total1 =0;
					 	              $total3 =0;
					 	              $total12 =0;
					 	              $total10 =0;
													$totalC5 =0;
													$totalC6 =0;
													$totalC7 =0;
													$totalC8 =0;
													$totalC9 =0;
													$totalC10 =0;
													$totalC11 =0;
													$totalC12 =0;
													$totalC13 =0;
													$totalC14 =0;


					 		//Se agregan los datos extraids de la DB
					 		$i = 4; //Comienza en la fila 4
					 		while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
					 			$date = date_create($fila['Time_Stamp']);
					 			$formato_fecha = date_format($date, "d-m-Y H:i");

					 				$total1+= $fila['Flujo_C_1'];
					         $total3+= $fila['Flujo_C_2'];
					         $total12+= $fila['Flujo_C_3'];
					         $total10+= $fila['Flujo_C_4'];
									 $totalC5+= $fila['Flujo_C_5'];
									 $totalC6+= $fila['Flujo_C_6'];
									 $totalC7+= $fila['Flujo_C_7'];
									 $totalC8+= $fila['Flujo_C_8'];
									 $totalC9+= $fila['Flujo_C_9'];
									 $totalC10+= $fila['Flujo_C_10'];
									 $totalC11+= $fila['Flujo_C_11'];
									 $totalC12+= $fila['Flujo_C_12'];
									 $totalC13+= $fila['Flujo_C_13'];
									 $totalC14+= $fila['Flujo_C_14'];


					 			$objPHPExcel->setActiveSheetIndex(0)
					 								->setCellValue('A'.$i,  $formato_fecha)
					         		    ->setCellValue('B'.$i,  $fila['Flujo_C_1'])
					 		            ->setCellValue('C'.$i,  $fila['Flujo_C_2'])
					         		    ->setCellValue('D'.$i,  $fila['Flujo_C_3'])
					             		->setCellValue('E'.$i,  $fila['Flujo_C_4'])
													->setCellValue('F'.$i,  $fila['Flujo_C_5'])
													->setCellValue('G'.$i,  $fila['Flujo_C_6'])
													->setCellValue('H'.$i,  $fila['Flujo_C_7'])
													->setCellValue('I'.$i,  $fila['Flujo_C_8'])
													->setCellValue('J'.$i,  $fila['Flujo_C_9'])
													->setCellValue('K'.$i,  $fila['Flujo_C_10'])
													->setCellValue('L'.$i,  $fila['Flujo_C_11'])
													->setCellValue('M'.$i,  $fila['Flujo_C_12'])
													->setCellValue('N'.$i,  $fila['Flujo_C_13'])
													->setCellValue('O'.$i,  $fila['Flujo_C_14']);


					 					$i++;

					 		}
					 			//Aqui se agregan los totales

							// $tituloTotal = array('Total',$total1,$total3,$total12,$total10);
					 		// 	$objPHPExcel->setActiveSheetIndex(0)
					 		// 		->setCellValue('A'.$i, $tituloTotal[0])
					 		// 		->setCellValue('B'.$i, $tituloTotal[1])
					 		// 		->setCellValue('C'.$i, $tituloTotal[2])
					 		// 		->setCellValue('D'.$i, $tituloTotal[3])
					 		// 		->setCellValue('E'.$i, $tituloTotal[4]);


					 				//Estilo titulo Reporte
					 $estiloTituloReporte = array(
					 			'font' => array(
					 				'name'      => 'Arial',
					 					'bold'      => true,
					 					'italic'    => false,
					 						'strike'    => false,
					 						'size' =>16,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 							)
					 				),
					 			'fill' => array(
					 		'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'	=> array('argb' => 'FFfa8236')//Color del fondo del titulo
					 	),
					 				'borders' => array(
					 						'allborders' => array(
					 							'style' => PHPExcel_Style_Border::BORDER_NONE
					 						)
					 				),
					 				'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'rotation'   => 0,
					 					'wrap'       => TRUE
					 		)
					 	);
					 	//Estilo titulo columnas
					 $estiloTituloColumnas = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 						'rgb' => 'fa8236'
					 				)
					 //				,
					 //        		'endcolor'   => array(
					 //            		'argb' => 'FF431a5d'
					 //        		)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'          => TRUE
					 		));

					 	//Estilo totales
					 	$estiloTituloTotales = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		 => PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 							 'rgb' => 'fa8236'
					 				)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'       => TRUE
					 		));
					 	//Estilo de los datos mostrados
					 $estiloInformacion = new PHPExcel_Style();
					 $estiloInformacion->applyFromArray(
					 	array(
					 					'font' => array(
					 						'name'      => 'Arial',
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'		=> array('argb' => '91bdde')
					 	),
					 		'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
					 			),
					 				'borders' => array(
					 						'left'     => array(
					 								'style' => PHPExcel_Style_Border::BORDER_THIN ,
					 							'color' => array(
					 								'rgb' => '3a2a47'
					 								)
					 						)
					 				)
					 		));
					 	//Rango de estilo de titulo reporte
					 //  $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
					 	// Rango de estilo titulos de columnas
					 $objPHPExcel->getActiveSheet()->getStyle('A3:O3')->applyFromArray($estiloTituloColumnas);
					 	// Rango de estilo titulos de totales
					 $objPHPExcel->getActiveSheet()->getStyle('A'.($i).':O'.($i))->applyFromArray($estiloTituloTotales);
					 	//Rango de estilos en los datos
					 $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:O".($i-1));

					 //Rango de las columnas que aplica autoresize
					 for($i = 'A'; $i <= 'Z'; $i++){
					 	$objPHPExcel->setActiveSheetIndex(0)
					 		->getColumnDimension($i)->setAutoSize(TRUE);
					 }

					 // Se asigna el nombre a la hoja
					 $objPHPExcel->getActiveSheet()->setTitle('Reporte');

					 // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
					 $objPHPExcel->setActiveSheetIndex(0);
					 // Inmovilizar paneles
					 $objPHPExcel->getActiveSheet(0)->freezePane('A2');
					 //$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,20);

					 // Se envía el archivo al navegador web, con el nombre que se indica (Excel2007)
					 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					 header("Content-Disposition: attachment; filename=reporte_".date('d-m-Y_h').".xls");
					 header('Cache-Control: max-age=0');

					 // Formato o versiòn de Excel a elegir: Excel5, Excel2007, otros.
					 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					 $objWriter->save('php://output');
					 exit;

}
else{
echo"<script> alert('No hay datos para mostrar')
window.self.location='../';</script>";
}
}






//********************************************
//Medidor 4
//*******************************************
if ($_POST['tipo_medidor'] ==4){

	$sql = "SELECT * FROM medidores WHERE Time_Stamp BETWEEN '$fechaInicial' AND '$fechaFinal'";
	$query = $pdo->prepare($sql);
	$query->execute();
	if ($query->fetchColumn() > 0) {
		date_default_timezone_set('America/Lima');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../PHPExcel/Classes/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("") //Autor
							 ->setLastModifiedBy("") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel")
							 ->setSubject("Reporte Excel")
							 ->setDescription("Reporte de Energía")
							 ->setKeywords("")
							 ->setCategory("Reporte Energía");

							 $tituloReporte = "Reporte de Energía";
					 		$titulosColumnas = array("Fecha y Hora","Baja C1","Baja C3","Alta C1","Alta C3");
					 		// Se agrega la cantidad de celdas que ocupará tituloReporte
					 		// $objPHPExcel->setActiveSheetIndex(0)
					     //     		    ->mergeCells('A1:I1');
					 		// Se agregan los titulos del reporte por columna
					 		$objPHPExcel->setActiveSheetIndex(0)
					 					->setCellValue('A1',  $tituloReporte)
					         		    ->setCellValue('A3',  $titulosColumnas[0])
					 		            ->setCellValue('B3',  $titulosColumnas[1])
					         		    ->setCellValue('C3',  $titulosColumnas[2])
					             		->setCellValue('D3',  $titulosColumnas[3])
					 								->setCellValue('E3',  $titulosColumnas[4]);


					 								$total1 =0;
					 	              $total3 =0;
					 	              $total12 =0;
					 	              $total10 =0;

					 		//Se agregan los datos extraids de la DB
					 		$i = 4; //Comienza en la fila 4
					 		while ($fila = $query->fetch(PDO::FETCH_ASSOC)){
					 			$date = date_create($fila['Time_Stamp']);
					 			$formato_fecha = date_format($date, "d-m-Y H:i");

					 				$total1+= $fila['Res_Acum_C_1'];
					         $total3+= $fila['Res_Acum_C_2'];
					         $total12+= $fila['Res_Acum_C_3'];
					         $total10+= $fila['Res_Acum_C_4'];


					 			$objPHPExcel->setActiveSheetIndex(0)
					 								->setCellValue('A'.$i,  $formato_fecha)
					         		    ->setCellValue('B'.$i,  $fila['Res_Acum_C_1'])
					 		            ->setCellValue('C'.$i,  $fila['Res_Acum_C_2'])
					         		    ->setCellValue('D'.$i,  $fila['Res_Acum_C_3'])
					             		->setCellValue('E'.$i,  $fila['Res_Acum_C_4']);


					 					$i++;

					 		}
					 			//Aqui se agregan los totales
					 		$tituloTotal = array('Total',$total1,$total3,$total12,$total10);
					 			$objPHPExcel->setActiveSheetIndex(0)
					 				->setCellValue('A'.$i, $tituloTotal[0])
					 				->setCellValue('B'.$i, $tituloTotal[1])
					 				->setCellValue('C'.$i, $tituloTotal[2])
					 				->setCellValue('D'.$i, $tituloTotal[3])
					 				->setCellValue('E'.$i, $tituloTotal[4]);


					 				//Estilo titulo Reporte
					 $estiloTituloReporte = array(
					 			'font' => array(
					 				'name'      => 'Arial',
					 					'bold'      => true,
					 					'italic'    => false,
					 						'strike'    => false,
					 						'size' =>16,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 							)
					 				),
					 			'fill' => array(
					 		'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'	=> array('argb' => 'FFfa8236')//Color del fondo del titulo
					 	),
					 				'borders' => array(
					 						'allborders' => array(
					 							'style' => PHPExcel_Style_Border::BORDER_NONE
					 						)
					 				),
					 				'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'rotation'   => 0,
					 					'wrap'       => TRUE
					 		)
					 	);
					 	//Estilo titulo columnas
					 $estiloTituloColumnas = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => 'FFFFFF'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 						'rgb' => 'fa8236'
					 				)
					 //				,
					 //        		'endcolor'   => array(
					 //            		'argb' => 'FF431a5d'
					 //        		)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'          => TRUE
					 		));

					 	//Estilo totales
					 	$estiloTituloTotales = array(
					 				'font' => array(
					 						'name'      => 'Arial',
					 						'bold'      => true,
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		 => PHPExcel_Style_Fill::FILL_SOLID,
					 		'rotation'   => 90,
					 				'startcolor' => array(
					 							 'rgb' => 'fa8236'
					 				)
					 	),

					 	'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					 					'wrap'       => TRUE
					 		));
					 	//Estilo de los datos mostrados
					 $estiloInformacion = new PHPExcel_Style();
					 $estiloInformacion->applyFromArray(
					 	array(
					 					'font' => array(
					 						'name'      => 'Arial',
					 						'color'     => array(
					 								'rgb' => '000000'
					 						)
					 				),
					 				'fill' 	=> array(
					 		'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
					 		'color'		=> array('argb' => '91bdde')
					 	),
					 		'alignment' =>  array(
					 					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					 					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
					 			),
					 				'borders' => array(
					 						'left'     => array(
					 								'style' => PHPExcel_Style_Border::BORDER_THIN ,
					 							'color' => array(
					 								'rgb' => '3a2a47'
					 								)
					 						)
					 				)
					 		));
					 	//Rango de estilo de titulo reporte
					 //  $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
					 	// Rango de estilo titulos de columnas
					 $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);
					 	// Rango de estilo titulos de totales
					 $objPHPExcel->getActiveSheet()->getStyle('A'.($i).':E'.($i))->applyFromArray($estiloTituloTotales);
					 	//Rango de estilos en los datos
					 $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));

					 //Rango de las columnas que aplica autoresize
					 for($i = 'A'; $i <= 'Z'; $i++){
					 	$objPHPExcel->setActiveSheetIndex(0)
					 		->getColumnDimension($i)->setAutoSize(TRUE);
					 }

					 // Se asigna el nombre a la hoja
					 $objPHPExcel->getActiveSheet()->setTitle('Reporte');

					 // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
					 $objPHPExcel->setActiveSheetIndex(0);
					 // Inmovilizar paneles
					 $objPHPExcel->getActiveSheet(0)->freezePane('A2');
					 //$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,20);

					 // Se envía el archivo al navegador web, con el nombre que se indica (Excel2007)
					 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					 header("Content-Disposition: attachment; filename=reporte_".date('d-m-Y_h').".xls");
					 header('Cache-Control: max-age=0');

					 // Formato o versiòn de Excel a elegir: Excel5, Excel2007, otros.
					 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
					 $objWriter->save('php://output');
					 exit;

}
else{
echo"<script> alert('No hay datos para mostrar')
window.self.location='../';</script>";
}
}
?>
