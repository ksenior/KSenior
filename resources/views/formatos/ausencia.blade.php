
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1">
    <link type="text/css" rel="stylesheet" href="{{ generateURL('public/css/formatos_style.css') }}"/>
	<title>Formato Ausencia</title>
</head>
<body>
	<table class="tablaformato" id="boletin bordered">
		<tr>
			<td class="img">
				<img src="{{ generateURL('public/img/logo.png') }}">
			</td>
			<td class="medium "><h4 class="bold">EXCUSA POR AUSENCIA A CLASES</h4></td>
			<td class="small">
				<p class="fz-12">PMC-F-020 Vigencia desde: 23/04/2019 Versión:2</p>
			</td>
		</tr>
	</table>
	@foreach ($datoausencia as $key)
	@endforeach
	<table class="bordered contenido mt-3">
		<tr>
			<td class="bold">NUMERO DOCUMENTO:</td><td>{{ $key->docestudiante }}</td><td class="bold">NOMBRE:</td><td colspan="3">{{ $key->nombrecompleto}}</td>
		</tr>
		<tr>
			<td class="bold">AÑO</td><td>{{ $key->ano }}</td><td class="bold">CURSO</td><td>{{ $key->curso }}</td><td class="bold">PERIODO</td><td>{{ $key->periodo }}</td>
		</tr>
		<tr>
			<td class="bold">JORNADA</td><td>{{ $key->jornada }}</td><td class="bold"># DIAS</td><td>{{ $key->numerodias}}</td><td class="bold">FECHA</td><td>{{ $key->fecha }}</td>
		</tr>
		<tr>
			<td class="bold">ACUDIENTE</td><td colspan="3">{{ $key->acudiente }}</td><td  class="bold">PARENTESCO</td><td>{{ $key->parentesco }}</td>
		</tr>
		<tr>
			<td class="bold titulo" colspan="6">MOTIVO</td>
		</tr>
		<tr>
			<td colspan="6" class="motivo">{{ $key->motivo }}</td>
		</tr>
	</table>
	<table class="tablaboletin bordered mt-2 tizq">
		<tr>
			<td>Elaborado Por: Coordinación de Calidad</td>
			<td>Verificado Por: Coordinación de Calidad</td>
			<td>Aprobado DAD</td>
		</tr>
		<tr>
			<td>Archivado Por: Bienestar Estudiantil</td>
			<td>Tiempo de Archivo: Durante la vida escolar</td>
			<td>Destruido por: Bienestar Estudiantil</td>
		</tr>
	</table>

</body>
</html>