@extends('layouts.admin')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        
                        


                        
                        {{-- {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!} --}}
                        <form action="{{ route('roles.store') }}" method ="POST">
				            @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Nombre del Rol:</label>                                    
                                    <input id="firstName" type="text"
                                   class="form-control"
                                   name="name"
                                   placeholder="Nombre del rol..."                   

                                   autofocus required  value="{{old('name')}}">
                                   <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Permisos para este Rol:</label>
                                    <br/>
                                    @foreach($permission as $value)
                                        <input type="checkbox" class="form-check-input"  name="permission[]" value="{{$value->id}}">
					                    <label class="form-check-label">{{$value->name, ucfirst($value->name)}}</label>
                                    <br/>
                                    @endforeach
                                </div>
                            </div>        

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                    </form>
                    <div class="modal-footer">
				<a href="\roles" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
		          </div> 

                    </div>
                        
                 </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
