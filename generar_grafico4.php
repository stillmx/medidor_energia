<?php
session_start();
	require_once ("jpgraph/src/jpgraph.php");
	require_once ("jpgraph/src/jpgraph_pie.php");
	//require_once ("jpgraph/src/jpgraph_pie3d.php");

	// Se define el array de valores y el array de la leyenda
	$datos = array();
	$leyenda = array("Baja C1 (%1.1f%%)","Baja C3 (%1.1f%%)","Alta C1 (%1.1f%%)","Alta C3 (%1.1f%%)");
	array_push($datos,$_SESSION["totalBajaC1"],$_SESSION["totalBajaC3"],$_SESSION["totalAltaC1"],$_SESSION["totalAltaC3"]);
	//array_push($leyenda,$_SESSION["total1"],$_SESSION["total2"],$_SESSION["total3"]);



	//Se define el grafico
	$grafico = new PieGraph(1000,500,"auto");

	//Definimos el titulo
	$grafico->title->Set("FLUJO INSTANSTANEO AIRE C");
	// $grafico->title->SetFont(FF_VERDANA,FS_BOLD,14);
	// $grafico->legend->SetFont(FF_VERDANA,FS_BOLD,8);
	//Añadimos el titulo y la leyenda
	$pie_1 = new PiePlot($datos); //Crea el Gráfico
	$pie_1->SetLegends($leyenda);
	$pie_1->SetCenter(0.4);
	$pie_1->SetSize(160);
	$pie_1->ShowBorder($aFlg=false);
	// $pie_1->value->SetFont(FF_ARIAL,FS_BOLD,11);
	$pie_1->value->SetColor("navy");

	//$grafico->SetShadow(); Sombra al cuadro

	//$pie_1->SetSliceColors(array('darkred','navy','lightblue','orange','gray','teal'));//Colores del pie

	//$pie_1->ExplodeAll(30);//separa las divisiones del pie

	//$pie_1->SetShadow(); //Sombra al pie
	//$pie_1->SetLabelType(PIE_VALUE_ADJPERCENTAGE); //Redondear porcentaje
	//$pie_1->SetColor($aColor); //Color de la linea del border del pie

	//Se muestra el grafico
	$grafico->Add($pie_1);
	$grafico->Stroke();
?>
