@extends('layouts.app')

@section('title','Consulta Registros Estudiante')

@section('contenido')
    @if (!isset($identificacion))
    <br>
    <center>
    <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 22px 32px 22px 32px; border: 1px solid #EEE; width: 40%">
        <h5 class="blue-text text-darken-4">Datos de Estudiante</h5><br>
        {{ Form::open(['action' => 'BienestarController@buscar_registros_consulta', 'method' => 'PUT']) }}
            {{csrf_field()}}
            <div class="row">
                @if (isset($flash))
                    <div class="card-panel notifications {{ $flash['color'] }}">
                    <span class="white-text">{{ $flash['text'] }}</span>
                    </div>
                    <br>
                @endif
                 @if ($errors->any())
                    <div class="help-block red-text">         
                    @foreach ($errors->all() as $error)
                            <strong>{{ $error }}<br></strong>
                    @endforeach
                    </div>
                @endif
                <div class="col s6">
                    <h6 class="blue-text text-darken-4">identificacion</h6>
                    <input type="number" name="identificacion" id="identificacion" required="required">
                </div>
                <div class="col s6">
                    <h6 class="blue-text text-darken-4">año</h6>
                    <input type="number" name="ano" id="ano" required="required">
                </div>
            </div>
            <div class="row">
                <button class="btn center waves-effect waves-light blue darken-4" type="submit" name="action">Consultar</button>    
            </div>
        {{ Form::close()}}
    </div>
    </center>
    @else
    @php
        $cant_au=0;
        $cant_vi=0;
        $cant_acta=0;
        $cant_conf=0;
        $cant_cit=0;
        $cant_sesion=0;
        $cant_entre=0;
        foreach ($registros as $key){
            if($key->tiporeg =='AUSENCIA'){
                $cant_au=$cant_au+1;
            }
            if($key->tiporeg =='DOMICILIARIO'){
                $cant_vi=$cant_vi+1;
            }
            if($key->tiporeg =='ACADEMICO' || $key->tiporeg =='DISCIPLINARIO' || $key->tiporeg =='PSICOLOGO'){
                $cant_acta=$cant_acta+1;
            }
            if($key->tiporeg =='CONFLICTO'){
                $cant_conf=$cant_conf+1;
            }
            if($key->tiporeg =='CITACION'){
                $cant_cit=$cant_cit+1;
            }
            if($key->tiporeg =='SESION'){
                $cant_sesion=$cant_sesion+1;
            }
            if($key->tiporeg =='ENTREVISTA'){
                $cant_entre=$cant_entre+1;
            }
        }
    @endphp
    <div class="row">
        <div class="col s6">
            <div class="card horizontal hoverable">
                <div class="card-stacked">
                    <div class="card-content">
                        <h6><b>DATOS DE CONSULTA:</b></h6>
                        <h6><b>Documento: </b>{!! $identificacion !!}</h6>
                        <h6><b>Año: </b>{!! $ano !!}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      <ul class="collapsible">
        <li>
          <div class="collapsible-header"><i class="material-icons">content_paste</i>Ausencias</div>
          <div class="collapsible-body">
            @if ($cant_au == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>MOTIVO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='AUSENCIA')
                            <tr>
                                <td>{!! $key->ano !!}</td>
                                <td>{!! $key->curso !!} </td>
                                <td>{!! $key->periodo !!}</td>
                                <td>{!! $key->fecha !!}</td>
                                <td>{!! $key->motivo !!}</td>
                                <td>
                                    <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' => 1, 'tiporeg' => $key->tiporeg] ) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Ausencia"><i class="small material-icons">visibility</i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">directions_car</i>Visitas Domiciliarias</div>
          <div class="collapsible-body">
            @if ($cant_vi == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>ATENDIO</th>
                        <th>MOTIVO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='DOMICILIARIO')
                        <tr>
                            <td>{!! $key->ano !!}</td>
                            <td>{!! $key->curso !!} </td>
                            <td>{!! $key->periodo !!}</td>
                            <td>{!! $key->fecha !!}</td>
                            <td>{!! $key->acudiente !!}</td>
                            <td>{!! $key->motivo !!}</td>
                            <td>
                                <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' =>2, 'tiporeg' => $key->tiporeg]) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Visita"><i class="small material-icons">visibility</i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">check</i>Actas Compromiso</div>
          <div class="collapsible-body">
            @if ($cant_acta == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>CORRECTIVO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='ACADEMICO' || $key->tiporeg =='DISCIPLINARIO' || $key->tiporeg =='PSICOLOGO')
                        <tr>
                            <td>{!! $key->ano !!}</td>
                            <td>{!! $key->curso !!} </td>
                            <td>{!! $key->periodo !!}</td>
                            <td>{!! $key->fecha !!}</td>
                            <td>{!! $key->tiporeg !!}</td>
                            <td>
                                <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' =>3, 'tiporeg' => $key->tiporeg ] ) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Acta"><i class="small material-icons">visibility</i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">group</i>Mediación Conflictos</div>
          <div class="collapsible-body">
            @if ($cant_conf == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>CORRECTIVO</th>
                        <th>DOCENTE</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='CONFLICTO')
                        <tr>
                            <td>{!! $key->ano !!}</td>
                            <td>{!! $key->curso !!} </td>
                            <td>{!! $key->periodo !!}</td>
                            <td>{!! $key->fecha !!}</td>
                            <td>{!! $key->tiporeg !!}</td>
                            <td>{!! $key->docente !!}</td>
                            <td>
                                <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' =>4, 'tiporeg' => $key->tiporeg ] ) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Acta"><i class="small material-icons">visibility</i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">event</i>Citaciones</div>
          <div class="collapsible-body">
            @if ($cant_cit == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>CITACION</th>
                        <th>CORRECTIVO</th>
                        <th>MOTIVO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='CITACION')
                        <tr>
                            <td>{!! $key->ano !!}</td>
                            <td>{!! $key->curso !!} </td>
                            <td>{!! $key->periodo !!}</td>
                            <td>{!! $key->fecha !!}</td>
                            <td>{!! $key->tipocit !!}</td>
                            <td>{!! $key->correctivo !!}</td>
                            <td>{!! $key->motivo !!}</td>
                            <td>
                                <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' =>5, 'tiporeg' => $key->tiporeg ] ) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Citación"><i class="small material-icons">visibility</i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">airline_seat_recline_normal</i>Sesiones Bienestar</div>
          <div class="collapsible-body">
            @if ($cant_sesion == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>MOTIVO</th>
                        <th>PSICOLOGA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='SESION')
                        <tr>
                            <td>{!! $key->ano !!}</td>
                            <td>{!! $key->curso !!} </td>
                            <td>{!! $key->periodo !!}</td>
                            <td>{!! $key->fecha !!}</td>
                            <td>{!! $key->motivo !!}</td>
                            <td>{!! $key->docente !!}</td>
                            <td>
                                <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' =>6, 'tiporeg' => $key->tiporeg ] ) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Sesion"><i class="small material-icons">visibility</i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">assignment</i>Entrevistas</div>
          <div class="collapsible-body">
            @if ($cant_entre == 0)
                <h6>No hay datos para mostrar</h6>
            @else
            <table id="tabla_datos" class="striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>AÑO</th>
                        <th>CURSO</th>
                        <th>PERIODO</th>
                        <th>FECHA</th>
                        <th>MOTIVO</th>
                        <th>PSICOLOGA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $key)
                        @if($key->tiporeg =='ENTREVISTA')
                        <tr>
                            <td>{!! $key->ano !!}</td>
                            <td>{!! $key->curso !!} </td>
                            <td>{!! $key->periodo !!}</td>
                            <td>{!! $key->fecha !!}</td>
                            <td>{!! $key->motivo !!}</td>
                            <td>{!! $key->docente !!}</td>
                            <td>
                                <a class="tooltipped" target="_blank" href="{{ action('BienestarController@view_registros_consulta', ['documento' => $identificacion, 'fecha' => $key->fecha, 'ano' => $key->ano, 'opcion' =>7, 'tiporeg' => $key->tiporeg ] ) }}" data-position="bottom" data-delay="50" data-tooltip="Ver Entrevista"><i class="small material-icons">visibility</i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif
          </div>
        </li>
      </ul>
    @endif
    <div class="fixed-action-btn">
        <a href="{{ route('bienestar.ver_registros') }}" class="btn-floating btn-large blue darken-4">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>
@endsection
