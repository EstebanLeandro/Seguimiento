@extends ('layouts.admin')
@section ('contenido')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 style="font-weight: bold">Agregar nueva mejora:</h3>
        </div>
	</div>
	<div class="panel panel-primary"></div>

			{{-- {!!Form::open(array('url'=>'transaccion/mejora','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}
			<form action="{{ route('mejora.store') }}" method ="POST">
				@csrf
		<div class="row">
			    
		        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
   			        <div class="fom-group">
						{{-- @php
							@dd($sc->id);
							@endphp  --}}
						<label for="sede_id">Sede/Filial:</label>	
						<select name="sede_id" id="sede_id" class="form-control selectpicker" data-live-search="true" >
							 <option value="">Selecciona una sede</option>
							@foreach($sede as $sc)
							  {{-- <option value="{{$sc->id}}">{{$sc->descri_sede}}</option> --}}
							  @if(old('sede_id') == $sc->id)
                                   <option value="{{$sc->id}}" selected> {{ $sc->descri_sede}}</option>
                               @else
							   <option value="{{$sc->id}}">{{$sc->descri_sede}}</option>
                               @endif
							@endforeach  
						</select>
						<div id="sede_id-error" class="error text-danger pl-3" for="sede_id" style="display: block;">
						<strong>{{ $errors->first('sede_id') }}</strong>
					    </div>
					</div>
					
				</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="fom-group"> 
					 <label for="carrera_id">Carrera:</label>
					 <select name="carrera_id" id="carrera_id" typr="hidden" class="form-control">
						<option value="">Selecciona una carrera</option>		
					  </select> 
					  <div id="carrera_id-error" class="error text-danger pl-3" for="carrera_id" style="display: block;">
						<strong>{{ $errors->first('carrera_id') }}</strong>
					    </div>
					</div>
					
				 </div>
			
			
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <div class="form-group">
            	  <label for="fecha_presentacion">Fecha de Presentación:</label>
            	  <input type="date" name="fecha_presentacion" id="fecha_presentacion"  class="form-control" placeholder="Fecha de presentacion..." value="{{ old('fecha_presentacion') }}">
				  <div id="fecha_presentacion-error" class="error text-danger pl-3" for="fecha_presentacion" style="display: block;">
					<strong>{{ $errors->first('fecha_presentacion') }}</strong>
				   </div>
				</div>
			</div>

			 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">            
				  <label for="periodo">Periodo:</label>
				  <select name="periodo_id"  class="form-control selectpicker" id="periodo_id" data-live-search="true" value="{{ old('descri_periodo') }}">
					<option value="">Selecciona un periodo de evaluación</option>
					@foreach($periodos as $per)
					  <option value="{{$per -> id}}" >{{$per->descri_periodo}}</option>
					@endforeach
				  </select>
				  <div id="periodo_id-error" class="error text-danger pl-3" for="periodo_id" style="display: block;">
					<strong>{{ $errors->first('periodo_id') }}</strong>
				   </div>
				
				</div>
				
			</div>
						         
			                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                				<div class="form-group">   
								    <button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
									<button class="btn btn-danger" type="reset" data-dismiss="modal" role="alert">Cancelar</button>
							    </div>
						     </div>
	           
	</div>
					

			       <div class="modal-footer">
					    <a href="javascript:history.back()"> Volver Atrás</a>
						<a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
					</div>         
				 {{-- {{Form::close()}} --}}

</form> 
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