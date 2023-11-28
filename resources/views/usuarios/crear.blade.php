@extends ('layouts.admin')

@section('contenido')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
			<h3 style="font-weight: bold">Crear Usuarios</h3>  
                       
        </div>
	</div>

    <!-- {!! Form::open(array('route' => 'usuarios.store','method'=>'POST')) !!} -->
    <form action="{{ route('usuarios.store') }}" method ="POST">
				@csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                    <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
					                   <strong>{{ $errors->first('name') }}</strong>
				                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    {!! Form::text('email', null, array('class' => 'form-control')) !!}
                                    <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
					                   <strong>{{ $errors->first('email') }}</strong>
				                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    {!! Form::password('password', array('class' => 'form-control')) !!}
                                    <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
					                    <strong>{{ $errors->first('password') }}</strong>
				                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="confirm-password">Confirmar Password</label>
                                    {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                                    <div id="confirm-password-error" class="error text-danger pl-3" for="confirm-password" style="display: block;">
					                     <strong>{{ $errors->first('confirm-password') }}</strong>
				                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="" >Roles</label>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                                    <div id="roles-error" class="error text-danger pl-3" for="roles" style="display: block;">
					                    <strong>{{ $errors->first('roles') }}</strong>
				                    </div>
                                </div>
                            </div>
  

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button class="btn btn-primary" type="submit"  data-dismiss="success" role="alert">Guardar</button>
						        <button class="btn btn-danger" type="reset"  data-dismiss="modal" role="alert">Cancelar</button>                            </div>
                            </div>
        </div>
                                    <div class="modal-footer">							
							               <a href="javascript:history.back()"> Volver Atrás</a>
				                            <a href="\usuarios" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>

						             </div>


                {!! Form::close() !!}
              
@endsection
