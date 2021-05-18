@extends('layouts.app')
@section('content')

<div class="container w-50">
            <div class="card">
              <div class="card-header align-center text-center">
                <div class="row">
                      <div class="col-md-3 text-left">
                        <button type="submit" class="btn btn-primary " onclick="location.href='{{ route('ListarEmpleado') }}'"> Regresar</button>
                      </div>
                      <div class="col-md-6">
                        <h3>{{ __('Editar Empleado') }}</h3>
                      </div>
                      <div class="col-md-3">
                      </div>
                </div>
              </div>
              <div class="card-body  ">
                <form method="POST" action="{{ route('EditorEmpleado',['uuid'=>$empleado_datos->where('uuid',$empleado_datos->uuid)->pluck('uuid')->first() ]) }}">
                  @csrf
                    <div class="accordion" id="acd_opciones_edicion">
                        <div class="card">
                          <div class="card-header" id="datos_obligatorios">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#acd_elm_obligatorios" aria-expanded="true" aria-controls="acd_elm_obligatorios">Datos Obligatorios</button>
                            </h2>
                          </div>

                          <div id="acd_elm_obligatorios" class="collapse show" aria-labelledby="datos_obligatorios" data-parent="#acd_opciones_edicion">
                            <div class="card-body">
                              <div class="form-row">
                                <label for="ipt_primer_nombre" class="p-3 col-md-4 col-form-label ">{{ __('Primer Nombre') }} <span class="text-red">*</span></label>
                                <div class="p-1 col-md-6">
                                    <input id="ipt_primer_nombre" type="text" class="form-control " name="primer_nombre" value="{{ $empleado_datos->primer_nombre}}"  >
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="ipt_segundo_nombre" class="p-3 col-md-4 col-form-label ">{{ __('Segundo Nombre') }} </label>
                                <div class="p-1 col-md-6">
                                    <input id="ipt_segundo_nombre" type="text" class="form-control " name="segundo_nombre" value="{{ $empleado_datos->segundo_nombre }}"  >
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="ipt_apellido_paterno" class="p-3 col-md-4 col-form-label ">{{ __('Apellido Paterno') }} <span class="text-red">*</span></label>
                                <div class="p-1 col-md-6">
                                    <input id="ipt_apellido_paterno" type="text" class="form-control " name="apellido_paterno" value="{{ $empleado_datos->apellido_paterno }}"  >
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="ipt_apellido_materno" class="p-3 col-md-4 col-form-label ">{{ __('Apellido Materno') }}</label>
                                <div class="p-2 col-md-6">
                                    <input id="ipt_apellido_materno" type="text" class="form-control " name="apellido_materno" value="{{ $empleado_datos->apellido_materno }}"  >
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="name" class="col-md-4 col-form-label text-md-center">Curp<span class="text-red">*</span></label>
                                <div class="p-2 col-md-6p-2 col-md-6">
                                    <input class="form-control" type="name"  id="ipt_curp" name="curp" value="{{ $empleado_datos->curp }}">
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="name" class="col-md-4 col-form-label text-md-center">RFC<span class="text-red">*</span></label>
                                <div class="p-2 col-md-6p-2 col-md-6">
                                    <input class="form-control" type="name"  id="ipt_rfc" name="rfc" value="{{ $empleado_datos->rfc }}">
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="name" class="col-md-4 col-form-label text-md-center">No. Seguro Social<span class="text-red">*</span></label>
                                <div class="p-2 col-md-6p-2 col-md-6">
                                    <input class="form-control" type="name"  id="ipt_numero_seguro_social" name="numero_seguro_social" value="{{ $empleado_datos->n_seguro_social }}">
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="name" class="col-md-4 col-form-label text-md-center">Correo Empresa<span class="text-red">*</span> </label>
                                <div class="p-2 col-md-6">
                                    <input id="ipt_correo_empresa" type="text" class="form-control " name="correo_empresa" value="{{ $empleado_datos->correo_EEmp->email_empresa }}"  autofocus>
                                </div>
                              </div>
                              <div class="form-row">
                                <label for="name" class="col-md-4 col-form-label text-md-center">Correo Personal<span class="text-red">*</span></label>
                                <div class="p-2 col-md-6">
                                    <input id="ipt_correo_personal" type="text" class="form-control " name="correo_personal" value="{{ $empleado_datos->correo_EEmp->email_personal }}"  autofocus>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="datos_generales">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#acd_elm_generales" aria-expanded="false" aria-controls="acd_elm_generales">Datos Generales</button>
                              </h2>
                            </div>
                            <div id="acd_elm_generales" class="collapse" aria-labelledby="datos_generales" data-parent="#acd_opciones_edicion">
                              <div class="card-body">
                                <div class="form-row">
                                  <label for="name" class="p-3 col-md-4 col-form-label text-md-center">Estado civil</label>
                                  <div  class="p-2 col-md-6 text-md-center">
                                  <select id="sel_estado_civil" class="form-select form-control"  name="estado_civil" value="{{ $empleado_datos->estado_civil }}">
                                        <option selected>{{$empleado_datos->estado_civil }} </option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Viudo">Viudo</option>
                                        <option value="Union Libre">Union Libre</option>
                                  </select>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Hijos</label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_hijos" type="text" class="form-control " name="hijos" value="{{ $empleado_datos->hijos }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="p-3 col-md-4 col-form-label text-md-center">Genero </label>
                                  <div  class="p-2 col-md-6 text-md-center">
                                    <select class="form-select form-control" aria-label="Default select example" name="genero" value="{{ $empleado_datos->genero }}">
                                          @if($empleado_datos->genero=="M")
                                            <option selected value="M">Masculino  </option>
                                          @else
                                            <option selected value="F">Femenino</option>
                                          @endif
                                          <option value="M">Masculino</option>
                                          <option value="F">Femenino</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Lugar de nacimiento</label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_lugar_nacimiento" type="name" class="form-control " name="lugar_nacimiento" value="{{ $empleado_datos->lugar_nacimiento }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Fecha de Nacmimiento</label>
                                  <div class="p-2 col-md-6">
                                      <input class="form-control text-md-center" type="date"  id="ipt_fecha_nacimiento" name="fecha_nacimiento" value="{{ $empleado_datos->fecha_nacimiento }}">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Edad</label>
                                  <div class="p-2 col-md-6">
                                      <input class="form-control" type="name"  id="ipt_edad" name ="edad" value="{{ $empleado_datos->edad }}">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="datos_domicilio">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#acd_elm_domicilio" aria-expanded="false" aria-controls="acd_elm_domicilio">Datos Domicilio</button>
                            </div>
                            <div id="acd_elm_domicilio" class="collapse" aria-labelledby="datos_domicilio" data-parent="#acd_opciones_edicion">
                              <div class="card-body">
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Direccion: </label><br>
                                  <div class="col-md-6">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Calle: </label>
                                  <div class="p-2 col-md-6p-2 col-md-6">
                                      <input id="ipt_calle" type="text" class="form-control " name="calle" value="{{ $empleado_datos->calle }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">No. Exterior: </label>
                                  <div class="p-2 col-md-6p-2 col-md-6">
                                      <input id="ipt_num_exterior" type="text" class="form-control " name="num_exterior" value="{{ $empleado_datos->numero_exterior }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">No. Interior: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_num_interior" type="text" class="form-control " name="num_interior" value="{{ $empleado_datos->numero_interior }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Colonia: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_colonia" type="text" class="form-control " name="colonia" value="{{ $empleado_datos->colonia }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-centercol-md-4 col-form-label text-md-center">Mz: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_manzana" type="text" class="form-control " name="manzana" value="{{ $empleado_datos->manzana }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Lt: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_lote" type="text" class="form-control " name="lote" value="{{ $empleado_datos->lote }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Estado: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_estado" type="text" class="form-control " name="estado" value="{{ $empleado_datos->estado }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Municipio: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_municipio" type="text" class="form-control " name="municipio" value="{{ $empleado_datos->municipio }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Pais </label>
                                  <div class="p-2 col-md-6p-2 col-md-6">
                                      <input id="ipt_pais" type="text" class="form-control " name="pais" value="{{ $empleado_datos->pais }}"  autofocus>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <label for="name" class="col-md-4 col-form-label text-md-center">Codigo Postal: </label>
                                  <div class="p-2 col-md-6">
                                      <input id="ipt_codigo_postal" type="text" class="form-control " name="codigo_postal" value="{{ $empleado_datos->codigo_postal }}"  autofocus>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-3 ">
                            </div>
                            <div class="p-3 col-md-4 text-right">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Registrar') }}
                              </button>
                            </div>
                            <div class="p-4 col-md-5 ">
                              <span class="text-red">*</span><h7>Estos datos son obligatorios</h7>
                            </div>
                        </div>
                    </form>
              </div>
            </div>
        </div>
@endsection
