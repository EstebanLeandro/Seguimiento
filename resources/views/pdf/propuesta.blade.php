@extends('layouts.pdf')
@section('contenido')
<h3 class="text-title text-center">Reporte de registro</h3>
<div class="row">
	<div class="col-xs-12">
		<div class="table-responsive">
			<table class="table table-condensed table-striped">
				<thead style="background: rgba(33, 208, 54, 0.3)">
					<tr class="text-center">
						<th class="text-center">Recomendaciones:</th>
						<th class="text-center">Decripciones:</th>
						<th class="text-center">Medio Verificaciones:</th>
						<th class="text-center">Plazos:</th>
						<th class="text-center">Responsables:</th>
						<th class="text-center">Recomendaciones:</th>
                        <th class="text-center">Fuentes Financiamientos:</th>
						<th class="text-center">Inversiones Prevista:</th>

					</tr>
				</thead>

				
				<tbody>
					@foreach ($propuestas as $pro) 
				    <tr style="background: rgba(33, 208, 54, 0.1)">
                      <td class="text-center">{{ $pro->recomendacion_mejora}}</td>
                      <td class="text-center">{{ $pro->descri_actividades}}</td>
                      <td class="text-center">{{ $pro->medio_verificacion}}</td>
                      <td class="text-center">{{ $pro->plazo}}</td>
                      <td class="text-center">{{ $pro->descri_responsable}}</td>
                      <td class="text-center">{{ $pro->recomendacion_mejora}}</td>
                      <td class="text-center">{{ $pro->fuente_financiamiento}}</td>
                      <td class="text-center">{{ $pro->inversion_prevista}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection