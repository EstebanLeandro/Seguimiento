@extends ('layouts.admin')
@section ('contenido')


<div class="form-group">
			
	</div>	
	

    <form action="{{ route('realizada.update', $realizada->id) }}" method ="POST">
        @csrf
        {{ method_field('PUT') }}
	 <div class="fom-group">	
				  <h3 style="text-align:center; font-weight: bold;">Editar actividad realizada:</h3>				
				    {{-- <h4><label >Dimensión:</label>{{$propuesta->detalle_plan_mejora->dimension->descri_dimension}}</h4>  --}}
				  <h4><label >Actividad Propuesta:</label>{{$realizada->descri_actividades}}</h4>           
								<select style="display:none"  id="actividades_propuesta_id"   name="actividades_propuesta_id" value="{{old($realizada->actividades_propuesta_id)}}" readonly>
									<option type="hidden" value="{{$realizada->actividades_propuesta_id}}"></option>	
								</select> 
			<div class="panel panel-primary"></div>
	</div> 
	 
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="font-weight">

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
			       <label for="descri_actividades" style="color: black">Descripción de Actividad:</label>
            	   <textarea style=" width: 100%"  type="text" name="descri_realizadas" id="descri_realizadas" class="form-control">{{$realizada->descri_realizadas}}</textarea>
				   <div id="descri_realizadas-error" class="error text-danger pl-3" for="descri_realizadas" style="display: block;">
						<strong>{{ $errors->first('descri_realizadas') }}</strong>
					</div>
				</div>
			</div>
			
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				        <label for="plazo" style="color: black">Plazo:</label>
						<textarea  style=" width: 100%; resize: none;" type="text" name="plazo" id="plazo"  class="form-control">{{$realizada->plazo}}</textarea>
						<div id="plazo-error" class="error text-danger pl-3" for="plazo" style="display: block;">
						    <strong>{{ $errors->first('plazo') }}</strong>
					    </div>	
					</div>	
			    </div>
 
			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">            
				        <label for="responsable_id" style="color: black">Responsable:</label>
				        <select name="responsable_id"  value="{{old('responsable_id', $realizada->responsable_id)}}" class="form-control selectpicker" id="responsable_id" data-live-search="true">
							<option value="{{$realizada->responsable_id}}">{{$realizada->descri_responsable}}</option>
							@foreach($responsable as $re)
					            <option value="{{$re->id}}">{{$re->descri_responsable}}</option>
					        @endforeach
				        </select>
						<div id="responsable_id-error" class="error text-danger pl-3" for="responsable_id" style="display: block;">
						    <strong>{{ $errors->first('responsable_id') }}</strong>
					    </div>
			         </div>
			    </div>  
			 
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="cumplimiento">Cumplimiento:</label>
						<textarea  style=" width: 100%; resize: none;" type="text" name="cumplimiento" id="cumplimiento"  class="form-control">{{$realizada->cumplimiento}}</textarea>
				        <div id="cumplimiento-error" class="error text-danger pl-3" for="cumplimiento" style="display: block;">
						    <strong>{{ $errors->first('cumplimiento') }}</strong>
					    </div>	
					</div>	
				</div>
			   

			   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group">
					   <label for="resultados">Resultado:</label>
						<textarea  style=" width: 100%; resize: none;" type="text" name="resultados" id="resultados"  class="form-control">{{$realizada->resultados}}</textarea>
                        <div id="resultados-error" class="error text-danger pl-3" for="resultados" style="display: block;">
						    <strong>{{ $errors->first('resultados') }}</strong>
					    </div>
				  </div>	
			   </div>

			   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group">
						<label for="avance">Avance %:</label>
						<textarea  style=" width: 100%; resize: none;" type="text"  name="avance" id="avance" class="form-control">{{$realizada->avance}}</textarea>
						<div id="avance-error" class="error text-danger pl-3" for="avance" style="display: block;">
						    <strong>{{ $errors->first('avance') }}</strong>
					    </div>	
					</div>	
				</div>

			   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group">
					    <label for="pendientes">Pendiente:</label>
					    <textarea  style=" width: 100%; resize: none;" type="text" name="pendientes" id="pendientes"  class="form-control">{{$realizada->pendientes}}</textarea>
					    <div id="pendientes-error" class="error text-danger pl-3" for="pendientes" style="display: block;">
						    <strong>{{ $errors->first('pendientes') }}</strong>
					    </div>	
					</div>	
			   </div>
			   {{-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

				<div class="form-group"> 

				  <label for="descri_verificacion">Medios de verificación:</label>
				  <select name="descri_verificacion"  class="form-control selectpicker"  data-live-search="true">
					<option value="">Selecciona un medio de verificación</option>		
					@foreach($medio_verificacion as $med)
					  {{-- <option value="{{$med -> id}}">{{$med->descri_medension}}</option> 
					  @if(old('descri_verificacion') == $med->id)
					  <option value="{{$med->id}}" selected> {{ $med->descri_verificacion}}</option>
				  @else
				  <option value="{{$med -> id}}">{{$med->descri_verificacion}}</option>
				  @endif
					  @endforeach
				  </select>
					<div id="descri_verificacion-error" class="error text-danger pl-3" for="descri_verificacion" style="display: block;">
					   <strong>{{ $errors->first('descri_verificacion') }}</strong>
					 </div>
				</div>

			</div>

			 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="form-group">
				<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>


					{{-- <a class="btn btn-warning" href="{{ route('realizada.archivo') }}" id="addModal" data-toggle="medio_verificacion"><i class='fa fa-folder-open'>Nuevo</i></a>				

				</div>
			</div>  --}}



				 <div class="col-xs-12 ">
					
					<div class="table-responsive">
						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
							<thead style="background-color: #A9D0F5">
								<th>Medios de verificación</th>
								{{-- <th>Opciones</th> --}}
							</thead>
							<tfoot>
								<th></th>

							</tfoot>
							<tbody >
								@foreach ($detalles as $del)
								<tr>
									<td>{{ $del->verificacion}}</td>
								</tr>
								@endforeach
						
							</tbody>
						</table>
						
					</div>
				</div> 
				
				
						
		
</div>
</div>	
</div>


			</div>
		</div>

	</div>

		 
		    <div class="row">
			        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
            	            <button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Actualizar</button>
            	            <button class="btn btn-danger" type="reset" data-dismiss="modal" role="alert">Cancelar</button>
                        </div>
				</div>
			</div>

			<div class="modal-footer">
				<a href="javascript:history.back()"> Volver Atrás</a>
				<a href="\transaccion\realizada" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
			</div>
			

				 {{-- {{Form::close()}} --}}
</form>


			
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


<script type="text/javascript">
	$(document).ready(function(){
		$('#bt_add').click(function(){
			agregar();
		   
		});

	   });
	//variables
	
	   var cont2 = 0;
	   $('#cargar').hide();
	   function agregar(){
medio_id = $("#descri_verificacion").val();
medio = $("#descri_verificacion option:selected").text();

// if (medio_id != "" && url_id != "" )
if (medio_id != "") 
{
	var fila2 = '<tr id="fila2' +cont2+ '"><td><input type="hidden" name="descri_verificacion[]" value="' + medio_id + '">'+ medio +'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar2('+cont2+');">X</button><i class="fas fa-trash-alt"></i></button></td></tr>';
   cont2++;
  $('#detalles').append(fila2);
} else {
   alert('Error al ingresar el detalle del mejora, revise los datos');    

swal.fire({

   type:'error',
   text: 'daw'
})
}
		
}			
	function limpiar(){
		$('#medio_id').val('');
		
	}
	
	
function eliminar2(index){
total = cont2[index];
$('#total').html('s/. '+total);
$('#fila2' + index).remove();
} 


 </script> 
	@endpush
    
		
		 @endsection