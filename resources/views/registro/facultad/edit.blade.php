@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3 style="font-weight: bold">Editar Facultad: {{ $facultads->descri_facultad}}</h3>
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

		{{-- {{Form::model($facultads, ['method' => 'PATCH', 'route' => ['facultad.update', $facultads -> id]])}}
        {{Form::token()}} --}}
		<form action="{{ route('facultad.update', $facultads->id) }}" method ="POST">
			@csrf
			{{ method_field('PUT') }}

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="descri_facultad">Descripción</label>
			<input type="text" name="descri_facultad" class="form-control" value="{{$facultads->descri_facultad}}" placeholder="Descripción...">
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

		
</form>
		{{-- {!!Form::close()!!}		 --}}

@endsection