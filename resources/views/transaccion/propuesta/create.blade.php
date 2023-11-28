@extends ('layouts.admin')
@section ('contenido')

@can('ver-plan-mejoras')      		 							
<div class="form-group">
			
	</div>	
	<form action="{{ route('propuesta.store') }}" method ="POST">
	@csrf
	<div class="fom-group">	
				   <h3 style="text-align:center; font-weight: bold;">Agregar nueva actividad</h3>				
				   <h4><label >Dimensión:</label>{{$detalle->dimension->descri_dimension}}</h4>
				   <h4><label >Actividad mejora:</label>{{$detalle->recomendacion_mejora}}</h4>
						   <select style="display:none" name="detalle_plan_mejora_id" id="detalle_plan_mejora_id" value="{{old('detalle_plan_mejora_id', $detalle->id)}}" class="form-control" readonly>
							 <option type="hidden" value="{{$detalle->id}}">{{$detalle->recomendacion_mejora}}</option>	
						   </select>
						   
			<div class="panel panel-primary"></div>
	</div>

@can('crear-plan-mejoras')      		 							
	
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="font-weight">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
			       <label for="descri_actividades" style="color: black">Descripción de Actividad:</label>
            	   <textarea style=" width: 100%; resize: none;"  type="text" name="descri_actividades" class="form-control" placeholder="Descripción de Actividad...">{{old('descri_actividades')}}</textarea>
				   <div id="descri_actividades-error" class="error text-danger pl-3" for="descri_actividades" style="display: block;">
					   <strong>{{ $errors->first('descri_actividades') }}</strong>
				    </div>
				</div>
				
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
				   <label for="medio_verificacion" style="color: black">Medio de Verificación:</label>
				   <textarea  style=" width: 100%; resize: none;" type="text" name="medio_verificacion" class="form-control" placeholder="Medio de Verificación...">{{old('medio_verificacion')}}</textarea>
				    <div id="medio_verificacion-error" class="error text-danger pl-3" for="medio_verificacion" style="display: block;">
					  <strong>{{ $errors->first('medio_verificacion') }}</strong>
				    </div>	
				</div>
				 
			 </div>

			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				        <label for="plazo" style="color: black">Plazo:</label>
				        <input type="text" name="plazo" class="form-control" placeholder="Plazo..." value="{{ old('plazo') }}">
						<div id="plazo-error" class="error text-danger pl-3" for="plazo" style="display: block;">
					       <strong>{{ $errors->first('plazo') }}</strong>
				        </div>	
				    </div>
					
			    </div>
 
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">            
				        <label for="responsable_id" style="color: black">Responsable:</label>
				        <select name="responsable_id" class="form-control selectpicker" id="responsable_id" data-live-search="true">
							<option value="">Selecciona un responsable</option>		
							@foreach($responsable as $re)
					            {{-- <option value="{{$re->id}}">{{$re->descri_responsable}}</option> --}}
								@if(old('responsable_id') == $re->id)
                                   <option value="{{$re->id}}" selected> {{ $re->descri_responsable}}</option>
                               @else
							   <option value="{{$re->id}}">{{$re->descri_responsable}}</option>
                               @endif
					        @endforeach
				        </select>
						<div id="responsable_id-error" class="error text-danger pl-3" for="responsable_id" style="display: block;">
					        <strong>{{ $errors->first('responsable_id') }}</strong>
				        </div>
			         </div>
					 
			    </div>  
			 
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				        <label for="fuente_financiamiento" style="color: black">Fuente de Financiamiento:</label>
				        <input type="text" name="fuente_financiamiento" class="form-control" placeholder="Fuente de Financiamiento..." value="{{ old('fuente_financiamiento') }}">
				        <div id="fuente_financiamiento-error" class="error text-danger pl-3" for="fuente_financiamiento" style="display: block;">
					        <strong>{{ $errors->first('fuente_financiamiento') }}</strong>
				        </div>	
					</div>
					
			    </div>
   
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				        <label for="inversion_prevista" style="color: black">Inversión Prevista:</label>
				        <input type="text" name="inversion_prevista" class="form-control" placeholder="Inversión Prevista..." value="{{ old('inversion_prevista') }}">
				        <div id="inversion_prevista-error" class="error text-danger pl-3" for="inversion_prevista" style="display: block;">
					        <strong>{{ $errors->first('inversion_prevista') }}</strong>
				        </div>	
					</div>
					
			    </div> 

			</div>
		</div>

	</div>
		    <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="guardar">
					<div class="form-group">
					     <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
						 <button class="btn btn-primary" type="submit"  data-dismiss="success" role="alert">Guardar</button>
						  <button class="btn btn-danger" type="reset"  data-dismiss="modal" role="alert">Cancelar</button>
				    </div>  
				</div>  

			</div>
@endcan		
</form>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3 style="text-align: center; font-weight: bold">Propuestas implementada</h3>
				
		<div class="table-responsive">
		<table class="table table-striped mt-2">
				<thead class="bg-info" style="background-color:#6777ef">
					<tr class="text-light">
						<th style="color:#fff;">Recomendaciones</th>
						<th style="color:#fff;">Actividades</th>
						<th style="color:#fff;">Medios de verificación</th>
						<th style="color:#fff;">Plazos</th>
						<th style="color:#fff;">Responsables</th>
						<th style="color:#fff;">Fuentes de Financiamientos</th>
						<th style="color:#fff;">Inversiones Previstas</th>
						<th style="color:#fff;">Opciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($propuesta as $pro)
					<tr>
						{{-- <th scope="row">{{$valor++}}</th> --}}
						<td>{{ $pro->recomendacion_mejora}}</td>
						<td>{{ $pro->descri_actividades}}</td>
						<td>{{ $pro->medio_verificacion}}</td>
						<td>{{ $pro->plazo}}</td>
						<td>{{ $pro->descri_responsable}}</td>
						<td>{{ $pro->fuente_financiamiento}}</td>
						<td>{{ $pro->inversion_prevista}}</td>
						<td>
							@can('editar-plan-mejoras')      		 														
							<a href="{{ route('propuesta.editar', $pro->id) }}" class="btn btn-info btn-xs" title="Editar"><i class="fa fa-edit "></i></a>
							@endcan
							@can('borrar-plan-mejoras')      		 							
							<a href="" data-target="#modal-delete-{{$pro->id}}" data-toggle="modal"><button class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Eliminar"></i></button></a>
                            @endcan
						</td>
					</tr>
					@include('transaccion.propuesta.modal')
					@endforeach
				</tbody>
			</table>
			<div class="pagination justify-content-end">
				{!! $propuesta->links() !!}
			  </div>    
		</div>
	</div>

		
				        <div class="modal-footer">
							<a href="javascript:history.back()"> Volver Atrás</a>
				            <a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
				        </div>
			
@endcan
			
				 @push('js')
	<script type="text/javascript">

	$("body").on("keydown", "input, select, textarea", function(e) {
		var self = $(this),
		  form = self.parents("form:eq(0)"),
		  focusable,
		  next;
		
		// si presiono el enter
		if (e.keyCode == 13) {
		  // busco el siguiente elemento
		  focusable = form.find("input,a,select,button,textarea").filter(":visible");
		  next = focusable.eq(focusable.index(this) + 1);
		  
		  // si existe siguiente elemento, hago foco
		  if (next.length) {
			next.focus();
		  } else {
			// si no existe otro elemento, hago submit
			// esto lo podrías quitar pero creo que puede
			// ser bastante útil
			form.submit();
		  }
		  return false;
		}
	  });

		


	  
	@endpush
    
		
		 @endsection