@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de los periodos 
		@can('crear-registro')      
		<a href="periodo/create"><button class="btn btn-success">Nuevo</button></a>
		@endcan
	   </h3>
		@include('registro.periodo.search')
	</div>
</div>
<div class="panel panel-primary"></div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped mt-2">
				<thead style="background-color:#6777ef">
					<th style="color:#fff;">Id</th>
					<th style="color:#fff;">Descripción</th>
					<th style="color:#fff;">Opciones</th>
				</thead>
               @foreach ($periodos as $per)
				<tr>
					<td>{{ $per->id}}</td>
					<td>{{ $per->descri_periodo}}</td>
					<td>
						@can('editar-registro') 
						<a href="{{route('periodo.editar',$per->id)}}"><button class="btn btn-info">Editar</button></a>
                        @endcan
						@can('borrar-registro') 
						<a href="" data-target="#modal-delete-{{$per->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					    @endcan
					</td>
				</tr>
				@include('registro.periodo.modal')
				@endforeach
			</table>
		</div>
		{{$periodos->render()}}
	</div>
</div>

@endsection