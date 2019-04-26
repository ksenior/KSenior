
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1">
    <link type="text/css" rel="stylesheet" href="{{ generateURL('public/css/boletin_style.css') }}"/>
	<title>Boletin</title>
</head>
<body>

@php
$fechageneracion= date("d",strtotime($fecha)).' DE '.convertirmes(date("n",strtotime($fecha))).' DE '.date("Y",strtotime($fecha));
foreach($datoestudiante as $estudiante){
	$maxperiodo=0;
	$acump=array(null,null,null,null,null);
	$acumcastellano=0;
	$acummatematica=0;
	$acumnaturales=0;
	$acumsociales=0;
	$acumcomerciales=0;
	$acumingles=0;
	$castellano=array(null, null, null, null);
	$fallascastellano=array(null, null, null, null);
	$matematicas=array(null, null, null, null);
	$fallasmatematicas=array(null, null, null, null);
	$naturales=array(null, null, null, null);
	$fallasnaturales=array(null, null, null, null);
	$sociales=array(null, null, null, null);
	$fallassociales=array(null, null, null, null);
	$comerciales=array(null, null, null, null);
	$fallascomerciales=array(null, null, null, null);
	$ingles=array(null, null, null, null);
	$fallasingles=array(null, null, null, null);
	$electivas=array(null, null, null, null);
	$fallaselectivas=array(null, null, null, null);
	$optativas=array(null, null, null, null);
	$disciplina=array(null, null, null, null,null);
	$datonotas = getNotasAlumno($estudiante->numerodoc,$estudiante->ano,$estudiante->curso,$periodo);
	foreach ($datonotas as $key => $value) {
		$maxperiodo=$key+1;
		$acumcastellano=$acumcastellano+$value->CASTELLANO;
		$acummatematica=$acummatematica+$value->MATEMATICA;
		$acumnaturales=$acumnaturales+$value->NATURALES;
		$acumsociales=$acumsociales+$value->SOCIALES;
		$acumcomerciales=$acumcomerciales+$value->COMERCIALES;
		$acumingles=$acumingles+$value->INGLES;
		switch($key){
			case 0:
				$castellano[$key]=$value->CASTELLANO;
				$fallascastellano[$key]=$value->FALLASCASTELLANO;
				$matematicas[$key]=$value->MATEMATICA;
				$fallasmatematicas[$key]=$value->FALLASMATEMATICA;
				$naturales[$key]=$value->NATURALES;
				$fallasnaturales[$key]=$value->FALLASNATURALES;
				$sociales[$key]=$value->SOCIALES;
				$fallassociales[$key]=$value->FALLASSOCIALES;
				$ingles[$key]=$value->INGLES;
				$fallasingles[$key]=$value->FALLASINGLES;
				$comerciales[$key]=$value->COMERCIALES;
				$fallascomerciales[$key]=$value->FALLASCOMERCIALES;
				$electivas[$key]=$value->ELECTIVAS ;
				$optativas[$key]=$value->OPTATIVA;
				$acump[$key+1]=$acump[$key+1]+$value->CASTELLANO+$value->MATEMATICA+$value->NATURALES+$value->SOCIALES+$value->INGLES+$value->COMERCIALES;
				$disciplina[$key+1]=$value->DISCIPLINA;
			break;
			case 1:
				$castellano[$key]=$value->CASTELLANO;
				$fallascastellano[$key]=$value->FALLASCASTELLANO;
				$matematicas[$key]=$value->MATEMATICA;
				$fallasmatematicas[$key]=$value->FALLASMATEMATICA;
				$naturales[$key]=$value->NATURALES;
				$fallasnaturales[$key]=$value->FALLASNATURALES;
				$sociales[$key]=$value->SOCIALES;
				$fallassociales[$key]=$value->FALLASSOCIALES;
				$ingles[$key]=$value->INGLES;
				$fallasingles[$key]=$value->FALLASINGLES;
				$comerciales[$key]=$value->COMERCIALES;
				$fallascomerciales[$key]=$value->FALLASCOMERCIALES;
				$electivas[$key]=$value->ELECTIVAS ;
				$optativas[$key]=$value->OPTATIVA;
				$acump[$key+1]=$acump[$key+1]+$value->CASTELLANO+$value->MATEMATICA+$value->NATURALES+$value->SOCIALES+$value->INGLES+$value->COMERCIALES;
				$disciplina[$key+1]=$value->DISCIPLINA;
			break;
			case 2:
				$castellano[$key]=$value->CASTELLANO;
				$fallascastellano[$key]=$value->FALLASCASTELLANO;
				$matematicas[$key]=$value->MATEMATICA;
				$fallasmatematicas[$key]=$value->FALLASMATEMATICA;
				$naturales[$key]=$value->NATURALES;
				$fallasnaturales[$key]=$value->FALLASNATURALES;
				$sociales[$key]=$value->SOCIALES;
				$fallassociales[$key]=$value->FALLASSOCIALES;
				$ingles[$key]=$value->INGLES;
				$fallasingles[$key]=$value->FALLASINGLES;
				$comerciales[$key]=$value->COMERCIALES;
				$fallascomerciales[$key]=$value->FALLASCOMERCIALES;
				$electivas[$key]=$value->ELECTIVAS ;
				$optativas[$key]=$value->OPTATIVA;
$acump[$key+1]=$acump[$key+1]+$value->CASTELLANO+$value->MATEMATICA+$value->NATURALES+$value->SOCIALES+$value->INGLES+$value->COMERCIALES;
				$disciplina[$key+1]=$value->DISCIPLINA;
			break;
			case 3:
				$castellano[$key]=$value->CASTELLANO;
				$fallascastellano[$key]=$value->FALLASCASTELLANO;
				$matematicas[$key]=$value->MATEMATICA;
				$fallasmatematicas[$key]=$value->FALLASMATEMATICA;
				$naturales[$key]=$value->NATURALES;
				$fallasnaturales[$key]=$value->FALLASNATURALES;
				$sociales[$key]=$value->SOCIALES;
				$fallassociales[$key]=$value->FALLASSOCIALES;
				$ingles[$key]=$value->INGLES;
				$fallasingles[$key]=$value->FALLASINGLES;
				$comerciales[$key]=$value->COMERCIALES;
				$fallascomerciales[$key]=$value->FALLASCOMERCIALES;
				$electivas[$key]=$value->ELECTIVAS ;
				$optativas[$key]=$value->OPTATIVA;
				$acump[$key+1]=$acump[$key+1]+$value->CASTELLANO+$value->MATEMATICA+$value->NATURALES+$value->SOCIALES+$value->INGLES+$value->COMERCIALES;
				$disciplina[$key+1]=$value->DISCIPLINA;
			break;
		}
	}
	for($i=2;$i<=4;$i++){
		if(!is_null($acump[$i])){
			$acump[$i]=$acump[$i]+$acump[$i-1];
		}	
	}
	@endphp
	<table class="tablaboletin" id="boletin bordered">
		<tr>
			<td class="img">
				<img src="{{ generateURL('public/img/logo.png') }}">
			</td>
			<td class="medium "><h2 class="bold">INFORME ACADÉMICO</h2></td>
			<td class="small">
				<p class="fz-12">PEV-F-001 Vigencia desde: 12/04/2019 Versión:6</p>
			</td>
		</tr>
	</table>
	<div id="titulo" class="mt-1">
		<center>
		<p class="bold fz-12">PREESCOLAR - PRIMARIA Y BACHILLERATO COMERCIAL</p>
		<p class="bold fz-12">Con énfasis en manejo y uso de Computadoras</p>
		<p>Resolución de Actualización:0348 del 20-IX-2.013</p>
		<p class="bold fz-12">INFORME ACADÉMICO (Según Decreto 1290 del 2009)</p>
	</center>	
	</div>
	<table class="tablaboletin bordered mt-1 fz-11">
		<tr>
			<td ><span class="bold">NOMBRE DEL ESTUDIANTE:</span> {{ $estudiante->nombrecompleto }}</td>
		</tr>
		<tr>
			<td ><span class="bold">CÓDIGO:</span> {{ $estudiante->codmatricula }}  <span class="bold">GRADO:</span> {{ $estudiante->curso }}        <span class="bold">JORNADA: </span> {{ $estudiante->	jornada }}       </td>
		</tr>
	</table>
	<table id="notas" class="tablaboletin bordered mt-1">
		<thead>
			<tr>
				<td rowspan="2" class="bold">ÁREA</td>
				<td rowspan="2" class="bold">ASIGNATURAS</td>
				<td rowspan="2" class="bold">CURSOS</td>
				<td colspan="3" class="bold">PERIODO 1(25/100)</td>
				<td colspan="3" class="bold">PERIODO 2(50/100)</td>
				<td colspan="3" class="bold">PERIODO 3(75/100)</td>
				<td colspan="3" class="bold">PERIODO 4(100/100)</td>
				<td class="bold">DESEMPEÑO</td>
			</tr>
			<tr class="bold">
				<td>F</td>
				<td>V</td>
				<td>D</td>
				<td>F</td>
				<td>V</td>
				<td>D</td>
				<td>F</td>
				<td>V</td>
				<td>D</td>
				<td>F</td>
				<td>V</td>
				<td>D</td>
				<td>ACUMULADO</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="3" class="bold">CASTELLANO</td>
				<td>Plan Lector</td>
				<td>6°,7°,8°,9°,10°,11°</td>
				<td rowspan="3">{{ $fallascastellano[0]}}</td>
				<td rowspan="3">{{ $castellano[0]}}</td>
				<td rowspan="3">{{ evaluar_desempeno($castellano[0],1) }}</td>
				@if(!is_null($castellano[1]))
				<td rowspan="3">{{ $fallascastellano[1]}}</td>
				<td rowspan="3">
					{{ $castellano[0]+$castellano[1]}}
				</td>
				<td rowspan="3">{{ evaluar_desempeno($castellano[0]+$castellano[1],2) }}</td>
				@else
				<td rowspan="3"></td><td rowspan="3"></td><td rowspan="3"></td>
				@endif
				@if(!is_null($castellano[2]))
				<td rowspan="3">{{ $fallascastellano[2]}}</td>
					<td rowspan="3">
						{{ $castellano[0]+$castellano[1]+$castellano[2]}}
					</td>
					<td rowspan="3">{{ evaluar_desempeno($castellano[0]+$castellano[1]+$castellano[2],3) }}</td>
				@else
					<td rowspan="3"></td><td rowspan="3"></td><td rowspan="3"></td>
				@endif
				
				@if(!is_null($castellano[3]))
				<td rowspan="3">{{ $fallascastellano[3]}}</td>
				<td rowspan="3">
					{{ $castellano[0]+$castellano[1]+$castellano[2]}}
				</td>
				<td rowspan="3">{{ evaluar_desempeno($castellano[0]+$castellano[1]+$castellano[2]+$castellano[3],4) }}</td>
				@else
				<td rowspan="3"></td><td rowspan="3"></td><td rowspan="3"></td>
				@endif
				<td rowspan="3">{{evaluar_desempeno(evaluar_desempeno($acumcastellano,$maxperiodo),7) }}</td>
			</tr>
			<tr>
				<td>Ortografía</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td>Gramática</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td rowspan="6" class="bold">MATEMÁTICAS</td>
				<td>Aritmética</td>
				<td>6° y 7°</td>
				<td rowspan="6">{{ $fallasmatematicas[0]}}</td>
				<td rowspan="6">{{ $matematicas[0]}}</td>
				<td rowspan="6">{{ evaluar_desempeno($matematicas[0],1) }}</td>
				@if(!is_null($matematicas[1]))
				<td rowspan="6">{{ $fallasmatematicas[1]}}</td>
				<td rowspan="6">{{ $matematicas[0]+$matematicas[1]}}</td>
				<td rowspan="6">{{ evaluar_desempeno($matematicas[0]+$matematicas[1],2) }}</td>
				@else
				<td rowspan="6"></td><td rowspan="6"></td><td rowspan="6">
				@endif
				@if(!is_null($matematicas[2]))
				<td rowspan="6">{{ $fallasmatematicas[2]}}</td>
				<td rowspan="6">{{ $matematicas[0]+$matematicas[1]+$matematicas[2]}}</td>
				<td rowspan="6">{{ evaluar_desempeno($matematicas[0]+$matematicas[1]+$matematicas[2],3) }}</td>
				@else
				<td rowspan="6"></td><td rowspan="6"></td><td rowspan="6">
				@endif
				@if(!is_null($matematicas[3]))
				<td rowspan="6">{{ $fallasmatematicas[3]}}</td>
				<td rowspan="6">{{ $acummatematica}}</td>
				<td rowspan="6">{{ evaluar_desempeno($acummatematica,4) }}</td>
				@else
				<td rowspan="6"></td><td rowspan="6"></td><td rowspan="6">
				@endif
				<td rowspan="6">{{evaluar_desempeno(evaluar_desempeno($acummatematica,$maxperiodo),7) }}</td>
			</tr>
			<tr>
				<td>Geometría</td>
				<td>6°,7°,8°,9°</td>
			</tr>
			<tr>
				<td>Estadística</td>
				<td>6°,7°,8°,9°</td>
			</tr>
			<tr>
				<td>Algebra</td>
				<td>8° y 9°</td>
			</tr>
			<tr>
				<td>Trigo - Geo Analítica</td>
				<td>10°</td>
			</tr>
			<tr>
				<td>Cálculo Infinitesimal</td>
				<td>11°</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td rowspan="5" class="bold">C. NATURALES</td>
				<td>Biología</td>
				<td>6°,7°,8°</td>
				<td rowspan="5">{{ $fallasnaturales[0]}}</td>
				<td rowspan="5">{{ $naturales[0]}}</td>
				<td rowspan="5">{{ evaluar_desempeno($naturales[0],1) }}</td>
				@if(!is_null($naturales[1]))
				<td rowspan="5">{{ $fallasnaturales[1]}}</td>
				<td rowspan="5">{{ $naturales[0]+$naturales[1]}}</td>
				<td rowspan="5">{{ evaluar_desempeno($naturales[0]+$naturales[1],2) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				@if(!is_null($naturales[2]))
				<td rowspan="5">{{ $fallasnaturales[2]}}</td>
				<td rowspan="5">{{ $naturales[0]+$naturales[1]+$naturales[2]}}</td>
				<td rowspan="5">{{ evaluar_desempeno($naturales[0]+$naturales[1]+$naturales[2],3) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				@if(!is_null($naturales[3]))
				<td rowspan="5">{{ $fallasnaturales[3]}}</td>
				<td rowspan="5">{{ $acumnaturales}}</td>
				<td rowspan="5">{{ evaluar_desempeno($acumnaturales,4) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				<td rowspan="5">{{ evaluar_desempeno(evaluar_desempeno($acumnaturales,$maxperiodo),7) }}</td>
			</tr>
			<tr>
				<td>Pre-Química</td>
				<td>6°,7°,8°,9°</td>
			</tr>
			<tr>
				<td>Anatomía</td>
				<td>9°</td>
			</tr>
			<tr>
				<td>Química</td>
				<td>10° y 11°</td>
			</tr>
			<tr>
				<td>Física</td>
				<td>10° y 11°</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td rowspan="5" class="bold">C SOCIALES</td>
				<td>Historia</td>
				<td>6°,7°,8°,9°</td>
				<td rowspan="5">{{ $fallassociales[0]}}</td>
				<td rowspan="5">{{ $sociales[0]}}</td>
				<td rowspan="5">{{ evaluar_desempeno($sociales[0],1) }}</td>
				@if(!is_null($sociales[1]))
				<td rowspan="5">{{ $fallassociales[1]}}</td>
				<td rowspan="5">{{ $sociales[0]+$sociales[1]}}</td>
				<td rowspan="5">{{ evaluar_desempeno($sociales[0]+$sociales[1],2) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				@if(!is_null($sociales[2]))
				<td rowspan="5">{{ $fallassociales[2]}}</td>
				<td rowspan="5">{{ $sociales[0]+$sociales[1]+$sociales[2]}}</td>
				<td rowspan="5">{{ evaluar_desempeno($sociales[0]+$sociales[1]+$sociales[2],3) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				@if(!is_null($sociales[3]))
				<td rowspan="5">{{ $fallassociales[3]}}</td>
				<td rowspan="5">{{ $acumsociales}}</td>
				<td rowspan="5">{{ evaluar_desempeno($acumsociales,4) }}</td>
				
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				<td rowspan="5">{{ evaluar_desempeno(evaluar_desempeno($acumsociales,$maxperiodo),7) }}</td>
			</tr>
			<tr>
				<td>Geografía</td>
				<td>6°,7°,8°,9°</td>
			</tr>
			<tr>
				<td>C Ciudadana</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td>Filosofía</td>
				<td>10° y 11°</td>
			</tr>
			<tr>
				<td>Economía</td>
				<td>10° y 11°</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td class="bold">INGLES</td>
				<td>Ingles</td>
				<td>6°,7°,8°,9°,10°,11°</td>
				<td >{{ $fallasingles[0]}}</td>
				<td >{{ $ingles[0]}}</td>
				<td >{{ evaluar_desempeno($ingles[0],1) }}</td>
				@if(!is_null($ingles[1]))
				<td >{{ $fallasingles[1]}}</td>
				<td >{{ $ingles[0]+$ingles[1]}}</td>
				<td >{{ evaluar_desempeno($ingles[0]+$ingles[1],2) }}</td>
				@else
				<td></td><td></td><td></td>
				@endif
				@if(!is_null($ingles[2]))
				<td >{{ $fallasingles[2]}}</td>
				<td >{{ $ingles[0]+$ingles[1]+$ingles[2]}}</td>
				<td >{{ evaluar_desempeno($ingles[0]+$ingles[1]+$ingles[2],3) }}</td>
				@else
				<td></td><td></td><td></td>
				@endif
				@if(!is_null($ingles[3]))
				<td >{{ $fallasingles[3]}}</td>
				<td >{{ $acumingles}}</td>
				<td >{{ evaluar_desempeno(acumingles,4) }}</td>
				@else
				<td></td><td></td><td></td>
				@endif
				<td >{{ evaluar_desempeno(evaluar_desempeno($acumingles,$maxperiodo),7)  }}</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td rowspan="5" class="bold">COMERCIALES</td>
				<td>Informática</td>
				<td>6°,7°,8°,9°,10°,11°</td>
				<td  rowspan="5">{{ $fallascomerciales[0]}}</td>
				<td  rowspan="5">{{ $comerciales[0]}}</td>
				<td  rowspan="5">{{ evaluar_desempeno($comerciales[0],1) }}</td>
				@if(!is_null($comerciales[1]))
				<td  rowspan="5">{{ $fallascomerciales[1]}}</td>
				<td  rowspan="5">{{ $comerciales[0]+$comerciales[1]}}</td>
				<td  rowspan="5">{{ evaluar_desempeno($comerciales[0]+$comerciales[1],2) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				@if(!is_null($comerciales[2]))
				<td  rowspan="5">{{ $fallascomerciales[2]}}</td>
				<td  rowspan="5">{{ $comerciales[0]+$comerciales[1]+$comerciales[2]}}</td>
				<td  rowspan="5">{{ evaluar_desempeno($comerciales[0]+$comerciales[1]+$comerciales[2],3) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				@if(!is_null($comerciales[3]))
				<td  rowspan="5">{{ $fallascomerciales[3]}}</td>
				<td  rowspan="5">{{ $acumcomerciales}}</td>
				<td  rowspan="5">{{ evaluar_desempeno($acumcomerciales,4) }}</td>
				@else
				<td rowspan="5"></td><td rowspan="5"></td><td rowspan="5"></td>
				@endif
				<td  rowspan="5">{{ evaluar_desempeno(evaluar_desempeno($acumcomerciales,$maxperiodo),7)  }}</td>
			</tr>
			<tr>
				<td>Ten Oficina</td>
				<td>10° y 11°</td>
			</tr>
			<tr>
				<td>Emprendimiento</td>
				<td>10° y 11°</td>
			</tr>
			<tr>
				<td>Contabilidad</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td>Derecho Laboral</td>
				<td>10° y 11°</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td rowspan="2" class="bold">ELECTIVAS</td>
				<td>Religión / Valores</td>
				<td>6°,7°,8°,9°,10°,11°</td>
				<td rowspan="2"></td>
				<td rowspan="2">{{ $electivas[0]}}</td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td rowspan="2" >{{ $electivas[1]}}</td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td rowspan="2">{{ $electivas[2]}}</td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
				<td rowspan="2">{{ $electivas[3]}}</td>
				<td rowspan="2"></td>
				<td rowspan="2"></td>
			</tr>
			<tr>
				<td>Edu Física / Deportes</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr><td colspan="16"></td></tr>
			<tr>
				<td rowspan="5" class="bold">OPTATIVAS</td>
				<td>Libro Azul</td>
				<td>6°,7°,8°,9°,10°,11°</td>
				<td rowspan="5"></td>
				<td rowspan="5">{{ $optativas[0]}}</td>
				<td rowspan="5"></td>
				<td rowspan="5"></td>
				<td rowspan="5" >{{ $optativas[1]}}</td>
				<td rowspan="5"></td>
				<td rowspan="5"></td>
				<td rowspan="5">{{ $optativas[2]}}</td>
				<td rowspan="5"></td>
				<td rowspan="5"></td>
				<td rowspan="5">{{ $optativas[3]}}</td>
				<td rowspan="5"></td>
				<td rowspan="5"></td>
			</tr>
			<tr>
				<td>Asistencia</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td>Tra Investigación</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td>Participación</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td>Tareas y Compromiso</td>
				<td>6°,7°,8°,9°,10°,11°</td>
			</tr>
			<tr>
				<td colspan="3" class="bold tizq">PROMEDIO</td>
				<td></td>
				<td>{{ getpromedio($acump[1],6) }}</td>
				<td></td>
				<td></td>
				<td>{{ getpromedio($acump[2],6) }}</td>
				<td></td>
				<td></td>
				<td>{{ getpromedio($acump[3],6) }}</td>
				<td></td>
				<td></td>
				<td>{{ getpromedio($acump[4],6) }}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" class="bold tizq">DESEMPEÑO</td>
				<td></td>
				<td>{{ evaluar_desempeno(getpromedio($acump[1],6),1) }}</td>
				<td></td>
				<td></td>
				<td>{{ evaluar_desempeno(getpromedio($acump[2],6),2) }}</td>
				<td></td>
				<td></td>
				<td>{{ evaluar_desempeno(getpromedio($acump[3],6),3) }}</td>
				<td></td>
				<td></td>
				<td>{{ evaluar_desempeno(getpromedio($acump[4],6),4) }}</td>
				<td></td>
				<td>{{ evaluar_desempeno(evaluar_desempeno(getpromedio($acump[$maxperiodo],6),$maxperiodo),7) }}</td> <!-- campo promedio -->
			</tr>
			<tr>
				<td colspan="3" class="bold tizq">CONVIVENCIA</td>
				<td></td>
				<td>{{ $disciplina[1]}}</td>
				<td></td>
				<td></td>
				<td>{{ $disciplina[2]}}</td>
				<td></td>
				<td></td>
				<td>{{ $disciplina[3]}}</td>
				<td></td>
				<td></td>
				<td>{{ $disciplina[4]}}</td>
				<td></td>
				<td>{{ evaluar_desempeno($disciplina[$maxperiodo],6)}}</td>
			</tr>
		</tbody>
	</table>

	<table class="bordered tablaboletin mt-1 tizq">
		<tr>
			<td class="bold">OBSERVACIONES DE LA COMISIÓN DE EVALUACIÓN Y PROMOCIÓN</td>
			@php
			$observaciones = getObservacionesAlumno($estudiante->numerodoc,$estudiante->ano,$periodo);
			@endphp
			@foreach ($observaciones as $key)
				<tr><td>{!! $key->observacion !!}</td></tr>
			@endforeach
		</tr>
	</table>
	<table class="tablaboletin bordered mt-1 bold" >
		<tr>
			<td class="bold">Escala de Evaluación Académica IV Periodo: 100 de 100</td>
			<td rowspan="5" class="pse">
				<p class="bold">ESCALA DE EVALUACÍON DE CONVIVENCIA</p>
				<p>MS: Muy Satisfactorio</p>
				<p>S: Satisfactorio</p>
				<p>A: Aceptable</p>
				<p>NS: No Satisfactorio</p>
			</td>
			<td rowspan="2">I.H.S: Intensidad Horaria Semanal</td>
			<td rowspan="5" class="firma">
				<br><br>
				<br><br>
				<hr>
				<p>DIRECCIÓN</p>
				<p>MALAMBO {{ $fechageneracion }}</p>
			</td>
		</tr>
		<tr>
			<td class="tizq">S= Superior 90 a 100</td>
		</tr>
		<tr>
			<td class="tizq">A= Alto 80 a 89</td>
			<td>F: Fallas</td>
			
		</tr>
		<tr>
			<td class="tizq" >B= Básico 60 a 79</td>
			<td>V: Valoracion</td>
			
		</tr>
		<tr>
			<td class="tizq">Z= Bajo 0 a 59</td>
			<td>D: Desempeño</td>
		</tr>
	</table>
	<table class="tablaboletin bordered mt-1 tizq">
		<tr>
			<td>Elaborado Por: Coordinación General</td>
			<td>Verificado Por: Coordinadora de Calidad</td>
			<td>Aprobado DAD</td>
		</tr>
		<tr>
			<td>Archivado Por: Secretaría General</td>
			<td>Tiempo de Archivo: 1 año</td>
			<td>Destruido por: Secretaría General</td>
		</tr>
	</table>
	<div class="page-break"></div>
@php
}
@endphp
</body>
</html>