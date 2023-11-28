@extends('layouts.pdf')
@section('contenido')
<h3 class="text-title text-center">Reporte de registro</h3>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-condensed table-striped">
				<thead style="background: rgba(33, 208, 54, 0.3)">
					<tr class="text-center">
						<th class="text-center">Actividades Realizadas:</th>
						<th class="text-center">Medios Verificación:</th>
						<th class="text-center">Plazos:</th>
						<th class="text-center">Responsables:</th>
						<th class="text-center">Cumplimientos:</th>
						<th class="text-center">Resultados:</th>
                        <th class="text-center">Avances:</th>
						<th class="text-center">Pendientes:</th>

					</tr>
				</thead>
				<tbody>
					@foreach ($realizadas as $pro) 
				    <tr style="background: rgba(33, 208, 54, 0.1)">
                      <td class="text-center">{{ $pro->descri_realizadas}}</td>
                      <td class="text-center">{{ $pro->medio_verificacion}}</td>
                      <td class="text-center">{{ $pro->plazo}}</td>
                      <td class="text-center">{{ $pro->descri_responsable}}</td>
                      <td class="text-center">{{ $pro->cumplimiento}}</td>
                      <td class="text-center">{{ $pro->resultados}}</td>
                      <td class="text-center">{{ $pro->avance}}</td>
                      <td class="text-center">{{ $pro->pendientes}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection