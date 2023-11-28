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
	</div>
	 <form action="{{ route('detalle.store') }}" method ="POST">
        @csrf
 {{--   <form action="{{ route('detalle.store', $plan_mejora->id) }}" method ="POST">
        @csrf
        {{ method_field('PUT') }} 
		 {!!Form::open(array('url'=>'transaccion/realizada','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}

            <div class="fom-group">	
                <h3 style="text-align:center; font-weight: bold;">Actividad mejora</h3>				
                <h4><label >Sede/Filial:</label>{{$plan_mejoras->sede}}</h4>
                <h4><label >Carrera:</label>{{$plan_mejoras->carrera}}</h4>
                <h4><label >Actividad Propuesta:</label>{{$plan_mejoras->fecha_presentacion}}</h4>
                        <select style="display:none" name="plan_mejora_id" id="plan_mejora_id" value="{{old('plan_mejora_id', $plan_mejoras->id)}}" class="form-control" readonly>
                          <option type="hidden" value="{{$plan_mejoras->id}}">{{$plan_mejoras->fecha_presentacion}}</option>	
                        </select>
                <h4><label >Periodo:</label>{{$plan_mejoras->periodo}}</h4>


         <div class="panel panel-primary"></div>
		 
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							        <h3 style="text-align: center; font-weight: bold">Mejoras a implementar</h3>
				@foreach($dimension as $dim )
					
										{{-- <p>
											<b>Dimension:</b> {{$dim->descri_dimension}}
										</p> --}}
							<div class="table-responsive">
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
										@foreach ($detalle as $det)
										@if ($det->descri_dimension === $dim->descri_dimension )

										  <tr>
											<td style="display: none;">{{$det->id}}</td>
											<td style="display: none;">{{$det->descri_dimension}}</td>
											<td>{{$det->recomendacion_mejora}}</td>
											<td>	
												<a href="{{ route('ver.propuesta', $det->id)}}" class="btn btn-info btn-xs" title="Ver Propuesta"><i class="fa fa-arrow-circle-right"></i></a>
												
											</td>
									       </tr>
										   @endif 
										@endforeach
									</tbody>
								</table>
								@endforeach

								{{ $detalle->links() }}
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