@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3 style="font-weight: bold" >Planes de Mejora
		@can('crear-plan-mejoras')      		 
			<a href="mejora/create"><button class="btn btn-success">Nuevo</button></a>
		@endcan
		
		</h3>

		@include('transaccion.mejora.search')
	</div>
</div>
<form action="{{ route('detalle.store') }}" method ="POST">
	@csrf
<div class="panel panel-primary"></div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped mt-2">
				<thead class="bg-info" style="background-color:#6777ef">
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
						@can('ver-plan-mejoras')      		 							
						<a href="{{ route('detalle.create', $pm->id)}}" class="btn btn-success btn-xs" title="Agregar mejora"><i class="fa fa-arrow-circle-right "></i></a>
						@endcan
						@can('editar-plan-mejoras')      		 
						<a href="{{ route('mejora.editar', $pm->id) }}" class="btn btn-info btn-xs" title="Editar"><i class="fa fa-edit "></i></a>
						@endcan
						@can('borrar-plan-mejoras')      		 
						<a href="" data-target="#modal-delete-{{$pm->id}}" data-toggle="modal"><button class="btn btn-danger btn-xs" ><i class="fa fa-trash" title="Eliminar"></i></button></a>						
						{!!Form::open(['route'=>['mejora.delete', $pm->id], 'method' => 'DELETE','id'=>'eliminar']) !!}
						{!!Form::close()!!}
						@endcan
						<a href="{{ route('mejora.propuesta', $pm->id)}}" class="btn btn-danger btn-xs" title="Informe"><i class="fa fa-file-pdf-o"></i></a>

					</td>
				
				</tr>
				@include('transaccion.mejora.modal')

				@endforeach
			</table>
			<div class="pagination justify-content-end">
				{!! $plan_mejoras->links() !!}
			  </div>    
</div>
   



@endsection