@extends('layouts.admin')

@section('contenido')
<section class="section">
    <div class="panel panel-primary"></div>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Roles
             @can('crear-rol')      
            <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>
          @endcan   
        </h3>

    <form action="{{ route('roles.index')}}" method ="GET">
        <div class="form-group">
	        <div class="input-group">
             <input type="text" class="form-control" name="busqueda" placeholder="Buscar..." value="{{$busqueda}}">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">Buscar</button>
              </span>
          </div>
        </div>
	</form>	

   </div>
</div>               


<div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">  

                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($roles as $role)
                                <tr>                           
                                    <td>{{ $role->name }}</td>
                                    <td>                                
                                          @can('editar-rol') 
                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                                         @endcan   
                                        
                                         @can('borrar-rol')   
                                        <a href="" data-target="#modal-delete-{{$role->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

                                       @endcan 
                                    </td>
                                </tr>
                                @include('roles.modal')

                                @endforeach
                                </tbody>               
                            </table>

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
