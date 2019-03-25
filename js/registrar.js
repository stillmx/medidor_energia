var x;
x=$(document);
x.ready(registrar);

var form = $('<form>Número Cédula:<input class="campos" name="cedula" id="cedula" type="text" maxlength="9" placeholder="00000" required>Nombre:<input class="campos" id="nombre" name="nombre" type="text" size="60" placeholder="Nombre y Apellido" readonly="readonly" required>Teléfono:<input class="campos" id="telf" name="telefono" type="text" placeholder="04149623361" required>Email:<input class="campos" id="email" name="email" type="text" size="30" placeholder="mx@tudominio.com"><input type="submit" name=enviar value="Enviar" /></form>');

function registrar()
{
	var x;
	x=$('#reg');
	x.click(muestraform);
}

form.submit(function(argument) {
	form.remove();
	form[0].reset()
	return false;
}).find("#cedula").blur(function(event) {
	console.log("buscar ajax",$(this).val());

	$.post('buscar.php',{
		cedula:$(this).val()
	}, function(data, textStatus, xhr) {
		
	});
});

function muestraform()
{
	var x;
	x=$('#form');
	x.append(form);
	
}