@extends ('layouts.admin')
@section ('contenido')


<div class="form-group">
			
	</div>	
    <div class="panel panel-primary"></div>

    <form action="{{ route('propuesta.update', $propuestas->id) }}" method ="POST">
        @csrf
        {{ method_field('PUT') }}
	<div class="fom-group">	
	
		<div class="fom-group">	
			<h3 style="text-align:center; font-weight: bold;">Actividades</h3>	
			 <h4><label >Dimensión:</label>{{$propuestas->detalle_plan_mejora->dimension->descri_dimension}}</h4>
			<h4><label >Actividad Propuesta:</label>{{$propuestas->detalle_plan_mejora->recomendacion_mejora}}</h4>
					 <select style="display:none" name="detalle_plan_mejora_id" id="detalle_plan_mejora_id" value="{{old('detalle_plan_mejora_id', $propuestas->detalle_plan_mejora_id)}}" class="form-control" readonly>
					  <option type="hidden" value="{{$propuestas->detalle_plan_mejora_id}}">{{$propuestas->detalle_plan_mejora->recomendacion_mejora}}</option>	
					</select> 


         </div>
			<div class="panel panel-primary"></div>
	</div>	
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="font-weight">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
			       <label for="descri_actividades" style="color: black">Descripción de Actividad:</label>
            	   <textarea style=" width: 100%; resize: none;"  type="text" name="descri_actividades" id="descri_actividades" class="form-control">{{$propuestas->descri_actividades}}</textarea>
				   <div id="descri_actividades-error" class="error text-danger pl-3" for="descri_actividades" style="display: block;">
					   <strong>{{ $errors->first('descri_actividades') }}</strong>
				    </div>
				</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
				   <label for="medio_verificacion" style="color: black">Medio de Verificación:</label>
				   <textarea  style=" width: 100%; resize: none;" type="text" name="medio_verificacion" id="medio_verificacion" class="form-control">{{$propuestas->medio_verificacion}}</textarea>
				   <div id="medio_verificacion-error" class="error text-danger pl-3" for="medio_verificacion" style="display: block;">
					<strong>{{ $errors->first('medio_verificacion') }}</strong>
				 </div>	
				</div>	
			 </div>

			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				        <label for="plazo" style="color: black">Plazo:</label>
				        <input type="text" name="plazo" id="plazo" class="form-control" value="{{$propuestas->plazo}}">
						<div id="plazo-error" class="error text-danger pl-3" for="plazo" style="display: block;">
					     <strong>{{ $errors->first('plazo') }}</strong>
				    </div>
				    </div>	
			    </div>
 
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">            
				        <label for="responsable_id" style="color: black">Responsable:</label>
				        <select name="responsable_id"  value="{{old('responsable_id', $propuestas->responsable_id)}}" class="form-control selectpicker" id="responsable_id" data-live-search="true">
							<option value="{{$propuestas->responsable_id}}">{{$propuestas->responsables->descri_responsable}}</option>
							@foreach($responsable as $re)
					            <option value="{{$re->id}}">{{$re->descri_responsable}}</option>
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
				        <input type="text" name="fuente_financiamiento" id="fuente_financiamiento" class="form-control" value="{{$propuestas->fuente_financiamiento}}">
						<div id="fuente_financiamiento-error" class="error text-danger pl-3" for="fuente_financiamiento" style="display: block;">
					         <strong>{{ $errors->first('fuente_financiamiento') }}</strong>
				        </div>	
					</div>	
			    </div>
   
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				        <label for="inversion_prevista" style="color: black">Inversión Prevista:</label>
				        <input type="text" name="inversion_prevista" id="inversion_prevista" class="form-control" value="{{$propuestas->inversion_prevista}}">
						<div id="inversion_prevista-error" class="error text-danger pl-3" for="inversion_prevista" style="display: block;">
					        <strong>{{ $errors->first('inversion_prevista') }}</strong>
				        </div>	
					</div>	
			    </div> 

			</div>
		</div>

	</div>
		    <div class="row">
			        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
            	            <button class="btn btn-primary" type="submit"  data-dismiss="success" role="alert">Actualizar</button>
            	            <button class="btn btn-danger" type="reset" data-dismiss="modal" role="alert">Cancelar</button>
                        </div>
				</div>
			</div>

            		        <div class="modal-footer">							
							<a href="javascript:history.back()"> Volver Atrás</a>
				            <a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>

						</div>
			
</form>
				 {{-- {{Form::close()}} --}}



			
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

	  </script>
	@endpush
    
		
		 @endsection