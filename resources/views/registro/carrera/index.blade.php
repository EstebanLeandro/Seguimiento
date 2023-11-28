
@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">     
		<h3>Listado de Carreras 
		@can('crear-registro') 
		<a href="carrera/create"><button class="btn btn-success">Nuevo</button></a>
		@endcan
	    </h3>
		@include('registro.carrera.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped mt-2">
				<thead style="background-color:#6777ef">
					{{--<th>Id</th>--}}
					<th style="color:#fff;">Facultades</th>
					<th style="color:#fff;">Descripción</th>
					<th style="color:#fff;">Opciones</th>
				</thead>
               @foreach ($carreras as $car)
				<tr>
					{{--<td>{{ $car->id}}</td>--}}
					<td>{{ $car->facultads}}</td>
					<td>{{ $car->descri_carrera}}</td>
					<td>
						@can('editar-registro') 
						<a href="{{route('carrera.editar',$car->id)}}"><button class="btn btn-info">Editar</button></a>
                        @endcan
						@can('borrar-registro') 
						<a href="" data-target="#modal-delete-{{$car->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					    @endcan
					</td>
				</tr>
				@include('registro.carrera.modal')
				@endforeach
			</table>
		</div>
		{{$carreras->render()}}
	</div>
</div>

@endsection