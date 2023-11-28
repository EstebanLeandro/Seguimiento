@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 style="font-weight: bold">Agregar nueva Carrera</h3>
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

			{{-- {!!Form::open(array('url'=>'registro/carrera','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}
	<form action="{{ route('carrera.store') }}" method ="POST">
		@csrf
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">            
					  <label for="facultades">Facultades:</label>
					  <select name="facultad_id"  class="form-control selectpicker" data-live-search="true">
					  <option value="">Selecciona una facultad</option>		
						 @foreach($facultad as $fa)
						  {{-- <option value="{{$fa -> id}}">{{$fa->descri_facultad}}</option> --}}
						  @if(old('facultad_id') == $fa->id)
                                   <option value="{{$fa->id}}" selected> {{ $fa->descri_facultad}}</option>
                               @else
							   <option value="{{$fa->id}}">{{$fa ->descri_facultad}}</option>
                               @endif
						  @endforeach
					  </select>
					  <div id="facultad_id-error" class="error text-danger pl-3" for="facultad_id" style="display: block;">
						           <strong>{{ $errors->first('facultad_id') }}</strong>
					    </div>
			        </div>
					
		        </div>
			</div>

		
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		       <div class="form-group">            
			        <label  for="carrera_sedes">Sede/Filial: </label>
					@foreach ($sede as $sede)
					<input type="checkbox" class="form-check-input"  name="skills[]" value="{{$sede->id}}">
					 <label class="form-check-label">{{$sede->descri_sede, ucfirst($sede->descri_sede)}}</label>
		  
				@endforeach
					   <div id="skills-error" class="error text-danger pl-3" for="skills" style="display: block;">
						           <strong>{{ $errors->first('skills') }}</strong>
					    </div>
		        </div>
				
		    </div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <div class="form-group">
            	  <label for="descripcion">Descripción</label>
            	  <input type="text" name="descri_carrera" class="form-control" placeholder="Descripción carrera..." value="{{ old('descri_carrera') }}">
				  <div id="descri_carrera-error" class="error text-danger pl-3" for="descri_carrera" style="display: block;">
						           <strong>{{ $errors->first('descri_carrera') }}</strong>
					    </div>
                </div>
				
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
            	   <button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
            	   <button class="btn btn-danger" type="reset" data-dismiss="modal" role="alert">Cancelar</button>
                </div>
			</div>
		</div>
				<div class="modal-footer">
				   <a href="\registro\carrera" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
				</div>
			
</form>
			{{-- {{Form::close()}} --}}



			@push('js')
	<script type="text/javascript">

	$("body").on("keydown", "input, select, textarea", function(e) {
		var self = $(this),
		  form = self.parents("form:eq(0)"),
		  focusable,
		  next;
		
		// si presiono el enter
		if (e.keyCode == 13) {
		  // busco el siguiente elemento
		  focusable = form.find("input,a,select,button,textarea").filter(":visible");
		  next = focusable.eq(focusable.index(this) + 1);
		  
		  // si existe siguiente elemento, hago foco
		  if (next.length) {
			next.focus();
		  } else {
			// si no existe otro elemento, hago submit
			// esto lo podrías quitar pero creo que puede
			// ser bastante útil
			form.submit();
		  }
		  return false;
		}
	  });

	  </script>
	@endpush

@endsection

