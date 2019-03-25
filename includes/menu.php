<!--INICIO DE FORMULARIO  -->

 <form id="formulario" action="" method="post">
	 <fieldset>
		 <legend>Reporte de Energía</legend>
	 <table class="formulario">
		 <tr>
			 <td class="izquierda">Seleccione el grupo:</td>
			 <td>
				 <select name="tipo_medidor" required="required" width="150px">
					 <!-- <option disabled selected>Medidores</option> -->

					 <option value="1" selected>Flujo Instantaneo Aire B</option>
					 <option value="2">Flujo Instantaneo Aire C</option>
					 <!-- <option value="3">Consumo de Aire B</option>
					 <option value="4">Consumo de Aire C</option> -->

				 </select>
			 </td>
		 </tr>

		 <tr>
       <td class="izquierda">Escriba fecha inicial:</td>
			 <td>
				 <input type="date" name="fecha_inicial" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				 <input type="time" name="hora_inicial" value="00:00" required>
			 </td>
		 </tr>
		 <tr>
			 <td class="izquierda">Escriba fecha final:</td>
			 <td>
				 <input type="date" name="fecha_final" value="<?php echo date('Y-m-d'); ?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
				 <input type="time" name="hora_final" value="00:00" required>
			 </td>
		 </tr>
		 <tr>
			 <td>
         <!-- ¿Desea un reporte en Excel?
        <input type="checkbox" name="flag_excel" value="yes"> -->
        <input type="submit" name="submit" value="Descargar reporte en Excel" dir="paginas/reporte_excel.php">
      </td>
      <td>
        <input type="submit" name="submit" value="Enviar" dir="index.php?pagina=consulta">
      </td>
    </tr>
  </table>
 </fieldset>
</form>
<script type="text/javascript">
$(document).ready(function(){

$("input[type=submit]").click(function() {
  var accion = $(this).attr('dir');
  $('form').attr('action', accion);
  $('form').submit();
});
});
</script>
