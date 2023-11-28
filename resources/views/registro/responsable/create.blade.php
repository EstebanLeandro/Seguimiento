@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h2 style="font-weight: bold">Agregar responsable</h2>
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

			{{-- {!!Form::open(array('url'=>'registro/responsable','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} --}}
			<form action="{{ route('responsable.store') }}" method ="POST">
				@csrf
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
            	<label for="descri_responsable">Responsable:</label>
            	<input type="text" name="descri_responsable" class="form-control" placeholder="Descripción responsable..."  value="{{old('descri_responsable')}}">
				<div id="descri_responsable-error" class="error text-danger pl-3" for="descri_responsable" style="display: block;">
				   <strong>{{ $errors->first('descri_responsable') }}</strong>
			    </div>
            </div>
		
            <div class="form-group">
            	<button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
            	<button class="btn btn-danger" type="reset"  role="alert">Cancelar</button>
            </div>
    </div>
</div>
			<div class="modal-footer">
			  <a href="\registro\responsable" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
			</div>

			{{-- {!!Form::close()!!}		 --}}
</form>       
		

	
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

