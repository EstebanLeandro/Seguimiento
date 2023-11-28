
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de propuestas de Mejoras
		    <a href="/propuesta/reporte" class="btn btn-social-icon btn-google" title="Reporte">
			<i class="fa fa-file-pdf-o"></i></a>
		</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Recomendaciones</th>
					<th>Actividades</th>
					<th>Medios de verificación</th>
					<th>Plazos</th>
					<th>Responsables</th>
					<th>Fuentes de Financiamientos</th>
					<th>Inversiones Previstas</th>
					<th>Opciones</th>
				</thead>
               @foreach ($propuestas as $pro)
				<tr>
					<td>{{ $pro->recomendacion_mejora}}</td>
					<td>{{ $pro->descri_actividades}}</td>
					<td>{{ $pro->medio_verificacion}}</td>
					<td>{{ $pro->plazo}}</td>
					<td>{{ $pro->descri_responsable}}</td>
					<td>{{ $pro->fuente_financiamiento}}</td>
					<td>{{ $pro->inversion_prevista}}</td>
					{{-- <td>
						<a href="{{URL::action('PropuestaController@show', $pro -> id)}}">
                            <button class="btn btn-primary">Ver</button>
                        </a>                         
						<a href="" data-target="#modal-delete-{{$pro->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td> --}}
				</tr>
				@include('transaccion.propuesta.modal')
				@endforeach
			</table>
		</div>
		{{$propuestas-> render()}}
	</div>
</div>

@endsection