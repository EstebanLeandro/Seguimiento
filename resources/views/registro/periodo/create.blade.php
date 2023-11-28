@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 style="font-weight: bold">Agregar nuevo periodo</h3>
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

			{{-- {!!Form::open(array('url'=>'registro/periodo','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}
			<form action="{{ route('periodo.store') }}" method ="POST">
			@csrf
    <div class="row">
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descri_periodo" class="form-control" placeholder="Descripción periodo..."  value="{{old('descri_periodo')}}">
				<div id="descri_periodo-error" class="error text-danger pl-3" for="descri_periodo" style="display: block;">
				   <strong>{{ $errors->first('descri_periodo') }}</strong>
			    </div>
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
            	<button class="btn btn-danger" type="reset"  role="alert">Cancelar</button>
            </div>
			
		</div>
	</div>
			<div class="modal-footer">
			<a href="\registro\periodo" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
			</div>

</form>		{{-- {!!Form::close()!!}		 --}}
            
	


	@push('js')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#div-btn1').on('click', function() {
				$("#central").load('inc/presentation.php');
				return false;
			});
			...
		});
		</script>
	@endpush
	
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