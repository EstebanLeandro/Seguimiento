@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h4><label >Editar Actividad de mejora:</label>{{$detalle->recomendacion_mejora}}</h4>
  
		   
    </div>
</div>
<div class="panel panel-primary"></div>


		<form action="{{ route('detalle.update', $detalle->id) }}" method ="POST">
			@csrf
			{{ method_field('PUT') }}

	<div class="row">
		
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
		                <input style="display:none" type="text" name="plan_mejora_id" id="plan_mejora_id" class="form-control" value="{{$detalle->plan_mejora_id}}" readonly>
	               </div>     

		            <div class="form-group">            
		                <label for="dimension_id">Dimensión:</label>
		                    <select name="dimension_id" value="{{old('dimension_id', $detalle->dimension_id)}}" class="form-control selectpicker" data-live-search="true">
			                    <option value="{{$detalle->dimension_id}}">{{$detalle->dimension->descri_dimension}}</option>
			                        @foreach($dimension as $dim)
			                            <option value="{{$dim -> id}}">{{$dim -> descri_dimension}}</option>
			                        @endforeach
		                    </select>
							<div id="dimension_id-error" class="error text-danger pl-3" for="dimension_id" style="display: block;">
						               <strong>{{ $errors->first('dimension_id') }}</strong>
					        </div>
                    </div>
		      

			        <div class="form-group">
				        <label for="recomendacion_mejora">Recomendación Mejora:</label>
				        <textarea type="text" name="recomendacion_mejora" id="recomendacion_mejora" class="form-control">{{$detalle->recomendacion_mejora}}</textarea>
						<div id="recomendacion_mejora-error" class="error text-danger pl-3" for="recomendacion_mejora" style="display: block;">
						     <strong>{{ $errors->first('recomendacion_mejora') }}</strong>
					    </div>
					</div>
		      	              	
	   

			
					<div class="form-group">
						 <button class="btn btn-primary" type="submit" data-dismiss="success" >Actualizar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
				   </div>
				
	    </div>
	</div>			
	<div class="modal-footer">
		<a href="javascript:history.back()"> Volver Atrás</a>
		<a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
	</div>

</form>
			{{-- {!!Form::close()!!}		 --}}
	
	@endsection