@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3 style="font-weight: bold">Editar Carrera: {{ $carrera->descri_carrera}}</h3>
		@if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
	</div>
</div>
<div class="panel panel-primary"></div>

		{{-- {{Form::model($carrera, ['method' => 'PATCH', 'route' => ['carrera.update', $carrera -> id]])}}
        {{Form::token()}} --}}

	<form action="{{ route('carrera.update', $carrera->id) }}" method ="POST">
		@csrf
		{{ method_field('PUT') }}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">            
				  <label for="facultades">Facultades:</label>
				  <select name="facultad_id" value="{{old('facultad_id', $carrera->facultad_id)}}" class="form-control selectpicker" data-live-search="true">
					<option value="{{$carrera->facultad_id}}">{{$carrera->facultad->descri_facultad}}</option>
					@foreach($facultad as $fa)
					  <option value="{{$fa -> id}}">{{$fa -> descri_facultad}}</option>
					  @endforeach
				  </select>
				  <div id="facultad_id-error" class="error text-danger pl-3" for="facultad_id" style="display: block;">
						           <strong>{{ $errors->first('facultad_id') }}</strong>
					    </div>

		</div>
			
				<div class="form-group">            
				  <label  for="carrera_sedes">Sede / Filial: </label>
				    @foreach ($sede as $sede)
				        
					          <input type="checkbox" class="form-check-input"  name="skills[]" 
					                @foreach ($carrera->sedes as $cs)
						                    @if ($sede->id == $cs->id)
						                      checked
					                        @endif
					                @endforeach value="{{$sede->id.$carrera->sedes}}">
					       <label class="form-check-label">{{$sede->descri_sede, ucfirst($sede->descri_sede)}}</label>
				       
				    @endforeach
					<div id="skills-error" class="error text-danger pl-3" for="skills" style="display: block;">
						           <strong>{{ $errors->first('skills') }}</strong>
					    </div>
			    </div>
	       


		
		   <div class="form-group">
			  <label for="descripcion">Descripción</label>
			  <input type="text" name="descri_carrera" class="form-control" value="{{$carrera->descri_carrera}}" placeholder="Descripción...">
			  <div id="descri_carrera-error" class="error text-danger pl-3" for="descri_carrera" style="display: block;">
						           <strong>{{ $errors->first('descri_carrera') }}</strong>
				</div>

			</div>
		
		
		
			    <div class="form-group">
			       <button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
			        <button class="btn btn-danger" type="reset">Cancelar</button>
		      </div> 
		
	</div>
</div>			   
				<div class="modal-footer">
			         <a href="\registro\carrera" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
			    </div>
		
</form>
			{{-- {!!Form::close()!!}	 --}}
			
		@push('js')
		<script type="text/javascript">
	
			$(document).ready(function(){
				var valor = value="{{$carrera->id}}";

                // console.log(valor);

			
				 
        		$.get('/carrera/'+valor+'/sede', function (data){
					var html_select = '';
        			// var html_select = '<option value="">Selecciona una carrera</option>';
					 
					 for (var i=0; i<data.length; ++i)
						html_select += '<option value="'+data[i].id+'</option>';
					 //$('#sede_id').html(html_select);
					 
						

                  	console.log(html_select);			

						
					 });
					
			});
	 
  </script> 
 @endpush
@endsection