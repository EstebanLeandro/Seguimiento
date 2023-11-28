{{-- @extends('layouts.pdf') --}}

@extends('layouts.pdf') 
@section('contenido')

<div class="row">

     <head>  	
		<center><p>  
			<h1 class="text-center"></h1> 
			<h2 class="text-center">PROCESO DE EVALUACIÓN Y ACREDITACIÓN DE CARRERAS DE GRADO</h2>
			<h1 class="text-center"></h1> 
			<h2 class="text-center">MODELO NACIONAL DE ACREDITACIÓN DE LA EDUCACIÓN SUPERIOR</h2>
		 <h1 class="text-center"></h1> 
		 <h2 class="text-center">SEGUIMIENTO DE IMPLEMENTACIÓN DEL PLAN DE MEJORAS</h2> </center>
         <h1 class="text-center"></h1> 

		</head>    
	<center><p >  
		<h3><label >Sede: {{$informe->sede}}</label></h3>
		<h3><label ></label></h3>

	    <h3><label >Carrera: {{$informe->carrera}}</label></h3>
		<h3><label ></label></h3>

		<h3><label >Ciudad: {{$informe->sede}}</label></h3>
		<h1 class="text-center"></h1> 
		<h1 class="text-center"></h1> 

		<h1 class="text-center"></h1> 


	</p></center>
		<div id="header">
			<table align="center">
				<tr>
					@if ($datos!="")
					<td style="text-align: right;"> Fecha: {{ $datos }}</td>
					
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
				{{-- <b>Dimension:</b> {{$dim->descri_dimension}} --}}
			</p>
			
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead  style="background:lightblue">
				
					<th>Dimencion:</th><td style="background-color: white">{{$dim->descri_dimension}}</td>
					
					<tr class="text-center" >
						<th class="text-center">Sugerencias de 
                            mejora</th>
                        <th class="text-center">Mejoras 
                                implentadas</th>
						<th class="text-center">Medios Verificación</th>
						<th class="text-center">Metas/plazos</th>
						<th class="text-center">Responsables </th>
						<th class="text-center">Cumplimientos Total-Parcial</th>
						<th class="text-center">Resultados</th>
                        <th class="text-center">Avances %</th>
						<th class="text-center">Pendientes</th>

					</tr>
				</thead>
				

				<tbody>
					@foreach($realizada as $rea)
					@if ($rea->descri_dimension === $dim->descri_dimension )
						
				      <tr style="background: rgba(21, 36, 22, 0.1)">
                      <td class="text-center">{{$rea->descri_actividades}}</td>
                      <td class="text-center">{{ $rea->descri_realizadas}}</td> 
					  <td class="text-center">{{ $rea->descri_verificacion}}</td> 
                      <td class="text-center">{{ $rea->plazo}}</td>
                      <td class="text-center">{{ $rea->descri_responsable}}</td>
                      <td class="text-center">{{ $rea->cumplimiento}}</td>
                      <td class="text-center">{{ $rea->resultados}}</td>
                      <td class="text-center">{{ $rea->avance}}</td>
                      <td class="text-center">{{ $rea->pendientes}}</td> 
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