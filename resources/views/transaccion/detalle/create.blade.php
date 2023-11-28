@extends ('layouts.admin')
@section ('contenido')

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        </div>
	</div>
	<div class="panel panel-primary"></div>
	<form action="{{ route('detalle.store') }}" method ="POST">
        @csrf
 

            <div class="fom-group">	
                <h3 style="text-align:center; font-weight: bold;">Agregar nueva actividad</h3>				
                <h4><label >Sede/Filial:</label>{{$plan_mejoras->sede}}</h4>
                <h4><label >Carrera:</label>{{$plan_mejoras->carrera}}</h4>
                <h4><label >Actividad Propuesta:</label>{{$plan_mejoras->fecha_presentacion}}</h4>
                        <select style="display:none" name="plan_mejora_id" id="plan_mejora_id" value="{{old('plan_mejora_id', $plan_mejoras->id)}}" class="form-control" readonly>
                          <option type="hidden" value="{{$plan_mejoras->id}}">{{$plan_mejoras->fecha_presentacion}}</option>	
                        </select>
                <h4><label >Periodo:</label>{{$plan_mejoras->periodo}}</h4>
         <div class="panel panel-primary"></div>


	<div class="row">   
		<div class="panel panel-primary">
			<div class="panel-body">

							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group">            
								  <label for="dimension">Dimensiones:</label>
								  <select name="dimension_id"  class="form-control selectpicker" id="dimension_id" data-live-search="true">
									<option value="">Selecciona una dimensión</option>		
									@foreach($dimension as $dim)
									  {{-- <option value="{{$dim -> id}}">{{$dim->descri_dimension}}</option> --}}
									  @if(old('dimension_id') == $dim->id)
									  <option value="{{$dim->id}}" selected> {{ $dim->descri_dimension}}</option>
								  @else
								  <option value="{{$dim -> id}}">{{$dim->descri_dimension}}</option>
								  @endif
									  @endforeach
								  </select>
								  <div id="dimension_id-error" class="error text-danger pl-3" for="dimension_id" style="display: block;">
						               <strong>{{ $errors->first('dimension_id') }}</strong>
					               </div>
								</div>
								
							</div>
						
						    <div class="row">
							    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						            <label for="recomendacion_mejora">Mejora a Implementar:</label>
							        <textarea  style=" width: 100%; resize: none;" type="text" name="recomendacion_mejora" id="recomendacion_mejora" class="form-control" placeholder="Mejora a Implementar...">{{ old('recomendacion_mejora') }}</textarea>
							    <div id="recomendacion_mejora-error" class="error text-danger pl-3" for="recomendacion_mejora" style="display: block;">
						          <strong>{{ $errors->first('recomendacion_mejora') }}</strong>
					            </div>
							</div>
								
					        </div>
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
							    <div class="form-group">   
								    <button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
							    </div>
						     </div>
	               </div>
		      </div>
	    </div>
	</form>	

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							        <h3 style="text-align: center; font-weight: bold">Mejoras a implementar</h3>
									<div class="table-responsive">
					

				 @foreach($dimension as $dim )
										{{-- <p>
											<b>Dimension:</b> {{$dim->descri_dimension}}
										</p> 
								
							<table class="table table-striped mt-2">--}}
							<table class="table table-striped table-condensed table-hover">

									<thead class="bg-info" style="background-color:#6777ef">
										<th style="background-color: white">Dimencion:{{$dim->descri_dimension}}
										<tr class="text-light">
											<th style="display: none;">#</th>
											<th style="display: none;">Dimensiones</th>
											<th style="color:#fff;">Actividades</th>
											<th style="color:#fff;">Opciones</th>
										</tr>
									</thead>
									
									<tbody>
										
										@foreach ($detalle as $dpm )
										 
                                    
										 @if ($dpm->descri_dimension === $dim->descri_dimension )

										<tr>
											<td style="display: none;">{{$dpm->id}}</td>
											<td style="display: none;">{{$dpm->descri_dimension }}</td>
											<td>{{$dpm->recomendacion_mejora}}</td>
											<td>	
											{{--	<a class="btn btn-info" href="/transaccion/detalle/create?id={{$dpm->id }}">Ver</a> --}}
												 <a href="{{ route('propuesta.agregar', $dpm->id)}}" class="btn btn-success btn-xs" title="Agregar propuesta"><i class="fa fa-arrow-circle-right"></i></a>
												<a href="{{ route('detalle.edit', $dpm->id) }}" class="btn btn-info btn-xs" title="Editar"><i class="fa fa-edit "></i></a>
        
												<a href="" data-target="#modal-delete-{{$dpm->id}}" data-toggle="modal"><button class="btn btn-danger btn-xs" ><i class="fa fa-trash" title="Eliminar"></i></button></a>						

											</td>
										</tr>
										@include('transaccion.detalle.eliminar')
										@endif 
										
										@endforeach
									</tbody>
								</table>
								 @endforeach 
								

								{{ $detalle->links() }}
							</div>
						</div>

						{{-- @if(count($detalle) > 0)
						<div class="row">
							<div class="col">
								<table class="table">
									<thead>
										<tr>
											<th colspan="4" class="text-center">detalles</th>
										</tr>
										<tr>
											<th>recomendacion_mejora</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach($detalle as $value)
											<tr>
												<td>{{$value->recomendacion_mejora}}</td>
												<td>	
													<a href="{{ route('propuesta.agregar', $dpm->id)}}" class="btn btn-success btn-xs" title="Agregar propuesta"><i class="fa fa-arrow-circle-right"></i></a>
													<a href="{{ route('detalle.edit', $dpm->id) }}" class="btn btn-info btn-xs" title="Editar"><i class="fa fa-edit "></i></a>
			
													<a href="" data-target="#modal-delete-{{$dpm->id}}" data-toggle="modal"><button class="btn btn-danger btn-xs" ><i class="fa fa-trash" title="Eliminar"></i></button></a>						
	
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@endif --}}
					

						<div class="modal-footer">
							<a href="javascript:history.back()"> Volver Atrás</a>
							<a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
						</div> 
					
					
	
</form>
				 {{-- {{Form::close()}} --}}


     
		 {{-- @push('js')
		 <script type="text/javascript">
			 $(document).ready(function(){
				 $('#bt_add').click(function(){
					 agregar();
					
				 });
		
				});
			 //variables
			 
				var cont2 = 0;
				$('#guardar').hide();

    function agregar(){
	metodo_id = $("#dimension_id").val();
	metodo = $("#dimension_id option:selected").text();
	mejora_id = $("#recomendacion_mejora").val();
	
	if (metodo_id != "" && mejora_id != "" ) 
	    {
		
		var fila2 = '<tr id="fila2' +cont2+ '"><td><input type="hidden" name="dimension_id[]" value="' + metodo_id + '">'+ metodo +'</td><td><input type="hidden" name="mejoras[]" value="' + mejora_id + '">'+ mejora_id +'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar2('+cont2+');">X</button><i class="fas fa-trash-alt"></i></button></td></tr>';
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
				 $('#metodo_id').val('');
				 $('#mejora_id').val('');
				 $('#pdescuento').val('');
				 
			 }
			 
			 
		function eliminar2(index){
        total = cont2[index];
        $('#total').html('s/. '+total);
        $('#fila2' + index).remove();
    } 

	
		  </script>  
		  @endpush  --}} 
		   @push('js')
		 <script type="text/javascript">
			$(document).ready(function(){
				$('#sede_id').on('change', onSelectCarrera);



			});
			function onSelectCarrera(){
				var sed_id = $(this).val(); 
				if(! sed_id){
					$('#carrera_id').html('<option value="">Seleccione la carrera</option>')
                    return;
				}
        		$.get('/sede/'+sed_id+'/carrera', function (data){
					var html_select = '';
        			 var html_select = '<option value="">Selecciona una carrera</option>';
					 
					 for (var i=0; i<data.length; ++i)
						html_select += '<option value="'+data[i].id+'">'+data[i].descri_carrera+'</option>';
					
					 $('#carrera_id').html(html_select);

                   	//console.log(html_select);			

						
					 });
					
			}
			
		 </script>  


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