@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3 style="font-weight: bold">Editar Sede: {{ $sedes->descri_sede}}</h3>
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

		{{-- {{Form::model($sedes, ['method' => 'PATCH', 'route' => ['sede.update', $sedes -> id]])}}
        {{Form::token()}} --}}
<form action="{{ route('sede.update', $sedes->id) }}" method ="POST">
	@csrf
	{{ method_field('PUT') }}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="descri_sede">Descripción</label>
			<input type="text" name="descri_sede" class="form-control" value="{{$sedes->descri_sede}}" placeholder="Descripción...">
			<div id="descri_sede-error" class="error text-danger pl-3" for="descri_sede" style="display: block;">
				   <strong>{{ $errors->first('descri_sede') }}</strong>
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Guardar</button>
			<button class="btn btn-danger" type="reset" data-dismiss="modal" role="alert">Cancelar</button>
        </div>
	</div>
</div>		
		<div class="modal-footer">
			<a href="\registro\sede" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
		</div>
		
</form>
		{{-- {!!Form::close()!!}		 --}}

@endsection