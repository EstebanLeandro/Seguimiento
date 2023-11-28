@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		            
        </div>
	</div>

	
	<form action="{{ route('realizada.store') }}" method ="POST">
		@csrf
			<div class="fom-group">	
				<h3 style="text-align:center; font-weight: bold;">Actividades</h3>	
				 <h4><label >Dimensión:</label>{{$propuestas->detalle_plan_mejora->dimension->descri_dimension}}</h4>
				<h4><label >Actividad Propuesta:</label>{{$propuestas->detalle_plan_mejora->recomendacion_mejora}}</h4>
						{{-- <select style="display:none"   name="detalle_plan_mejora_id" id="detalle_plan_mejora_id" value="{{old('detalle_plan_mejora_id', $detalle->id)}}" class="form-control" readonly>
						  <option type="hidden" value="{{$detalle->id}}">{{$detalle->recomendacion_mejora}}</option>	
						</select> --}}
					</div> 
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
				        <h4><label>Actividad Propuesta:</label>{{$propuestas->descri_actividades}}</h4>	
						<select name="actividades_propuesta_id" style="display:none" id="actividades_propuesta_id" value="{{old('actividades_propuesta_id', $propuestas->id)}}" class="form-control" readonly>
							<option type="hidden" value="{{$propuestas->id}}">{{$propuestas->id}}</option>	
						  </select>
						  
				        	 
				    </div>
		        </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
			          <h4><label >Medio de verificación:</label>{{$propuestas->medio_verificacion}}</h4>
			        </div>
		        </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
	      			     <h4><label >Plazo:</label>{{$propuestas->plazo}}</h4>
				    </div>
			    </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
	      			    <h4><label >Responsable:</label>{{$propuestas->responsables->descri_responsable}}</h4>
				    </div>
			    </div> 

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
	      			   <h4><label >Fuente de Financiamiento:</label>{{$propuestas->fuente_financiamiento}}</h4>
				    </div>
			    </div> 

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
	      		       <h4><label >Inversión Prevista:</label>{{$propuestas->inversion_prevista}}</h4>
				    </div>
			    </div> 

		</div>
	</div>
</div>
					<h3 style="text-align:center; font-weight: bold;">Agregar actividad Realizada</h3>				

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
								<label for="descri_realizadas">Actividad Realizada:</label>
								<textarea  style=" width: 100%; resize: none;" type="text" name="descri_realizadas" class="form-control" placeholder="Actividad realizada...">{{old('descri_realizadas')}}</textarea>
						        <div id="descri_realizadas-error" class="error text-danger pl-3" for="descri_realizadas" style="display: block;">
						           <strong>{{ $errors->first('descri_realizadas') }}</strong>
					            </div>	
							</div>	
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								  <label for="plazo">Plazo:</label>
								    <input type="text" name="plazo" class="form-control" placeholder="Plazo..." value="{{old('plazo')}}">
						        <div id="plazo-error" class="error text-danger pl-3" for="plazo" style="display: block;">
						           <strong>{{ $errors->first('plazo') }}</strong>
					            </div>	
							</div>

						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">            
							  <label for="responsable_id">Responsable:</label>
							  <select name="responsable_id" class="form-control selectpicker" id="responsable_id" data-live-search="true">
							  <option value="">Selecciona un responsable</option>			
							  @foreach($responsables as $re)
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

			            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			     	        <div class="form-group">
				                 <label for="cumplimiento">Cumplimiento:</label>
				                 <input type="text" name="cumplimiento" class="form-control" placeholder="Cumplimiento..." value="{{old('cumplimiento')}}">
			     	             <div id="cumplimiento-error" class="error text-danger pl-3" for="cumplimiento" style="display: block;">
						           <strong>{{ $errors->first('cumplimiento') }}</strong>
					             </div>	
							</div>	
			             </div>
						

						 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				            <div class="form-group">
				                <label for="resultados">Resultado:</label>
				                <input type="text" name="resultados" class="form-control" placeholder="Resultado..." value="{{old('resultados')}}">
				                <div id="resultados-error" class="error text-danger pl-3" for="resultados" style="display: block;">
						           <strong>{{ $errors->first('resultados') }}</strong>
					            </div>
							</div>
			            </div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				            <div class="form-group">
				                 <label for="avance">Avance %:</label>
				                 <input type="text" name="avance" class="form-control" placeholder="Avance..." value="{{old('avance')}}">
				                 <div id="avance-error" class="error text-danger pl-3" for="avance" style="display: block;">
						           <strong>{{ $errors->first('avance') }}</strong>
					            </div>	
							</div>	
			            </div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				            <div class="form-group">
				                <label for="pendientes">Pendiente:</label>
				                <input type="text" name="pendientes" class="form-control" placeholder="Pendiente..." value="{{old('pendientes')}}">
			            	    <div id="pendientes-error" class="error text-danger pl-3" for="pendientes" style="display: block;">
						           <strong>{{ $errors->first('pendientes') }}</strong>
					            </div>	
							</div>
							
			            </div>

						
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

							<div class="form-group"> 

							  <label for="descri_verificacion">Medios de verificación:</label>
							  <select name="descri_verificacion"  class="form-control selectpicker" id="descri_verificacion" data-live-search="true">
								<option value="">Selecciona un medio de verificación</option>		
								@foreach($medio_verificacion as $med)
								  {{-- <option value="{{$med -> id}}">{{$med->descri_medension}}</option> --}}
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

	
		                        {{-- <a class="btn btn-warning" href="{{ route('realizada.archivo') }}" id="addModal" data-toggle="medio_verificacion"><i class='fa fa-folder-open'>Nuevo</i></a>					 --}}

							</div>
					    </div> 



					         <div class="col-xs-12 ">
								
						        <div class="table-responsive">
							        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								        <thead style="background-color: #A9D0F5">
									        <th>Medios de verificación</th>
											<th>Opciones</th>
								        </thead>
								        <tfoot>
									        <th></th>
											<th></th>

								        </tfoot>
								        <tbody >
									
								        </tbody>
							        </table>
									
						        </div>
					        </div> 
							
							
									
					
        </div>
	</div>	
</div>
	
		
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

	   <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
	   <button class="btn btn-primary" type="submit"  data-dismiss="success" role="alert">Guardar</button>
	   <button class="btn btn-danger" type="reset"  data-dismiss="modal" role="alert">Cancelar</button>

    </div>  
</div>     
</form>

<div class="modal-footer">
	<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
	<i class='fa fa-folder-open'>Crear Medio de Verificacion</i>								
    </button>
</div>						   <!--modal-crear -->
				
				<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 <span aria-hidden="true close-btn">×</span>
							</button>
						</div>
							<div class="modal-body">
							
							<form method="POST" action="{{ route('archivo.store') }}" enctype="multipart/form-data"> 			
							@csrf                
							
							<div class="modal-body">
							<div class="form-group">
							<div class="col-xm-6">
							<label for="descri_verificacion">Medio de verificación:</label>
							<textarea  style=" width: 100%; resize: none;" type="text" name="descri_verificacion" id="descri_verificacion" class="form-control" placeholder="Medio de verificación...">{{old('descri_verificacion')}}</textarea>
							<div id="descri_verificacion-error" class="error text-danger pl-3" for="descri_verificacion" style="display: block;">
							<strong>{{ $errors->first('descri_verificacion') }}</strong>
							</div>               
							</div>
							</div> 
							
							<div class="form-group">
							<div class="col-xm-6">
							<label class=" control-label">Nuevo Archivo</label>
							<div >
							<input type="file" class="form-control" name="url" id="url">
							
							<div id="url-error" class="error text-danger pl-3" for="url" style="display: block;">
							<strong>{{ $errors->first('url') }}</strong>
							</div> 
							</div>
							</div>
							</div> 
							
							
							
							</form>									
							<div class="modal-footer">
							<button type="submit" class="btn btn-success">Guardar</button>							
							<button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Cerrar</button>
							</div> 
					</div>  
				</div>
			</div>
		</div>
	</div>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
						<h3 style="text-align: center; font-weight: bold">Actividades implementada</h3>
				<div class="table-responsive">
				   <table class="table table-striped mt-2">
						<thead style="background-color:#6777ef">
							<tr >
								<th style="color:#fff;">Sugerencias de mejora </th>
								<th style="color:#fff;">Mejoras implementadas</th>
								<th style="color:#fff;">Medios de verificación</th> 
								<th style="color:#fff;">Metas / plazos</th>
								<th style="color:#fff;">Responsables</th>
								<th style="color:#fff;">Cumplimiento Total - Parcial</th>
								<th style="color:#fff;">Resultados</th>
								<th style="color:#fff;">Avances %</th>
								<th style="color:#fff;">Pendientes</th>
								<th style="color:#fff;">Opciones</th>
							</tr>
						</thead>
						<tbody>
						  
							 @foreach ($realizadas as $rea)
							<tr>
								<td>{{ $rea->descri_actividades}}</td>
								<td>{{ $rea->descri_realizadas}}</td>								
								<td>{{ $rea->verificacion}}</td> 
								<td>{{ $rea->plazo}}</td>
								<td>{{ $rea->descri_responsable}}</td>
								<td>{{ $rea->cumplimiento}}</td>
								<td>{{ $rea->resultados}}</td>
								<td>{{ $rea->avance}}</td>
								<td>{{ $rea->pendientes}}</td>

								<td>							
									{{-- <a href="{{ route('realizada.agregar', $rea->id)}}" class="btn btn-success btn-xs" title="Ver propuesta"><i class="fa fa-arrow-circle-right "></i></a> --}}
									<a href="{{ route('realizada.editar', $rea->id) }}" class="btn btn-info btn-xs" title="Editar"><i class="fa fa-edit "></i></a>
									{{-- <a href="{{ route('realizada.eliminar', $rea->id)}}" class="btn btn-info btn-xs"  onclick="return confirm('¿Esta seguro de eliminar este registro?')" data-toggle="tooltip" data-placement="right" style="background-color: red" title="Eliminar"><i class="fa fa-trash"></i></a>  								  --}}
									<form action="{{ route('realizada.eliminar', $rea->id)}}"   id="del_type"  style="display: inline">
										{!! method_field('delete') !!}
										{{ csrf_field() }}
									
										   <button type="submit" class="btn btn-danger btn-xs btnEliminar" data-id="{{$rea->id}}"><i class="fa fa-trash" title="Eliminar" data-target="#modalEliminar" data-toggle="modal"></i></button>
									   </form>	 
			
									</form>	
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{!! $realizadas->links() !!}
				</div>			 
					 
	 </div>
</div>
			        
					<div class="modal-footer">
						<a href="javascript:history.back()"> Volver Atrás</a>
						<a href="\transaccion\realizada" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					</div>
				
				

	   <!--modal-eliminar -->
	
	   <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modalEliminar" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog">
			<div class="modal-content" role="document">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" 
					aria-label="Close">
						 <span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="exampleModalLabel">Anular plan de mejora</h4>
				</div>
				<div class="modal-body">
					<p>¿Desea anular plan de mejora realizada?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-danger btnModalEliminar">Eliminar</button>
				</div>
			</div>
		</div>

			

 
    




				

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
		$(".btnEliminar").click( function (e) {
			e.preventDefault();
		
			var idEliminar=0;
			 $(document).ready(function(){
				 @if($message = Session::get('ErrorInsert'))
					$("#modalAgregar").modal('show');						
				 @endif
				 $(".btnEliminar").click(function (){
				   idEliminar = $(this).data('id')				
				 });
				 $(".btnModalEliminar").click(function (){
					$('#del_type').submit();
				 });
		
				});
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

 {{-- <script type="text/javascript">
$("#addModal").submit(function(e){
        e.preventDefault();

        let nombVeri = $("#descri_verificacion").val();
        let urlArchi = $("#url").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('archivo.store')}}",
            type: "POST",
            data:{
                nombVeri:nombVeri,
                urlArchi:urlArchi,
                _token:_token
            },
            success:function(response)
            {
                if(response){
                    console.log("hola");
                }else{
                    console.log("hola2");
                }
            }
         });
    });
	</script> --}}
	
	<script type="text/javascript">
	$('#myModal1').on('shown.bs.modal', function () {
		$('#myInput').trigger('focus')
	  })
	</script>

	@endpush
@endsection

