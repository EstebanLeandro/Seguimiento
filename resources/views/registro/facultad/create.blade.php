@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 style="font-weight: bold">Agregar nueva facultad</h3>
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

			{{-- {!!Form::open(array('url'=>'registro/facultad','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}
			<form action="{{ route('facultad.store') }}" method ="POST">
				@csrf
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descri_facultad" class="form-control" placeholder="Descripción facultad..."  value="{{old('descri_facultad')}}">
				<div id="descri_facultad-error" class="error text-danger pl-3" for="descri_facultad" style="display: block;">
				   <strong>{{ $errors->first('descri_facultad') }}</strong>
			    </div>
            </div>
			
            <div class="form-group">
            	<button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
            	<button class="btn btn-danger" type="reset" role="alert">Cancelar</button>
            </div>

		</div>
	</div>
			<div class="modal-footer">
				<a href="\registro\facultad" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
		    </div> 

			{{-- {!!Form::close()!!}		 --}}         
</form>	

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