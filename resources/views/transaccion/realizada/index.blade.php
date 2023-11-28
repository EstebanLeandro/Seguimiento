@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Informe de Mejoras Realizadas
			{{--	<a href="realizada/create"><button class="btn btn-success">Nuevo</button></a>				
				 <a href="/realizada/reporte" class="btn btn-social-icon btn-google" title="Reporte">
				<i class="fa fa-file-pdf-o"></i></a> --}}
			</h3>
		@include('transaccion.realizada.search')
	</div>
</div>

<div class="panel panel-primary"></div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="ta.ble-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead  style="background-color:#6777ef">
					<tr class="text-light">
					    <th style="color:#fff;">Fecha Presentaciones</th>
					    <th style="color:#fff;">Periodos</th>
				        <th style="color:#fff;">Sedes</th> 
						<th style="color:#fff;">Carreras</th>
					    <th style="color:#fff;">Opciones</th>
					    </tr>
				</thead>
               @foreach ($plan_mejoras as $pm)
			   {{-- @php
						@dd($pm->descri_carrera);
						@endphp --}}
						
				<tr>
					
					<td>{{ $pm->fecha_presentacion}}</td>
					<td>{{ $pm->periodo}}</td>
					<td>{{ $pm->sede}}</td>
					<td>{{ $pm->carrera}}</td>
					<td>							
						<a href="{{ route('ver.mejora', $pm->id)}}" class="btn btn-info btn-xs" title="Ver mejoras"><i class="fa fa-arrow-circle-right "></i></a>
						<a href="{{ route('informe.general', $pm->id)}}" class="btn btn-danger btn-xs" title="Informe"><i class="fa fa-file-pdf-o"></i></a>
					</td>
					{{-- <td>
						
						<a href="{{URL::action('MejoraController@show', $pm ->id)}}">
                            <button class="btn btn-primary">Ver</button>
                        </a>						
						<a href="" data-target="#modal-delete-{{$pm->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button>
						</a>

					</td> --}}
				</tr>
				{{-- @include('transaccion.realizada.modal') --}}
				@endforeach
			</table>
		</div>
		<!-- {{-- $plan_mejoras->render()--} -->
	</div>
</div>

@endsection