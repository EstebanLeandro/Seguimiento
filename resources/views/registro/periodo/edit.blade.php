@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3 style="font-weight: bold">Editar periodo: {{ $periodos->descri_periodo}}</h3>
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
{{-- 
		{{Form::model($periodos, ['method' => 'PATCH', 'route' => ['periodo.update', $periodos -> id]])}}
        {{Form::token()}} --}}
		<form action="{{ route('periodo.update', $periodos->id) }}" method ="POST">
			@csrf
			{{ method_field('PUT') }}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="descri_periodo">Descripción</label>
			<input type="text" name="descri_periodo" class="form-control" value="{{$periodos->descri_periodo}}" placeholder="Descripción...">
		    <div id="descri_periodo-error" class="error text-danger pl-3" for="descri_periodo" style="display: block;">
				   <strong>{{ $errors->first('descri_periodo') }}</strong>
			    </div>
		</div>

		<div class="form-group">
			<button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
			<button class="btn btn-danger" type="reset">Cancelar</button>
	    </div>
   
	</div>		
</div>
			<div class="modal-footer">
			    <a href="\registro\periodo" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
		    </div>

		{{-- {!!Form::close()!!}		 --}}
</form>

@endsection