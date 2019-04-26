
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1">
    <link type="text/css" rel="stylesheet" href="{{ generateURL('public/css/formatos_style.css') }}"/>
	<title>Formato Sesiones</title>
</head>
<body>
	<table class="tablaformato" id="boletin bordered">
		<tr>
			<td class="img">
				<img src="{{ generateURL('public/img/logo.png') }}">
			</td>
			<td class="medium "><h4 class="bold">SESIONES BIENESTAR ESTUDIANTIL</h4></td>
			<td class="small">
				<p class="fz-12">PMC-F-020 Vigencia desde: 23/04/2019 Versión:2</p>
			</td>
		</tr>
	</table>
	@foreach ($datosesion as $key)
	@endforeach
	<table class="bordered contenido mt-2">
		<tr>
			<td class="bold">NUMERO DOCUMENTO:</td><td>{{ $key->docestudiante }}</td><td class="bold">NOMBRE:</td><td colspan="3">{{ $key->nombrecompleto}}</td>
		</tr>
		<tr>
			<td class="bold">AÑO</td><td>{{ $key->ano }}</td><td class="bold">CURSO</td><td>{{ $key->curso }}</td><td class="bold">PERIODO</td><td>{{ $key->periodo }}</td>
		</tr>
		<tr>
			<td class="bold">JORNADA</td><td>{{ $key->jornada }}</td><td class="bold">PSICOLOGA</td><td colspan="3">{{ $key->docente }}</td>
		</tr>
		<tr>
			<td class="bold">MOTIVO SESION</td><td colspan="5">{{ $key->motivo}}</td>
		</tr>
		<tr>
			<td class="bold" colspan="2">OBSERVACIONES</td>
			<td class="bold" colspan="4">COMPROMISO</td>
		</tr>
		<tr>
			<td colspan="2" class="versiones">{{ $key->observacion }}</td>
			<td colspan="4" class="versiones">{{ $key->compromiso }}</td>
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