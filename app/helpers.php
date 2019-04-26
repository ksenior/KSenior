<?php
    use Illuminate\Support\Facades\DB;

    function getpromedio($valor,$materias){
        if($valor==0){
            return "";
        }
        else{
            return round($valor/$materias);
        }
    }
	function generateURL($url){
        //return $_SERVER['APP_URL'].'/'.$_SERVER['APP_NAME'].'/'.$url;
        return 'http://192.168.10.128/colegio/'.$url;
        //return 'http://192.168.1.19/colegio/'.$url;
    }

    function getNotasAlumno($identificacion,$ano,$curso,$periodo){
        $sql="SELECT vw_notas.*
            , vw_notas.ELECTIVAS AS ELECTIVAS
            , vw_fallas.castellano AS FALLASCASTELLANO 
            , vw_fallas.matematica AS FALLASMATEMATICA
            , vw_fallas.naturales AS FALLASNATURALES
            , vw_fallas.sociales AS FALLASSOCIALES
            , vw_fallas.ingles AS FALLASINGLES
            , vw_fallas.comerciales AS FALLASCOMERCIALES
            FROM (SELECT * 
            FROM notas 
            WHERE numerodoc = $identificacion
            AND ano = $ano
            AND curso = '".$curso."' AND periodo <= $periodo)
            AS vw_notas
            LEFT join (SELECT * 
            FROM fallas 
            WHERE numerodoc = $identificacion
            AND ano = $ano
            AND curso = '".$curso."' AND periodo <= $periodo) vw_fallas
            on vw_notas.ano = vw_fallas.ano
            AND vw_notas.periodo = vw_fallas.periodo
            AND vw_notas.curso = vw_fallas.curso
            AND vw_notas.numerodoc = vw_fallas.numerodoc";
        $datonotas = DB::connection('mysql')->select(DB::raw($sql));
        return $datonotas;

    }

    function getObservacionesAlumno($identificacion,$ano,$periodo){
        $sql="SELECT DISTINCT ano,numerodoc,periodo,oa.descripcioncod observacion 
            FROM obsestudiante oe LEFT JOIN obsacademicas oa ON oe.codobservacion = oa.codigo
            WHERE numerodoc = $identificacion AND ano = $ano AND periodo = $periodo
            UNION ALL
            SELECT DISTINCT ano,numerodoc,periodo,oa.descripcioncod observacion 
            FROM disciplina oe LEFT JOIN obsdisciplinarias oa ON oe.codobservacion = oa.codigo
            WHERE numerodoc = $identificacion AND ano = $ano AND periodo = $periodo";
        $observaciones = DB::connection('mysql')->select(DB::raw($sql));
        return $observaciones;
    }

    function getDisciplinaAlumno($identificacion,$ano,$periodo){
        $sql="select ano,numerodoc,periodo,getTipoDisciplina(codobservacion) disciplina FROM disciplina where numerodoc = $identificacion and ano = $ano and periodo = $periodo";
        $observaciones = DB::connection('mysql')->select(DB::raw($sql));
        return $observaciones;
    }

    function convertirmes($mes){
        $meses=array('','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
        return $meses[$mes];
    }

    function evaluar_desempeno($valor,$periodo){
        if($valor=="") return "";
    	switch ($periodo) {
    		case 1:
    			if($valor >= 0 && $valor <15){
    				return 'Z';
    			}
    			if($valor >=15  && $valor <20){
    				return 'B';
    			}
    			if($valor >= 20 && $valor <23){
    				return 'A';
    			}
    			if($valor >=23){
    				return 'S';
    			}
    			break;
    		case 2:
    			if($valor >= 0 && $valor <30){
    				return 'Z';
    			}
    			if($valor >=30  && $valor <40){
    				return 'B';
    			}
    			if($valor >= 40 && $valor <45){
    				return 'A';
    			}
    			if($valor >=45){
    				return 'S';
    			}
    			break;
    		case 3:
    			if($valor >= 0 && $valor <45){
    				return 'Z';
    			}
    			if($valor >=45  && $valor <60){
    				return 'B';
    			}
    			if($valor >= 60 && $valor <68){
    				return 'A';
    			}
    			if($valor >=68){
    				return 'S';
    			}
    			break;
    		case 4:
    			if($valor >= 0 && $valor <60){
    				return 'Z';
    			}
    			if($valor >=60  && $valor <80){
    				return 'B';
    			}
    			if($valor >= 80 && $valor <90){
    				return 'A';
    			}
    			if($valor >=90){
    				return 'S';
    			}
    			break;
    		case 5:
    			if($valor >= 0 && $valor <60){
    				return 'BAJO';
    			}
    			if($valor >=60  && $valor <80){
    				return 'BÁSICO';
    			}
    			if($valor >= 80 && $valor <90){
    				return 'ALTO';
    			}
    			if($valor >=90){
    				return 'SUPERIOR';
    			}
    			break;
            case 6:
                if($valor == 'MS'){
                    return 'MUY SATISFACTORIO';
                }
                if($valor == 'S'){
                    return 'SATISFACTORIO';
                }
                if($valor == 'A'){
                    return 'ACEPTABLE';
                }
                if($valor == 'NS'){
                    return 'NO SATISFACTORIO';
                }
                break;
            case 7:
                if($valor == 'Z'){
                    return 'BAJO';
                }
                if($valor == 'B'){
                    return 'BÁSICO';
                }
                if($valor == 'A'){
                    return 'ALTO';
                }
                if($valor == 'S'){
                    return 'SUPERIOR';
                }
                
            break;
    		default:
    			# code...
    			break;
    	}
    }
?>