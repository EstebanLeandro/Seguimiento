
@extends('layouts.pdf') 
@section('contenido')

<div class="row">

     <head>  	
		<center><p> 
		 <h1 class="text-center"></h1>  
		 <h2 class="text-center">PROCESO DE EVALUACIÓN Y ACREDITACIÓN DE CARRERAS DE GRADO</h2>
		 <h2 class="text-center"></h2> 
         <h2 class="text-center">MODELO NACIONAL DE ACREDITACIÓN DE LA EDUCACIÓN SUPERIOR</h2>
         <h1 class="text-center"></h1> 
		 <h2 class="text-center">PLAN DE MEJORAS</h2> </center>
	</head>    
	<center><p >  <h3><label >Sede: {{$mejora->sede}}</label></h3>
		<h3><label ></label></h3>

	    <h3><label >Carrera: {{$mejora->carrera}}</label></h3>
		<h3><label ></label></h3>

		<h3><label >Ciudad: {{$mejora->sede}}</label></h3></p></center>
		<h1><label ></label></h1>
		<h1><label ></label></h1>
		<h1><label ></label></h1>

		<div id="header" >
			<table align="center">
				<tr>
					@if ($datos!="")
					<td  style="text-align: left;"> <label > Fecha: {{ $datos }} </label ></td>
					
					@else
					@yield('fecha')
					@endif
				</tr>
				
			</table>
		</div> 
</div>
<div class="panel panel-primary"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			@foreach($dimension as $dim )
			<p>
				{{-- <b>Dimension:</b>- {{$dim->descri_dimension}} --}}
			</p>
			
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead  style="background:lightblue">
				
					<th>Dimencion:</th><td style="background-color: white">{{$dim->descri_dimension}}</td>
					
					<tr class="text-center" >
						<th class="text-center">Mejoras a ser
							implementadas</th>
                        <th class="text-center">Actividades</th>
						<th class="text-center">Medios Verificación</th>
						<th class="text-center">Metas/plazos</th>
						<th class="text-center">Fuentes de financiamiento</th>
						<th class="text-center">Inversión prevista</th>

					</tr>
				</thead>
				

				<tbody>
					@foreach($propuesta as $pro)
					@if ($pro->descri_dimension === $dim->descri_dimension )
						
				      <tr style="background: rgba(21, 36, 22, 0.1)">
                      <td class="text-center">{{$pro->recomendacion_mejora}}</td>
                      <td class="text-center">{{ $pro->descri_actividades}}</td> 
					  <td class="text-center">{{ $pro->medio_verificacion}}</td> 
                      <td class="text-center">{{ $pro->plazo}}</td>
                      <td class="text-center">{{ $pro->fuente_financiamiento}}</td>
                      <td class="text-center">{{ $pro->inversion_prevista}}</td>
                      
					</tr>
					@endif
					@endforeach  

				</tbody>
			</table>
		
			@endforeach
		</div>
	</div>
</div>



@endsection