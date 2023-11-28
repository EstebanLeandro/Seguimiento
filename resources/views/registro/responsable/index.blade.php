@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de responsables
		@can('crear-registro')      
		 <a href="responsable/create"><button class="btn btn-success">Nuevo</button></a>
		@endcan
	    </h3>
		@include('registro.responsable.search')
	</div>
</div>
<div class="panel panel-primary"></div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
		<table class="table table-striped mt-2">
				<thead style="background-color:#6777ef">
					<th style="color:#fff;">Id</th>
					<th style="color:#fff;">Responsables</th>
					<th style="color:#fff;">Opciones</th>
				</thead>
               @foreach ($responsables as $re)
				<tr>
					<td>{{ $re->id}}</td>
					<td>{{ $re->descri_responsable}}</td>
					<td>
						@can('editar-registro') 
						<a href="{{route('responsable.editar',$re->id)}}"><button class="btn btn-info">Editar</button></a>
                        @endcan
						@can('borrar-registro') 
						<a href="" data-target="#modal-delete-{{$re->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					    @endcan
					</td>
				</tr>
				@include('registro.responsable.modal')
				@endforeach
			</table>
		</div>
		{{$responsables->render()}}
	</div>
</div>

@endsection