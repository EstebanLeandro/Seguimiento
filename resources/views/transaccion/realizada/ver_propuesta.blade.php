@extends ('layouts.admin')
@section ('contenido')


<div class="form-group">
			@if (count($errors)>0)
			    <div class="alert alert-danger">
				    <ul>
				        @foreach ($errors->all() as $error)
					        <li>{{$error}}</li>
				        @endforeach
				    </ul>
			    </div>
			@endif
	</div>	

	<form action="{{ route('detalle.store') }}" method ="POST">
        @csrf
			{{-- {!!Form::open(array('url'=>'transaccion/propuesta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}
			
	<div class="fom-group">	
				   <h3 style="text-align:center; font-weight: bold;">Actividades</h3>	
				   <h4><label >Dimensión:</label>{{$detalle->dimension->descri_dimension}}</h4>
				   <h4><label >Actividad Propuesta:</label>{{$detalle->recomendacion_mejora}}</h4>
						   {{-- <select style="display:none"  onclick="onSelectDetalle()"  name="detalle_plan_mejora_id" id="detalle_plan_mejora_id" value="{{old('detalle_plan_mejora_id', $detalle->id)}}" class="form-control" readonly>
							 <option type="hidden" value="{{$detalle->id}}">{{$detalle->recomendacion_mejora}}</option>	
						   </select> --}}
			<div class="panel panel-primary"></div>
	</div>	

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3 style="text-align: center; font-weight: bold">Propuesta implementada</h3>
		<div class="table-responsive">
			 <table class="table  table-striped table-bordered table-condensed table-hover">
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
						<td>{{ $pro->recomendacion_mejora}}</td>
						<td>{{ $pro->descri_actividades}}</td>
						<td>{{ $pro->medio_verificacion}}</td>
						<td>{{ $pro->plazo}}</td>
						<td>{{ $pro->descri_responsable}}</td>
						<td>{{ $pro->fuente_financiamiento}}</td>
						<td>{{ $pro->inversion_prevista}}</td>
						<td>							
							<a href="{{ route('realizada.agregar', $pro->id)}}" class="btn btn-success btn-xs" title="Agregar Realizada"><i class="fa fa-arrow-circle-right "></i></a>
						
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{-- $propuesta->links()--}}
		</div>
	</div>
	
	<div class="modal-footer">
		<a href="javascript:history.back()"> Volver Atrás</a>
		<a href="\transaccion\realizada" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
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
	 
	@push('js')
		 <script type="text/javascript">
			/* $(document).ready(function(){
				 $('#detalle_plan_mejora_id').on('change', onSelectDetalle);
				 console.log(detalle_plan_mejora_id);			
	
				 });*/
				 $(document).ready(function(){
        
        $('#detalle_plan_mejora_id').click(function(){
            onSelectDetalle();
        })
    });

    // function onSelectDetalle(){
	// 	var detalle_id = $(this).val(); 
    //     		$.get('/detalle/'+detalle_id+'/propuesta', function (data){
	// 				 $("#select").html("");
        			//  var html_select = '<option value="">Selecciona una carrera</option>';
//$(function(){
 // $(".cargar").click(function(){

	function onSelectDetalle(){
		var detalle_id = $(this).val(); 
		if(! detalle_id){
                $("#select").html("")
                       return;
                   }
		
		//console.log(select);
	
    $.get('/detalle/'+detalle_id+'/propuesta', function(data){
     
					  for (var i=0; i<data.datos.length; ++i)
					  var tr = `<tr>
					  <td>`+data.datos[i].recomendacion_mejora+`</td>
					  <td>`+data.datos[i].descri_actividades+`</td>
					  <td>`+data.datos[i].medio_verificacion+`</td>
					  <td>`+data.datos[i].plazo+`</td>
					  <td>`+data.datos[i].descri_responsable+`</td>
					  <td>`+data.datos[i].fuente_financiamiento+`</td>
					  <td>`+data.datos[i].inversion_prevista+`</td>
					  </tr>`;
					  $("#select").append(tr);

					// 	html_select += '<option value="'+data[i].id+'">'+data[i].descri_carrera+'</option>';
					
					//  $('#carrera_id').html(html_select);

                 // 	console.log(select);	
										
    });

}

/*	metodo_id = $("#dimension_id").val();
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
    } */

	
		  </script>  
		  @endpush  
    
		
		 @endsection